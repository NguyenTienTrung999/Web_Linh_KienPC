<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Core Summary Metrics
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        $totalOrders = Order::count();
        $successfulOrders = Order::where('status', 'completed')->count();
        $averageOrderValue = $successfulOrders > 0 ? $totalRevenue / $successfulOrders : 0;
        
        // 2. Monthly Revenue (Last 6 Months)
        $monthlyRevenue = [];
        $monthLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthLabels[] = $month->format('M Y');
            $monthlyRevenue[] = Order::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('status', 'completed')
                ->sum('total_price');
        }

        // 3. Daily Revenue (Last 14 Days)
        $dailyRevenue = [];
        $dayLabels = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayLabels[] = $date->format('d/m');
            $dailyRevenue[] = Order::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('total_price');
        }

        // 4. Top 5 Best Selling Products (by Quantity)
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue'))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->take(5)
            ->get();

        // 5. Category Breakdown (by Revenue)
        $categoryRevenue = Category::join('products', 'categories.id', '=', 'products.category_id')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->select('categories.name', DB::raw('SUM(order_items.price * order_items.quantity) as revenue'))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('revenue')
            ->get();

        // 6. Order Status Distribution
        $statusCounts = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'monthlyRevenue',
            'monthLabels',
            'dailyRevenue',
            'dayLabels',
            'topProducts',
            'categoryRevenue',
            'statusCounts'
        ));
    }
}
