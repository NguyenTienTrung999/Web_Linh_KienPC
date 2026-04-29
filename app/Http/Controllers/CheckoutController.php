<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $subtotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $tax = $subtotal * 0.1; // 10% VAT
        
        $defaultAddress = null;
        if (auth()->check()) {
            $defaultAddress = auth()->user()->addresses()->where('is_default', true)->first();
        }
        
        return view('checkout.index', compact('cart', 'subtotal', 'tax', 'defaultAddress'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống!');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
            'shipping_method' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));
            
            $shipping_fee = $request->shipping_method === 'express' ? 65000 : 30000;
            $tax = $subtotal * 0.1;
            $total_price = $subtotal + $tax + $shipping_fee;

            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'total_price' => $total_price,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->shipping_address,
                'note' => $request->note,
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            // Auto-save address if user's address book is empty
            if (auth()->check()) {
                $user = auth()->user();
                if ($user->addresses()->count() === 0) {
                    $user->addresses()->create([
                        'receiver_name' => $request->customer_name,
                        'receiver_phone' => $request->customer_phone,
                        'address' => $request->shipping_address,
                        'label' => 'Mặc định',
                        'is_default' => true,
                    ]);
                }
            }

            DB::commit();
            
            // Send Notification to user
            if (auth()->check()) {
                auth()->user()->notify(new \App\Notifications\OrderStatusNotification($order, 'pending'));
            }

            // Clear cart
            Session::forget('cart');

            return redirect()->route('checkout.confirm', $order->id)->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function confirm(Order $order)
    {
        // For guests, we might want to check session to ensure they just placed this order
        // but for a demo, we'll just show the order details.
        return view('checkout.confirm', compact('order'));
    }

    /**
     * Get the JSON status of an order for polling.
     */
    public function getStatus(Order $order)
    {
        return response()->json([
            'status' => $order->status
        ]);
    }
}
