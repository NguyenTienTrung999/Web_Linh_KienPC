<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders()->latest()->take(5)->get();
        return view('profile.index', compact('user', 'orders'));
    }

    public function orders()
    {
        $user = auth()->user();
        $orders = $user->orders()->latest()->paginate(10);
        return view('profile.orders', compact('user', 'orders'));
    }

    public function orderDetail(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $order->load(['items.product']);
        
        return response()->json([
            'order' => $order,
            'items' => $order->items
        ]);
    }

    public function updateOrder(Request $request, Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Only allow editing if pending or processing
        if (!in_array($order->status, ['pending', 'processing'])) {
            return response()->json(['error' => 'Không thể chỉnh sửa đơn hàng ở trạng thái này'], 422);
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
        ]);

        $order->update($validated);

        return response()->json(['success' => 'Cập nhật thông tin thành công']);
    }

    public function cancelOrder(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Only allow cancellation if pending
        if ($order->status !== 'pending') {
            return response()->json(['error' => 'Chỉ có thể hủy đơn hàng đang ở trạng thái Chờ xử lý'], 422);
        }

        $order->update(['status' => 'cancelled']);

        // Send Notification to user (optional, but good for consistency)
        $order->user->notify(new \App\Notifications\OrderStatusNotification($order, 'cancelled'));

        return response()->json(['success' => 'Đã hủy đơn hàng thành công']);
    }

    public function reorder(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        // Only allow reordering if cancelled
        if ($order->status !== 'cancelled') {
            return redirect()->back()->with('error', 'Chỉ có thể đặt lại đơn hàng đã hủy.');
        }

        // Restore status to pending
        $order->update(['status' => 'pending']);

        // Notify user about the restoration
        $order->user->notify(new \App\Notifications\OrderStatusNotification($order, 'pending'));

        return redirect()->back()->with('success', 'Đơn hàng #' . $order->id . ' đã được khôi phục thành công.');
    }

    public function notifications()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->latest()->paginate(10);
        
        // Mark as read when viewing
        $user->unreadNotifications->markAsRead();
        
        return view('profile.notifications', compact('user', 'notifications'));
    }

    public function indexAddresses()
    {
        $user = auth()->user();
        $addresses = $user->addresses()->latest()->get();
        return view('profile.addresses', compact('user', 'addresses'));
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'label' => 'nullable|string|max:50',
            'is_default' => 'nullable|boolean',
        ]);

        $user = auth()->user();
        
        // If this is the first address, make it default regardless
        if ($user->addresses()->count() === 0) {
            $validated['is_default'] = true;
        } elseif ($request->has('is_default') && $request->is_default) {
            // Unset other defaults
            $user->addresses()->update(['is_default' => false]);
        }

        $user->addresses()->create($validated);

        return back()->with('success', 'Địa chỉ đã được thêm mới!');
    }

    public function updateAddress(Request $request, UserAddress $address)
    {
        // Ensure user owns this address
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'label' => 'nullable|string|max:50',
            'is_default' => 'nullable|boolean',
        ]);

        if ($request->has('is_default') && $request->is_default) {
            auth()->user()->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        $address->update($validated);

        return back()->with('success', 'Cập nhật địa chỉ thành công!');
    }

    public function deleteAddress(UserAddress $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        // If deleting default, set another one as default if exists
        if ($address->is_default) {
            $address->delete();
            $newDefault = auth()->user()->addresses()->first();
            if ($newDefault) {
                $newDefault->update(['is_default' => true]);
            }
        } else {
            $address->delete();
        }

        return back()->with('success', 'Xóa địa chỉ thành công!');
    }

    public function setDefaultAddress(UserAddress $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        auth()->user()->addresses()->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        return back()->with('success', 'Đã đặt địa chỉ mặc định!');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'birthday' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'in:Nam,Nữ,Khác'],
        ]);

        $user->update($validated);

        return back()->with('status', 'profile-updated')->with('success', 'Thông tin đã được cập nhật thành công!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated')->with('success', 'Mật khẩu đã được thay đổi!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'], // 2MB Max
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $path]);
        }

        return back()->with('status', 'avatar-updated')->with('success', 'Ảnh đại diện đã được cập nhật!');
    }
}
