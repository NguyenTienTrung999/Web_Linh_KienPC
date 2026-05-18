<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');
        $startDate = null;
        $endDate = null;

        $now = Carbon::now();

        switch ($period) {
            case 'today':
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                break;
            case 'week':
                $startDate = $now->copy()->startOfWeek();
                $endDate = $now->copy()->endOfWeek();
                break;
            case 'quarter':
                $startDate = $now->copy()->firstOfQuarter();
                $endDate = $now->copy()->lastOfQuarter();
                break;
            case 'year':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfYear();
                break;
            case 'custom':
                if ($request->filled('start_date') && $request->filled('end_date')) {
                    $startDate = Carbon::parse($request->get('start_date'))->startOfDay();
                    $endDate = Carbon::parse($request->get('end_date'))->endOfDay();
                } else {
                    $startDate = $now->copy()->startOfMonth();
                    $endDate = $now->copy()->endOfMonth();
                    $period = 'month';
                }
                break;
            case 'month':
            default:
                $period = 'month';
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                break;
        }

        // 1. Core Summary Metrics
        $orderQuery = Order::query();
        if ($startDate && $endDate) {
            $orderQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $totalOrders = (clone $orderQuery)->count();
        $successfulOrders = (clone $orderQuery)->where('status', 'completed')->count();
        $totalRevenue = (clone $orderQuery)->where('status', 'completed')->sum('total_price');
        $averageOrderValue = $successfulOrders > 0 ? $totalRevenue / $successfulOrders : 0;

        // 2. Dynamic Chart Data (ApexCharts) based on Global Filter
        $chartLabels = [];
        $chartData = [];

        if ($startDate && $endDate) {
            $diffDays = $startDate->diffInDays($endDate);
            $chartDataCollection = collect();

            if ($diffDays > 60) {
                // Group by month
                $cStartMonth = $startDate->copy()->startOfMonth();
                while ($cStartMonth->lte($endDate)) {
                    $monthStr = $cStartMonth->format('Y-m');
                    $chartLabels[] = $cStartMonth->format('m/Y');
                    $chartDataCollection->put($monthStr, 0);
                    $cStartMonth->addMonth();
                }

                $groupedSales = Order::select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date_group'),
                    DB::raw('SUM(total_price) as total')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->groupBy('date_group')
                ->pluck('total', 'date_group');
            } else {
                // Group by day
                for ($i = 0; $i <= $diffDays; $i++) {
                    $date = $startDate->copy()->addDays($i);
                    $dateStr = $date->format('Y-m-d');
                    $chartLabels[] = $date->format('d/m');
                    $chartDataCollection->put($dateStr, 0);
                }

                $groupedSales = Order::select(
                    DB::raw('DATE(created_at) as date_group'),
                    DB::raw('SUM(total_price) as total')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->groupBy('date_group')
                ->pluck('total', 'date_group');
            }

            foreach ($groupedSales as $dateGroup => $total) {
                if ($chartDataCollection->has($dateGroup)) {
                    $chartDataCollection[$dateGroup] = $total;
                }
            }

            $chartData = $chartDataCollection->values()->toArray();
        }

        // 4. Top 5 Best Selling Products (by Quantity)
        $topProductsQuery = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue'))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed');

        if ($startDate && $endDate) {
            $topProductsQuery->whereBetween('orders.created_at', [$startDate, $endDate]);
        }

        $topProducts = $topProductsQuery->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->take(5)
            ->get();

        // 5. Category Breakdown (by Revenue)
        $categoryRevenueQuery = Category::join('products', 'categories.id', '=', 'products.category_id')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed');

        if ($startDate && $endDate) {
            $categoryRevenueQuery->whereBetween('orders.created_at', [$startDate, $endDate]);
        }

        $categoryRevenue = $categoryRevenueQuery->select('categories.name', DB::raw('SUM(order_items.price * order_items.quantity) as revenue'))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('revenue')
            ->get();

        // 6. Order Status Distribution
        $statusCountsQuery = Order::select('status', DB::raw('count(*) as count'));
        if ($startDate && $endDate) {
            $statusCountsQuery->whereBetween('created_at', [$startDate, $endDate]);
        }
        $statusCounts = $statusCountsQuery->groupBy('status')
            ->get();

        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'chartData',
            'chartLabels',
            'topProducts',
            'categoryRevenue',
            'statusCounts',
            'period',
            'startDate',
            'endDate'
        ));
    }

    public function export(Request $request)
    {
        $period = $request->get('period', 'month');
        $startDate = null;
        $endDate = null;
        $now = Carbon::now();

        switch ($period) {
            case 'today':
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                break;
            case 'week':
                $startDate = $now->copy()->startOfWeek();
                $endDate = $now->copy()->endOfWeek();
                break;
            case 'quarter':
                $startDate = $now->copy()->firstOfQuarter();
                $endDate = $now->copy()->lastOfQuarter();
                break;
            case 'year':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfYear();
                break;
            case 'custom':
                if ($request->filled('start_date') && $request->filled('end_date')) {
                    $startDate = Carbon::parse($request->get('start_date'))->startOfDay();
                    $endDate = Carbon::parse($request->get('end_date'))->endOfDay();
                } else {
                    $startDate = $now->copy()->startOfMonth();
                    $endDate = $now->copy()->endOfMonth();
                }
                break;
            case 'month':
            default:
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                break;
        }

        $query = Order::with('user');
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        $ordersCursor = $query->orderBy('created_at', 'desc')->cursor();

        $fileName = 'bao-cao-doanh-thu-' . date('Y-md-His') . '.xls';

        $headers = [
            'Content-type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Mã Đơn', 'Khách Hàng', 'Ngày Đặt', 'Trạng Thái', 'Phương Thức TT', 'Tổng Tiền (VNĐ)'];

        $callback = function () use ($ordersCursor, $columns) {
            $file = fopen('php://output', 'w');

            // Generate HTML table for robust Excel column formatting
            fputs($file, '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">');
            fputs($file, '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>');
            fputs($file, '<body>');
            fputs($file, '<table border="1" style="border-collapse: collapse; width: 100%;">');

            // Header Row
            fputs($file, '<tr style="background-color: #f3f4f6; font-weight: bold; text-align: center;">');
            foreach ($columns as $column) {
                fputs($file, '<td style="padding: 10px;">' . $column . '</td>');
            }
            fputs($file, '</tr>');

            // Data Rows using cursor to save memory
            foreach ($ordersCursor as $order) {
                fputs($file, '<tr>');
                fputs($file, '<td style="padding: 8px; text-align: center;">#' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . '</td>');
                fputs($file, '<td style="padding: 8px;">' . e($order->name ?? ($order->user->name ?? 'Khách lẻ')) . '</td>');
                fputs($file, '<td style="padding: 8px; text-align: center;">' . $order->created_at->format('d/m/Y H:i') . '</td>');
                fputs($file, '<td style="padding: 8px; text-align: center;">' . ucfirst($order->status) . '</td>');
                fputs($file, '<td style="padding: 8px; text-align: center;">' . strtoupper($order->payment_method) . '</td>');
                fputs($file, '<td style="padding: 8px; text-align: right;">' . number_format($order->total_price, 0, ',', '.') . ' ₫</td>');
                fputs($file, '</tr>');
            }

            fputs($file, '</table>');
            fputs($file, '</body></html>');
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
