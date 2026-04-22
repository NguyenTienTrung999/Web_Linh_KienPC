<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Summary Metrics
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_price');
        $ordersCount = Order::count();
        $customersCount = User::where('role', 'user')->count();
        $productsCount = Product::count();

        // 2. Recent Orders
        $recentOrders = Order::latest()->take(5)->get();

        // 3. Category Distribution (Product count per category)
        $categories = Category::withCount('products')->get()->map(function($category) use ($productsCount) {
            return [
                'name' => $category->name,
                'count' => $category->products_count,
                'percentage' => $productsCount > 0 ? round(($category->products_count / $productsCount) * 100) : 0
            ];
        });

        // 4. Sales Growth (Last 7 Days)
        $salesData = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = ($i === 0) ? 'Hôm nay' : $date->isoFormat('dddd');
            $salesData[] = Order::whereDate('created_at', $date)
                ->where('status', '!=', 'cancelled')
                ->sum('total_price');
        }

        return view('admin.dashboard.index', compact(
            'totalRevenue', 
            'ordersCount', 
            'customersCount', 
            'productsCount',
            'recentOrders',
            'categories',
            'salesData',
            'labels'
        ));
    }
}
