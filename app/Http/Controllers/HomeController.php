<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with product grid, search, and pagination.
     */
    public function index(Request $request)
    {
        // For the new Home Page structure
        $categories = Category::all();

        // Specific category lookups for featured sections
        $keyboards = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%bàn phím%')->orWhere('name', 'like', '%keyboard%');
        })->latest()->take(6)->get();

        $mice = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%chuột%')->orWhere('name', 'like', '%mouse%');
        })->latest()->take(6)->get();

        $monitors = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%màn hình%')->orWhere('name', 'like', '%monitor%');
        })->latest()->take(6)->get();

        $headphones = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%tai nghe%')->orWhere('name', 'like', '%headphone%')->orWhere('name', 'like', '%âm thanh%');
        })->latest()->take(6)->get();

        $speakers = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%loa%')->orWhere('name', 'like', '%speaker%');
        })->latest()->take(6)->get();

        $flashSales = Product::whereNotNull('sale_price')
            ->where('sale_price', '>', 0)
            ->whereRaw('sale_price <= (price * 0.5)')
            ->latest()
            ->take(12)
            ->get();

        $bestSellers = Product::inRandomOrder()->take(8)->get();
        $featuredProducts = Product::where('is_featured', true)->latest()->get();

        return view('home', compact('categories', 'flashSales', 'bestSellers', 'featuredProducts', 'keyboards', 'mice', 'monitors', 'headphones', 'speakers'));
    }

    /**
     * Display the product detail page.
     */
    public function show(Product $product)
    {
        $product->load('category');
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
