<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $code = $request->coupon_code;
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không tồn tại!']);
        }

        if (!$coupon->is_active) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không còn hiệu lực!']);
        }

        $now = Carbon::now();
        if ($coupon->valid_from && $now->lt($coupon->valid_from)) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá chưa đến thời gian sử dụng!']);
        }

        if ($coupon->valid_to && $now->gt($coupon->valid_to)) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá đã hết hạn!']);
        }

        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá đã hết lượt sử dụng!']);
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng đang trống!']);
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        if ($subtotal < $coupon->min_order_value) {
            return response()->json(['success' => false, 'message' => 'Đơn hàng chưa đạt giá trị tối thiểu ' . number_format($coupon->min_order_value, 0, ',', '.') . 'đ để áp dụng mã này!']);
        }

        // Calculate discount amount immediately based on subtotal to return back to frontend if needed
        $discountAmount = 0;
        if ($coupon->discount_type === 'percent') {
            $discountAmount = $subtotal * ($coupon->discount_value / 100);
        } else {
            $discountAmount = $coupon->discount_value;
        }

        // Prevent discount from being greater than grand total (subtotal + max shipping)
        $maxTotal = $subtotal + 65000; // 65000 = highest shipping fee
        if ($discountAmount > $maxTotal) {
            $discountAmount = $maxTotal;
        }

        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount_value' => $coupon->discount_value,
            'discount_type' => $coupon->discount_type,
            'calculated_discount' => $discountAmount
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Áp dụng mã giảm giá thành công!',
        ]);
    }

    public function remove()
    {
        session()->forget('coupon');
        return response()->json([
            'success' => true, 
            'message' => 'Đã gỡ mã giảm giá!'
        ]);
    }
}
