<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production to avoid mixed content errors behind proxies (like Render)
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Use View::composer but ensure database queries run only once per request
        View::composer('*', function ($view) {
            static $data = null;

            if ($data === null) {
                // 1. Initialize default empty data to prevent view crashes in any environment
                $data = [
                    'globalBrands' => collect(),
                    'globalCategories' => collect(),
                    'brandCategoryMap' => collect(),
                ];

                // 2. Safely attempt to load real data if the database is ready
                try {
                    // Check if we have a connection and the tables exist
                    // This check is crucial for CI/CD environments where migrations might run later
                    if (Schema::hasTable('categories') && Schema::hasTable('brands')) {
                        $data['globalBrands'] = Brand::all();
                        $data['globalCategories'] = Category::all();

                        if (Schema::hasTable('products')) {
                            $data['brandCategoryMap'] = DB::table('products')
                                ->whereNotNull('brand_id')
                                ->select('category_id', 'brand_id')
                                ->distinct()
                                ->get()
                                ->groupBy('category_id')
                                ->map(fn ($items) => $items->pluck('brand_id'));
                        }
                    }
                } catch (\Exception $e) {
                    // Silently fail if DB is not ready; $data already holds empty collections
                }
            }

            $view->with($data);
        });
    }
}
