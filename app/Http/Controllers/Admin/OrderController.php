<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $sort = $request->get('sort', 'newest');
        $search = $request->get('search');

        $orders = Order::query()
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($search, function ($query, $search) {
                $cleanSearch = ltrim(trim($search), '#');
                return $query->where(function ($q) use ($cleanSearch, $search) {
                    if (is_numeric($cleanSearch)) {
                        $q->where('id', intval($cleanSearch));
                    }
                    $q->orWhere('customer_name', 'like', "%$search%")
                      ->orWhere('customer_phone', 'like', "%$search%");
                });
            })
            ->when($sort === 'oldest', function ($query) {
                return $query->oldest();
            }, function ($query) {
                return $query->latest();
            })
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'status', 'sort', 'search'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the status of the specified order.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,packing,shipping,completed,cancelled,failed,refunded',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        // Send Notification to user if order belongs to a registered user
        if ($order->user) {
            $order->user->notify(new \App\Notifications\OrderStatusNotification($order, $request->status));
        }

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
