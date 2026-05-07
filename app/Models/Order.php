<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    // Happy Path
    const STATUS_PENDING = 'pending';     // Chờ thanh toán
    const STATUS_PROCESSING = 'processing'; // Chờ xác nhận
    const STATUS_PACKING = 'packing';       // Đang chuẩn bị hàng
    const STATUS_SHIPPING = 'shipping';     // Đang giao hàng
    const STATUS_COMPLETED = 'completed';   // Hoàn thành

    // Exception Path
    const STATUS_CANCELLED = 'cancelled';   // Đã hủy
    const STATUS_FAILED = 'failed';         // Thất bại
    const STATUS_REFUNDED = 'refunded';     // Hoàn tiền/Trả hàng

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_price',
        'coupon_id',
        'coupon_code',
        'discount_amount',
        'status',
        'payment_method',
        'shipping_address',
        'note',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the human-readable label for the status.
     */
    public function getStatusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Chờ thanh toán',
            self::STATUS_PROCESSING => 'Chờ xác nhận',
            self::STATUS_PACKING => 'Đang chuẩn bị hàng',
            self::STATUS_SHIPPING => 'Đang giao hàng',
            self::STATUS_COMPLETED => 'Hoàn thành',
            self::STATUS_CANCELLED => 'Đã hủy',
            self::STATUS_FAILED => 'Thất bại',
            self::STATUS_REFUNDED => 'Hoàn tiền/Trả hàng',
            default => $this->status,
        };
    }

    /**
     * Get the Tailwind color class for the status badge.
     */
    public function getStatusColor(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'bg-amber-100 text-amber-700 border-amber-200',
            self::STATUS_PROCESSING => 'bg-blue-100 text-blue-700 border-blue-200',
            self::STATUS_PACKING => 'bg-indigo-100 text-indigo-700 border-indigo-200',
            self::STATUS_SHIPPING => 'bg-purple-100 text-purple-700 border-purple-200',
            self::STATUS_COMPLETED => 'bg-emerald-100 text-emerald-700 border-emerald-200',
            self::STATUS_CANCELLED => 'bg-rose-100 text-rose-700 border-rose-200',
            self::STATUS_FAILED => 'bg-slate-100 text-slate-700 border-slate-200',
            self::STATUS_REFUNDED => 'bg-orange-100 text-orange-700 border-orange-200',
            default => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }

    /**
     * Get all available statuses.
     */
    public static function getAllStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Chờ thanh toán',
            self::STATUS_PROCESSING => 'Chờ xác nhận',
            self::STATUS_PACKING => 'Đang chuẩn bị hàng',
            self::STATUS_SHIPPING => 'Đang giao hàng',
            self::STATUS_COMPLETED => 'Hoàn thành',
            self::STATUS_CANCELLED => 'Đã hủy',
            self::STATUS_FAILED => 'Thất bại',
            self::STATUS_REFUNDED => 'Hoàn tiền/Trả hàng',
        ];
    }
}
