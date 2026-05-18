<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    private function authorizeOrderAccess(Order $order)
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) return true;
            if ($order->user_id === auth()->id()) return true;
        } else {
            // For guest orders, we check a specific session key set during checkout
            if (is_null($order->user_id) && Session::has('guest_order_' . $order->id)) return true;
        }
        return false;
    }

    public function invoice(Order $order)
    {
        if (!$this->authorizeOrderAccess($order)) {
            abort(403, 'Bạn không có quyền truy cập hóa đơn này.');
        }

        $order->load(['items.product']);
        $pdf = Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->download('invoice-' . str_pad($order->id, 8, '0', STR_PAD_LEFT) . '.pdf');
    }

    public function index()
    {
        return redirect()->route('cart.index');
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

            $subtotal = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            $coupon = session()->get('coupon');
            $discount = 0;
            $couponId = null;
            $couponCode = null;

            if ($coupon) {
                $discount = $coupon['calculated_discount'] ?? 0;
                $couponId = $coupon['id'];
                $couponCode = $coupon['code'];
            }

            $shipping_fee = $request->shipping_method === 'express' ? 65000 : 30000;
            $total_price = $subtotal + $shipping_fee - $discount;
            if ($total_price < 0) {
                $total_price = 0;
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'total_price' => $total_price,
                'coupon_id' => $couponId,
                'coupon_code' => $couponCode,
                'discount_amount' => $discount,
                'status' => $request->payment_method === 'cod' ? Order::STATUS_PROCESSING : Order::STATUS_PENDING,
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->shipping_address,
                'note' => $request->note,
            ]);

            // Increment used_count
            if ($couponId) {
                \App\Models\Coupon::where('id', $couponId)->increment('used_count');
            }

            foreach ($cart as $key => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $details['id'],
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'color' => $details['color'] ?? null,
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
                auth()->user()->notify(new \App\Notifications\OrderStatusNotification($order, $order->status));
            }

            // For banking: keep cart so user can go back. Cart cleared after payment confirmed.
            // For COD/card: clear cart immediately.
            if ($request->payment_method !== 'banking') {
                Session::forget('cart');
                Session::forget('coupon');
            }

            // Set session for guest so they can view confirmation and status
            if (!auth()->check()) {
                Session::put('guest_order_' . $order->id, true);
            }

            return redirect()->route('checkout.confirm', $order->id)->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function confirm(Order $order)
    {
        if (!$this->authorizeOrderAccess($order)) {
            abort(403, 'Bạn không có quyền xem thông tin đơn hàng này.');
        }

        return view('checkout.confirm', compact('order'));
    }

    /**
     * Get the JSON status of an order for polling.
     */
    public function getStatus(Order $order)
    {
        if (!$this->authorizeOrderAccess($order)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status' => $order->status,
        ]);
    }

    /**
     * Clear cart after banking payment confirmed (called via AJAX).
     */
    public function clearCartAfterPayment(Order $order)
    {
        if (!$this->authorizeOrderAccess($order)) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
        }

        if ($order->status !== 'pending') {
            Session::forget('cart');
            Session::forget('coupon');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
