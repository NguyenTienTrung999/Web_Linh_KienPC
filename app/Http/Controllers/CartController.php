<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $id => $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }

        $coupon = session()->get('coupon');
        $discount = 0;
        if ($coupon) {
            $discount = $coupon['calculated_discount'] ?? 0;
        }

        $defaultAddress = null;
        if (auth()->check()) {
            $defaultAddress = auth()->user()->addresses()->where('is_default', true)->first();
        }

        return view('cart.index', compact('cart', 'subtotal', 'discount', 'coupon', 'defaultAddress'));
    }

    /**
     * Add a product to the cart via AJAX.
     */
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $color = $request->input('color');
        $cartKey = $color ? $product->id . '_' . $color : $product->id;

        if (isset($cart[$cartKey])) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm ' . ($color ? "màu $color " : "") . 'đã có trong giỏ hàng. Vui lòng vào giỏ hàng để chỉnh sửa số lượng.',
                'cartCount' => $this->getCartCount($cart),
                'cartTotal' => number_format($this->getCartTotal($cart), 0, ',', '.') . 'đ'
            ]);
        }

        $price = $product->sale_price ?: $product->price;

        $cart[$cartKey] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => $request->input('quantity', 1),
            "price" => $price,
            "image" => $product->image,
            "color" => $color
        ];

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
                'cartCount' => $this->getCartCount($cart),
                'cartTotal' => number_format($this->getCartTotal($cart), 0, ',', '.') . 'đ'
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    /**
     * Update product quantity in the cart via AJAX.
     */
    public function update(Request $request, $id)
    {
        if ($id && $request->quantity) {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);

                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Cập nhật giỏ hàng thành công!',
                        'cartCount' => $this->getCartCount($cart),
                        'itemTotal' => number_format($cart[$id]['price'] * $cart[$id]['quantity'], 0, ',', '.') . 'đ',
                        'cartTotal' => number_format($this->getCartTotal($cart), 0, ',', '.') . 'đ'
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    /**
     * Remove product from the cart via AJAX.
     */
    public function remove(Request $request, $id)
    {
        if ($id) {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
                    'cartCount' => $this->getCartCount($cart),
                    'cartTotal' => number_format($this->getCartTotal($cart), 0, ',', '.') . 'đ'
                ]);
            }
        }

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    /**
     * Clear the entire cart.
     */
    public function clear(Request $request)
    {
        session()->forget('cart');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã xóa toàn bộ giỏ hàng!',
                'cartCount' => 0,
                'cartTotal' => '0đ'
            ]);
        }

        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }

    /**
     * Helper to get cart total count (number of distinct products).
     */
    private function getCartCount($cart)
    {
        return count($cart);
    }

    /**
     * Helper to get cart total price.
     */
    private function getCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return $total;
    }
}
