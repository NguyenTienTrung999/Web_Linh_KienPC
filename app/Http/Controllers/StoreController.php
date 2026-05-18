<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        // 1. Core query for the main product list
        $query = Product::with('category', 'brand')->where('stock_quantity', '>', 0);

        // Apply Search and Category filters (The most basic layer)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('categories') && is_array($request->categories)) {
            $query->whereIn('category_id', $request->categories);
        }

        // Apply Brand filters
        if ($request->has('brands') && is_array($request->brands)) {
            $query->whereIn('brand_id', $request->brands);
        }

        // Apply Price filters
        if ($request->filled('min_price')) {
            $query->whereRaw('COALESCE(sale_price, price) >= ?', [$request->min_price]);
        }
        if ($request->filled('max_price')) {
            $query->whereRaw('COALESCE(sale_price, price) <= ?', [$request->max_price]);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) asc'),
            'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(60);

        // --- SIDEBAR LOGIC ---

        // 2. Fetch Categories (Always show all, but count only based on Search + Stock)
        $categories = Category::withCount(['products' => function ($q) use ($request) {
            $q->where('stock_quantity', '>', 0);
            if ($request->filled('search')) {
                $q->where('name', 'like', '%' . $request->search . '%');
            }
        },
        ])->get();

        // 3. Fetch Brands (Filtered by Search + Category + Stock)
        $brandQuery = \App\Models\Brand::query();
        $brandQuery->whereHas('products', function ($q) use ($request) {
            $q->where('stock_quantity', '>', 0);
            if ($request->filled('search')) {
                $q->where('name', 'like', '%' . $request->search . '%');
            }
            if ($request->has('categories') && is_array($request->categories)) {
                $q->whereIn('category_id', $request->categories);
            }
        });

        $brands = $brandQuery->withCount(['products' => function ($q) use ($request) {
            $q->where('stock_quantity', '>', 0);
            if ($request->filled('search')) {
                $q->where('name', 'like', '%' . $request->search . '%');
            }
            if ($request->has('categories') && is_array($request->categories)) {
                $q->whereIn('category_id', $request->categories);
            }
        },
        ])->get();

        // 4. Calculate Price Ranges (Filtered by Search + Category + Brand + Stock)
        // 4. Calculate Price Ranges (Filtered by Search + Category + Brand + Stock)
        // Optimized: Single query for all price ranges
        $rangeQuery = Product::query()->where('stock_quantity', '>', 0);

        if ($request->filled('search')) {
            $rangeQuery->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('categories') && is_array($request->categories)) {
            $rangeQuery->whereIn('category_id', $request->categories);
        }
        if ($request->has('brands') && is_array($request->brands)) {
            $rangeQuery->whereIn('brand_id', $request->brands);
        }

        $priceRangeCounts = $rangeQuery->selectRaw('
            COUNT(CASE WHEN COALESCE(sale_price, price) < 500000 THEN 1 END) as `0-500000`,
            COUNT(CASE WHEN COALESCE(sale_price, price) >= 500000 AND COALESCE(sale_price, price) < 1000000 THEN 1 END) as `500000-1000000`,
            COUNT(CASE WHEN COALESCE(sale_price, price) >= 1000000 AND COALESCE(sale_price, price) < 2000000 THEN 1 END) as `1000000-2000000`,
            COUNT(CASE WHEN COALESCE(sale_price, price) >= 2000000 AND COALESCE(sale_price, price) < 3000000 THEN 1 END) as `2000000-3000000`,
            COUNT(CASE WHEN COALESCE(sale_price, price) >= 3000000 AND COALESCE(sale_price, price) < 5000000 THEN 1 END) as `3000000-5000000`,
            COUNT(CASE WHEN COALESCE(sale_price, price) >= 5000000 AND COALESCE(sale_price, price) < 10000000 THEN 1 END) as `5000000-10000000`,
            COUNT(CASE WHEN COALESCE(sale_price, price) >= 10000000 THEN 1 END) as `10000000-up`
        ')->first()->toArray();

        return view('store.index', compact('products', 'categories', 'brands', 'priceRangeCounts'));
    }

    public function category($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        // Inject the category into the request so the index logic works perfectly
        $request->merge(['categories' => [$category->id], 'is_seo_category' => true, 'category_slug' => $slug]);
        
        return $this->index($request);
    }
}
