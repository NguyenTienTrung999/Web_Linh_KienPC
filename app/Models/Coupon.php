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
}
