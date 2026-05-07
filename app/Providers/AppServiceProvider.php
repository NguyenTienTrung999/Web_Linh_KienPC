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
        // Use View::composer but ensure database queries run only once per request
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            static $data = null;

            if ($data === null) {
                try {
                    // Check if we can connect to the database
                    \Illuminate\Support\Facades\DB::connection()->getPdo();

                    $data = [
                        'globalBrands' => \Illuminate\Support\Facades\Schema::hasTable('brands') 
                            ? \App\Models\Brand::all() 
                            : collect(),
                        'globalCategories' => \Illuminate\Support\Facades\Schema::hasTable('categories') 
                            ? \App\Models\Category::all() 
                            : collect(),
                        'brandCategoryMap' => collect(),
                    ];

                    if (\Illuminate\Support\Facades\Schema::hasTable('products')) {
                        $data['brandCategoryMap'] = \Illuminate\Support\Facades\DB::table('products')
                            ->whereNotNull('brand_id')
                            ->select('category_id', 'brand_id')
                            ->distinct()
                            ->get()
                            ->groupBy('category_id')
                            ->map(fn($items) => $items->pluck('brand_id'));
                    }
                } catch (\Exception $e) {
                    // If database connection fails, provide empty collections to avoid 500 errors
                    $data = [
                        'globalBrands' => collect(),
                        'globalCategories' => collect(),
                        'brandCategoryMap' => collect(),
                    ];
                }
            }

            $view->with($data);
        });
    }
}
