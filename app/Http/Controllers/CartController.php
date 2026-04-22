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
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart via AJAX.
     */
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm đã có trong giỏ hàng vui lòng vào giỏ hàng để thêm số lượng',
                'cartCount' => $this->getCartCount($cart),
                'cartTotal' => number_format($this->getCartTotal($cart), 0, ',', '.') . 'đ'
            ]);
        }

        $price = $product->sale_price ?: $product->price;

        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $price,
            "image" => $product->image
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
    public function update(Request $request, Product $product)
    {
        if ($product->id && $request->quantity) {
            $cart = session()->get('cart', []);
            $cart[$product->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật giỏ hàng thành công!',
                    'cartCount' => $this->getCartCount($cart),
                    'itemTotal' => number_format($cart[$product->id]['price'] * $cart[$product->id]['quantity'], 0, ',', '.') . 'đ',
                    'cartTotal' => number_format($this->getCartTotal($cart), 0, ',', '.') . 'đ'
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    /**
     * Remove product from the cart via AJAX.
     */
    public function remove(Request $request, Product $product)
    {
        if ($product->id) {
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                unset($cart[$product->id]);
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
