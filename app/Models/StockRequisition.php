<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StockRequisition extends Model
{
    protected $fillable = [
        'requestable_type',
        'requestable_id',
        'stock_item_id',
        'quantity',
        'status',
        'note'
    ];

    public function stockItem()   { 
        return $this->belongsTo(StockItem::class);
    }
    public function requestable() { 
        return $this->morphTo();
    }

    public function getUser()
    {
        return $this->requestable;
    }
    
    public function getDisplayNameAttribute()
    {
        if ($this->requestable instanceof \App\Models\Employee) {
            return $this->requestable->first_name . ' ' . $this->requestable->last_name;
        }

        if ($this->requestable instanceof \App\Models\Admin) {
            return $this->requestable->name;
        }

        return 'Unknown';
    }

    public function stockReturn() { 
        return $this->hasMany(StockReturn::class);
    }
}



















