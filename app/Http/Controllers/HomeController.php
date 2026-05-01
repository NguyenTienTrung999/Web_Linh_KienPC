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

        // Dynamic: load all categories with their latest 6 products
        $categoryProducts = [];
        foreach ($categories as $cat) {
            $products = Product::where('category_id', $cat->id)
                ->latest()
                ->take(6)
                ->get();
            if ($products->count() > 0) {
                $categoryProducts[] = [
                    'category' => $cat,
                    'products' => $products,
                ];
            }
        }

        $flashSales = Product::whereNotNull('sale_price')
            ->where('sale_price', '>', 0)
            ->whereRaw('sale_price <= (price * 0.5)')
            ->latest()
            ->take(12)
            ->get();

        $bestSellers = Product::inRandomOrder()->take(8)->get();
        $featuredProducts = Product::where('is_featured', true)->latest()->get();

        return view('home', compact('categories', 'flashSales', 'bestSellers', 'featuredProducts', 'categoryProducts'));
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

    /**
     * Get search suggestions for real-time search.
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            return response()->json([]);
        }

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'price', 'sale_price', 'image')
            ->latest()
            ->take(10)
            ->get()
            ->map(function($product) {
                return [
                    'name' => $product->name,
                    'price' => number_format($product->price, 0, ',', '.') . '₫',
                    'sale_price' => $product->sale_price ? number_format($product->sale_price, 0, ',', '.') . '₫' : null,
                    'image' => $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/50x50?text=No+Image',
                    'url' => route('products.show', $product->id),
                ];
            });

        return response()->json($products);
    }
}
