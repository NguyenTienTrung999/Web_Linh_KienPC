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
        })->latest()->take(4)->get();

        $mice = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%chuột%')->orWhere('name', 'like', '%mouse%');
        })->latest()->take(4)->get();

        $monitors = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%màn hình%')->orWhere('name', 'like', '%monitor%');
        })->latest()->take(4)->get();

        $headphones = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%tai nghe%')->orWhere('name', 'like', '%headphone%')->orWhere('name', 'like', '%âm thanh%');
        })->latest()->take(4)->get();

        $speakers = Product::whereHas('category', function($q) {
            $q->where('name', 'like', '%loa%')->orWhere('name', 'like', '%speaker%');
        })->latest()->take(4)->get();

        return view('home', compact('categories', 'keyboards', 'mice', 'monitors', 'headphones', 'speakers'));
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
