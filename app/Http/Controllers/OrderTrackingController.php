<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('order-tracking.index');
    }

    public function track(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'email' => 'required|email',
        ]);

        // Support both #00000001 and 1 formats
        $orderId = preg_replace('/[^0-9]/', '', $request->order_id);

        $order = Order::where('id', $orderId)
            ->where('customer_email', $request->email)
            ->with(['items.product'])
            ->first();

        if (!$order) {
            return back()->with('error', 'Không tìm thấy đơn hàng với thông tin đã cung cấp. Vui lòng kiểm tra lại Mã đơn hàng hoặc Email.');
        }

        return view('order-tracking.index', compact('order'));
    }
}
