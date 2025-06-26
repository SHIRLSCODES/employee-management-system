<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $fillable = [
        'stock_item_id',
        'transactionable_type',
        'transactionable_id',
        'quantity',
        'direction',
        'description'
    ];

    public function stockItem() {
        return $this->belongsTo(StockItem::class);
    }

    public function transactionable() {
        return $this->morphTo();
    }
}
