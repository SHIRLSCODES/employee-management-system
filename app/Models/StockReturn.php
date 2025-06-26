<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockReturn extends Model
{
    protected $fillable = [
        'stock_requisition_id',
        'stock_item_id',
        'condition',
        'quantity',
        'remarks',
        'status',
        'returnable_type',
        'returnable_id',
    ];

    public function requisition() { 
        return $this->belongsTo(StockRequisition::class);
    }

    public function returnable()
    {
        return $this->morphTo();
    }

    public function stockItemFromRequisition()
    {
        return $this->hasOneThrough(StockItem::class, StockRequisition::class,
            'id',                // Foreign key on StockRequisition
            'id',                // Foreign key on StockItem
            'stock_requisition_id', // Local key on StockReturn
            'stock_item_id'      // Local key on StockRequisition
        );
    }

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class);
    }

    public function getResolvedStockItemAttribute()
    {
        return $this->stockItem ?? $this->stockItemFromRequisition;
    }

    public function getDisplayNameAttribute()
    {
        if ($this->returnable instanceof \App\Models\Employee) {
            return $this->returnable->first_name . ' ' . $this->returnable->last_name;
        }

        if ($this->returnable instanceof \App\Models\Admin) {
            return $this->returnable->name;
        }

        return 'Unknown';
    }
}
