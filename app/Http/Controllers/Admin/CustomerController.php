<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sort = $request->get('sort', 'newest');
        
        $query = User::where('role', 'user')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            });

        // Xử lý sắp xếp
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'most_orders':
                $query->withCount('orders')->orderBy('orders_count', 'desc');
                break;
            case 'highest_spending':
                $query->withSum(['orders' => function($q) {
                    $q->where('status', 'completed');
                }], 'total_price')->orderBy('orders_sum_total_price', 'desc');
                break;
            case 'highest_single_purchase':
                $query->addSelect(['max_order_price' => \App\Models\Order::selectRaw('max(total_price)')
                    ->whereColumn('user_id', 'users.id')
                    ->where('status', 'completed')
                ])->orderBy('max_order_price', 'desc');
                break;
            default: // newest
                $query->latest();
                break;
        }

        $customers = $query->paginate(15)->withQueryString();

        return view('admin.customers.index', compact('customers', 'sort'));
    }

    /**
     * Display the specified customer profile and order history.
     */
    public function show(User $customer)
    {
        if ($customer->role !== 'user') {
            if ($customer->role !== 'user' && auth()->id() !== $customer->id) {
                abort(404);
            }
        }

        $customer->load(['orders' => function($query) {
            $query->latest();
        }, 'addresses']);

        $totalSpent = $customer->orders()->where('status', 'completed')->sum('total_price');
        $ordersCount = $customer->orders()->count();

        return view('admin.customers.show', compact('customer', 'totalSpent', 'ordersCount'));
    }

    /**
     * Reset customer password to 123456.
     */
    public function resetPassword(User $customer)
    {
        if ($customer->role !== 'user') {
            return back()->with('error', 'Không thể đặt lại mật khẩu cho tài khoản quản trị!');
        }

        $customer->update([
            'password' => \Illuminate\Support\Facades\Hash::make('123456')
        ]);

        return back()->with('success', 'Mật khẩu khách hàng ' . $customer->name . ' đã được đặt lại về "123456"!');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(User $customer)
    {
        if ($customer->role === 'admin') {
            return back()->with('error', 'Không thể xóa tài khoản quản trị!');
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Xóa khách hàng thành công!');
    }
}
