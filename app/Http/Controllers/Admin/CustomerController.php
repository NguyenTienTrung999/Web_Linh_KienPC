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
        
        $customers = User::where('role', 'user')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Display the specified customer profile and order history.
     */
    public function show(User $user)
    {
        if ($user->role !== 'user') {
            // Check if it's the admin themselves, maybe allow viewing but with a warning
            // For now, let's stick to 'user' role for the customer section
            if ($user->role !== 'user' && auth()->id() !== $user->id) {
                abort(404);
            }
        }

        $user->load(['orders' => function($query) {
            $query->latest();
        }, 'addresses']);

        $totalSpent = $user->orders()->where('status', 'completed')->sum('total_price');
        $ordersCount = $user->orders()->count();

        return view('admin.customers.show', compact('user', 'totalSpent', 'ordersCount'));
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Không thể xóa tài khoản quản trị!');
        }

        $user->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Xóa khách hàng thành công!');
    }
}
