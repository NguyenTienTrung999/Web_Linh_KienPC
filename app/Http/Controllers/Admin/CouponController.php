<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::query();
        if ($request->has('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }
        $coupons = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code|max:50',
            'discount_value' => 'required|numeric|min:0',
            'discount_type' => 'required|in:fixed,percent',
            'min_order_value' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['min_order_value'] = $validated['min_order_value'] ?? 0;

        Coupon::create($validated);

        return redirect()->route('admin.coupons.index')->with('success', 'Đã thêm mã giảm giá mới!');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'discount_value' => 'required|numeric|min:0',
            'discount_type' => 'required|in:fixed,percent',
            'min_order_value' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['min_order_value'] = $validated['min_order_value'] ?? 0;

        $coupon->update($validated);

        return redirect()->route('admin.coupons.index')->with('success', 'Đã cập nhật mã giảm giá!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Đã xóa mã giảm giá!');
    }
}
