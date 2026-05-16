<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_value',
        'discount_type',
        'min_order_value',
        'usage_limit',
        'used_count',
        'valid_from',
        'valid_to',
        'is_active',
    ];

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function isExpired()
    {
        return $this->valid_to && $this->valid_to->isPast();
    }

    public function isFull()
    {
        return $this->usage_limit && $this->used_count >= $this->usage_limit;
    }

    public function isValid()
    {
        if (!$this->is_active) return false;
        if ($this->isExpired()) return false;
        if ($this->isFull()) return false;
        if ($this->valid_from && $this->valid_from->isFuture()) return false;
        
        return true;
    }
}
