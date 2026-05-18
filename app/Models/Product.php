<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'price',
        'sale_price',
        'image',
        'description',
        'stock_quantity',
        'specs',
        'tags',
        'warranty_period',
        'is_active',
        'is_featured',
        'gallery',
        'colors',
    ];

    protected $casts = [
        'specs' => 'array',
        'gallery' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'colors' => 'array',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that owns the product.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the wishlists for the product.
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Retrieve the model for a bound value.
     * Support both ID and Slug.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)
            ->orWhere('id', $value)
            ->firstOrFail();
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        // Tự động xóa cache trang chủ khi có sản phẩm được thêm/sửa
        static::saved(function ($product) {
            \Illuminate\Support\Facades\Cache::forget('homepage_data');
        });

        // Tự động xóa cache trang chủ khi có sản phẩm bị xóa
        static::deleted(function ($product) {
            \Illuminate\Support\Facades\Cache::forget('homepage_data');
        });
    }
}
