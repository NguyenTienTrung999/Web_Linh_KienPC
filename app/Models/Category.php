<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Get the products for the category.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the slug attribute. Fallback to slugified name if empty.
     */
    public function getSlugAttribute($value)
    {
        return $value ?: \Illuminate\Support\Str::slug($this->name);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            if (empty($category->slug)) {
                $category->slug = \Illuminate\Support\Str::slug($category->name);
            }
        });

        static::saved(function ($category) {
            \Illuminate\Support\Facades\Cache::forget('homepage_data');
        });

        static::deleted(function ($category) {
            \Illuminate\Support\Facades\Cache::forget('homepage_data');
        });
    }
}
