<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StockTransaction;
use App\Models\StockRequisition;


class StockItem extends Model
{
    protected $fillable = [ 
        'name',
        'category',
        'description',
        'quantity',
        'unit',
        'is_returnable'
    ];

    protected $casts = [
        'is_returnable' => 'boolean',
    ];

    public function requisitions()      { 
        return $this->hasMany(StockRequisition::class);
    }
    public function transactions()      { 
        return $this->hasMany(StockTransaction::class);
    }
    public function getIsReturnableAttribute($value)
    {
        return (bool) $value;
    }
    public function adjustQuantity(int $qty, string $direction, Model $byUser, string $desc = null): void
    {
        if ($direction === 'out' && $this->quantity < $qty) {
            throw new \Exception('Insufficient stock');
        }

        $this->update([
            'quantity' => $direction === 'in' 
            ? $this->quantity + $qty 
            : $this->quantity - $qty
        ]);

        $this->transactions()->create([
            'transactionable_type' => get_class($byUser),
            'transactionable_id'   => $byUser->id,
            'quantity'             => $qty,
            'direction'            => $direction,
            'description'          => $desc,
        ]);
    }
}
