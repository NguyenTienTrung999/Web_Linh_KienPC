@extends('layouts.app')

@section('title', 'Hồ sơ người dùng')

@section('content')
<main class="flex-1 w-full max-w-[1440px] mx-auto px-4 md:px-10 lg:px-40 py-8 min-h-[calc(100vh-200px)]">

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        @include('profile.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col gap-8">
            <!-- Profile Section -->
            <section class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 md:p-8">
                <div class="flex flex-col md:flex-row items-center gap-8 mb-10 pb-10 border-b border-slate-100 dark:border-slate-800">
                    <div class="relative group">
                        <div class="size-32 rounded-full border-4 border-slate-100 dark:border-slate-800 overflow-hidden bg-slate-200">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                <img alt="Placeholder" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"/>
                            @endif
                        </div>
                        <label for="avatar-input" class="absolute bottom-0 right-0 size-10 bg-primary text-white rounded-full flex items-center justify-center shadow-lg border-2 border-white dark:border-slate-900 cursor-pointer hover:scale-105 transition-transform">
                            <i class="fa-solid fa-camera text-lg"></i>
                        </label>
                        <form id="avatar-form" action="{{ route('profile.update-avatar') }}" method="POST" enctype="multipart/form-data" class="hidden">
                            @csrf
                            <input type="file" name="avatar" id="avatar-input" onchange="document.getElementById('avatar-form').submit()">
                        </form>
                    </div>
                    <div class="text-center md:text-left flex-1">
                        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</h1>
                        <p class="text-slate-500 mb-4">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                        <label for="avatar-input" class="inline-block px-6 py-2 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-sm font-semibold transition-colors cursor-pointer">Thay đổi ảnh đại diện</label>
                    </div>
                </div>

                <form action="{{ route('profile.update-info') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Họ và tên</label>
                            <input name="name" class="w-full rounded-lg @error('name') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" type="text" value="{{ old('name', $user->name) }}"/>
                            @error('name')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email</label>
                            <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 text-slate-500 cursor-not-allowed p-3" type="email" value="{{ $user->email }}" disabled/>
                            <p class="text-[10px] text-slate-400 mt-1">* Email không thể thay đổi</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Số điện thoại</label>
                            <input name="phone" class="w-full rounded-lg @error('phone') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" type="text" value="{{ old('phone', $user->phone) }}"/>
                            @error('phone')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Ngày sinh</label>
                            <input name="birthday" class="w-full rounded-lg @error('birthday') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" type="date" value="{{ old('birthday', $user->birthday) }}"/>
                            @error('birthday')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 block mb-2">Giới tính</label>
                            <div class="flex gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input name="gender" value="Nam" {{ old('gender', $user->gender) == 'Nam' ? 'checked' : '' }} class="text-primary focus:ring-primary" type="radio"/>
                                    <span class="text-sm">Nam</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input name="gender" value="Nữ" {{ old('gender', $user->gender) == 'Nữ' ? 'checked' : '' }} class="text-primary focus:ring-primary" type="radio"/>
                                    <span class="text-sm">Nữ</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input name="gender" value="Khác" {{ old('gender', $user->gender) == 'Khác' ? 'checked' : '' }} class="text-primary focus:ring-primary" type="radio"/>
                                    <span class="text-sm">Khác</span>
                                </label>
                            </div>
                            @error('gender')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Địa chỉ</label>
                            <textarea name="address" rows="2" class="w-full rounded-lg @error('address') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-10 flex justify-end">
                        <button type="submit" class="bg-primary hover:bg-primary/90 text-white font-bold py-3 px-10 rounded-lg shadow-lg shadow-primary/30 transition-all active:scale-95">
                            Lưu thông tin
                        </button>
                    </div>
                </form>
            </section>

            <!-- Security Section (Password) -->
            <section class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="size-10 rounded-lg bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 flex items-center justify-center">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h2 class="text-lg font-bold">Bảo mật tài khoản</h2>
                </div>
                
                <form action="{{ route('profile.update-password') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Mật khẩu hiện tại</label>
                            <input name="current_password" type="password" class="w-full rounded-lg @error('current_password') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" required/>
                            @error('current_password')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="hidden md:block"></div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Mật khẩu mới</label>
                            <input name="password" type="password" class="w-full rounded-lg @error('password') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" required/>
                            @error('password')
                                <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Xác nhận mật khẩu mới</label>
                            <input name="password_confirmation" type="password" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" required/>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-slate-900 dark:bg-white dark:text-slate-900 hover:opacity-90 text-white font-bold py-3 px-8 rounded-lg shadow-lg border border-slate-800 dark:border-slate-200 transition-all active:scale-95">
                            Cập nhật mật khẩu
                        </button>
                    </div>
                </form>
            </section>

            <!-- Order History Section -->
            <section class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                    <h2 class="text-lg font-bold">Lịch sử đơn hàng gần đây</h2>
                    <a class="text-primary text-sm font-medium hover:underline" href="#">Xem tất cả</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/50">
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Mã đơn hàng</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Ngày đặt</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Tổng tiền</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 text-center">Trạng thái</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 text-right">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($orders as $order)
                            <tr>
                                <td class="p-4 text-sm font-medium">#{{ $order->id }}</td>
                                <td class="p-4 text-sm text-slate-600 dark:text-slate-400">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="p-4 text-sm font-bold">{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                                <td class="p-4 text-center">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400',
                                            'processing' => 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
                                            'shipped' => 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400',
                                            'delivered' => 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400',
                                            'cancelled' => 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Chờ xử lý',
                                            'processing' => 'Đang xử lý',
                                            'shipped' => 'Đang giao',
                                            'delivered' => 'Đã giao',
                                            'cancelled' => 'Đã hủy',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full {{ $statusClasses[$order->status] ?? 'bg-slate-100 text-slate-600' }} text-xs font-bold">
                                        {{ $statusLabels[$order->status] ?? $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('order.status', $order->id) }}" class="text-primary hover:text-primary/80 transition-colors">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-500 italic">Bạn chưa có đơn hàng nào.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
