<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (\Illuminate\Support\Facades\Schema::hasTable('brands')) {
                $view->with('globalBrands', \App\Models\Brand::all());
            } else {
                $view->with('globalBrands', collect());
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
                $view->with('globalCategories', \App\Models\Category::all());
            } else {
                $view->with('globalCategories', collect());
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('products')) {
                $brandCategoryMap = \Illuminate\Support\Facades\DB::table('products')
                    ->whereNotNull('brand_id')
                    ->select('category_id', 'brand_id')
                    ->distinct()
                    ->get()
                    ->groupBy('category_id')
                    ->map(fn($items) => $items->pluck('brand_id'));
                $view->with('brandCategoryMap', $brandCategoryMap);
            } else {
                $view->with('brandCategoryMap', collect());
            }
        });
    }
}
