<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        // 1. Core query for the main product list
        $query = Product::with('category', 'brand');

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

        $products = $query->get();

        // --- SIDEBAR LOGIC ---

        // 2. Fetch Categories (Always show all, but count only based on Search)
        $categories = Category::withCount(['products' => function($q) use ($request) {
            if ($request->filled('search')) {
                $q->where('name', 'like', '%' . $request->search . '%');
            }
        }])->get();

        // 3. Fetch Brands (Filtered by Search + Category)
        $brandQuery = \App\Models\Brand::query();
        $brandQuery->whereHas('products', function($q) use ($request) {
            if ($request->filled('search')) {
                $q->where('name', 'like', '%' . $request->search . '%');
            }
            if ($request->has('categories') && is_array($request->categories)) {
                $q->whereIn('category_id', $request->categories);
            }
        });
        
        $brands = $brandQuery->withCount(['products' => function($q) use ($request) {
            if ($request->filled('search')) {
                $q->where('name', 'like', '%' . $request->search . '%');
            }
            if ($request->has('categories') && is_array($request->categories)) {
                $q->whereIn('category_id', $request->categories);
            }
        }])->get();

        // 4. Calculate Price Ranges (Filtered by Search + Category + Brand)
        $priceRangeCounts = [];
        $ranges = [
            ['min' => 0, 'max' => 500000, 'key' => '0-500000'],
            ['min' => 500000, 'max' => 1000000, 'key' => '500000-1000000'],
            ['min' => 1000000, 'max' => 2000000, 'key' => '1000000-2000000'],
            ['min' => 2000000, 'max' => 3000000, 'key' => '2000000-3000000'],
            ['min' => 3000000, 'max' => 5000000, 'key' => '3000000-5000000'],
            ['min' => 5000000, 'max' => 10000000, 'key' => '5000000-10000000'],
            ['min' => 10000000, 'max' => null, 'key' => '10000000-up'],
        ];

        foreach ($ranges as $range) {
            $rangeQuery = Product::query();
            // Apply Search
            if ($request->filled('search')) {
                $rangeQuery->where('name', 'like', '%' . $request->search . '%');
            }
            // Apply Category
            if ($request->has('categories') && is_array($request->categories)) {
                $rangeQuery->whereIn('category_id', $request->categories);
            }
            // Apply Brand
            if ($request->has('brands') && is_array($request->brands)) {
                $rangeQuery->whereIn('brand_id', $request->brands);
            }
            // Apply this specific price range
            $rangeQuery->whereRaw('COALESCE(sale_price, price) >= ?', [$range['min']]);
            if ($range['max']) {
                $rangeQuery->whereRaw('COALESCE(sale_price, price) < ?', [$range['max']]);
            }
            $priceRangeCounts[$range['key']] = $rangeQuery->count();
        }

        return view('store.index', compact('products', 'categories', 'brands', 'priceRangeCounts'));
    }
}
