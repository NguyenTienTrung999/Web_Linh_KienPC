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
        // Dynamic: load categories with their latest 6 products (Fix N+1 query problem)
        $categoriesWithProducts = Category::with(['products' => function($query) {
            $query->where('stock_quantity', '>', 0)
                  ->latest()
                  ->take(6);
        }])->get();

        $categoryProducts = [];
        foreach ($categoriesWithProducts as $cat) {
            if ($cat->products->count() > 0) {
                $categoryProducts[] = [
                    'category' => $cat,
                    'products' => $cat->products,
                ];
            }
        }

        $flashSales = Product::with('category')->where('stock_quantity', '>', 0)
            ->whereNotNull('sale_price')
            ->where('sale_price', '>', 0)
            ->whereRaw('sale_price <= (price * 0.5)')
            ->latest()
            ->take(12)
            ->get();

        $bestSellers = Product::with('category')->where('stock_quantity', '>', 0)->inRandomOrder()->take(8)->get();
        $featuredProducts = Product::with('category')->where('stock_quantity', '>', 0)->where('is_featured', true)->latest()->get();

        $categories = $categoriesWithProducts; // For the sidebar/navigation

        return view('home', compact('categories', 'flashSales', 'bestSellers', 'featuredProducts', 'categoryProducts'));
    }

    /**
     * Display the Hot Sale products page.
     */
    public function hotSale(Request $request)
    {
        $query = Product::with('category')->where('stock_quantity', '>', 0)
            ->whereNotNull('sale_price')
            ->where('sale_price', '>', 0)
            ->whereRaw('sale_price <= (price * 0.5)'); // High discount products (50% or more)

        // Sorting logic matching StoreController
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) asc'),
            'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(20);
        $totalProducts = $products->total();

        return view('hot-sale', compact('products', 'totalProducts', 'sort'));
    }

    /**
     * Display the Featured Products page.
     */
    public function featuredProducts(Request $request)
    {
        $query = Product::with('category')->where('stock_quantity', '>', 0)
            ->where('is_featured', true);

        // Sorting logic
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) asc'),
            'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(24); // Show more featured products
        $totalProducts = $products->total();

        return view('featured-products', compact('products', 'totalProducts', 'sort'));
    }

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
