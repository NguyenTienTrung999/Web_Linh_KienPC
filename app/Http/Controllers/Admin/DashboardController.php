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
    public function index(Request $request)
    {
        $period = $request->get('period', '7days');
        $startDate = null;
        $endDate = null;
        $now = \Carbon\Carbon::now();

        switch ($period) {
            case 'month':
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                break;
            case 'year':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfYear();
                break;
            case 'custom':
                if ($request->filled('start_date') && $request->filled('end_date')) {
                    $startDate = \Carbon\Carbon::parse($request->get('start_date'))->startOfDay();
                    $endDate = \Carbon\Carbon::parse($request->get('end_date'))->endOfDay();
                } else {
                    $startDate = $now->copy()->subDays(6)->startOfDay();
                    $endDate = $now->copy()->endOfDay();
                    $period = '7days';
                }
                break;
            case '7days':
            default:
                $period = '7days';
                $startDate = $now->copy()->subDays(6)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                break;
        }

        // 1. Summary Metrics
        $orderQuery = Order::query();
        if ($startDate && $endDate) {
            $orderQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $totalRevenue = (clone $orderQuery)->where('status', '!=', 'cancelled')->sum('total_price');
        $ordersCount = (clone $orderQuery)->count();
        
        // Let customers and products remain all-time stats as they represent the overall system size
        $customersCount = User::where('role', 'user')->count();
        $productsCount = Product::count();

        // 2. Recent Orders
        $recentOrders = (clone $orderQuery)->latest()->take(5)->get();

        // 3. Category Distribution (Product count per category)
        $categories = Category::withCount('products')->get()->map(function($category) use ($productsCount) {
            return [
                'name' => $category->name,
                'count' => $category->products_count,
                'percentage' => $productsCount > 0 ? round(($category->products_count / $productsCount) * 100) : 0
            ];
        });

        // 4. Sales Growth (Dynamic based on period)
        $salesData = [];
        $labels = [];
        
        if ($startDate && $endDate) {
            $diffDays = $startDate->diffInDays($endDate);
            
            if ($diffDays > 60) {
                // Group by month
                $cStartMonth = $startDate->copy()->startOfMonth();
                while($cStartMonth->lte($endDate)) {
                    $labels[] = $cStartMonth->format('m/Y');
                    $salesData[] = Order::whereMonth('created_at', $cStartMonth->month)
                                         ->whereYear('created_at', $cStartMonth->year)
                                         ->whereBetween('created_at', [$startDate, $endDate])
                                         ->where('status', '!=', 'cancelled')
                                         ->sum('total_price');
                    $cStartMonth->addMonth();
                }
            } else {
                // Group by day
                for ($i = 0; $i <= $diffDays; $i++) {
                    $date = $startDate->copy()->addDays($i);
                    $labels[] = $date->format('d/m');
                    $salesData[] = Order::whereDate('created_at', $date)
                                        ->where('status', '!=', 'cancelled')
                                        ->sum('total_price');
                }
            }
        }

        return view('admin.dashboard.index', compact(
            'totalRevenue', 
            'ordersCount', 
            'customersCount', 
            'productsCount',
            'recentOrders',
            'categories',
            'salesData',
            'labels',
            'period',
            'startDate',
            'endDate'
        ));
    }
}
