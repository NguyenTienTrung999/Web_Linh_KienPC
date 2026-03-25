@extends('layouts.app')

@section('title', 'Hồ sơ người dùng')

@section('content')
<main class="flex-1 w-full max-w-[1440px] mx-auto px-4 md:px-10 lg:px-40 py-8 min-h-[calc(100vh-200px)]">
<div class="flex flex-col lg:flex-row gap-8">
<!-- Sidebar -->
<aside class="w-full lg:w-64 flex flex-col gap-2">
<div class="p-4 mb-4 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 flex items-center gap-3">
<div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-2xl">verified_user</span>
</div>
<div>
<p class="font-bold text-sm">Nguyễn Văn A</p>
<p class="text-xs text-slate-500">Thành viên Vàng</p>
</div>
</div>
<nav class="flex flex-col gap-1">
<a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium shadow-md shadow-primary/20" href="#">
<span class="material-symbols-outlined text-xl">person</span>
<span class="text-sm">Thông tin cá nhân</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 font-medium transition-all group" href="#">
<span class="material-symbols-outlined text-xl group-hover:text-primary">package</span>
<span class="text-sm group-hover:text-primary">Đơn hàng của tôi</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 font-medium transition-all group" href="#">
<span class="material-symbols-outlined text-xl group-hover:text-primary">location_on</span>
<span class="text-sm group-hover:text-primary">Sổ địa chỉ</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 font-medium transition-all group" href="#">
<span class="material-symbols-outlined text-xl group-hover:text-primary">notifications</span>
<span class="text-sm group-hover:text-primary">Thông báo</span>
</a>
<div class="my-2 border-t border-slate-200 dark:border-slate-800"></div>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 text-red-500 font-medium transition-all">
        <span class="material-symbols-outlined text-xl">logout</span>
        <span class="text-sm">Đăng xuất</span>
    </button>
</form>
</nav>
</aside>
<!-- Main Content -->
<div class="flex-1 flex flex-col gap-8">
<!-- Profile Section -->
<section class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 md:p-8">
<div class="flex flex-col md:flex-row items-center gap-8 mb-10 pb-10 border-b border-slate-100 dark:border-slate-800">
<div class="relative">
<div class="size-32 rounded-full border-4 border-slate-100 dark:border-slate-800 overflow-hidden bg-slate-200" data-alt="Ảnh đại diện người dùng kích thước lớn">
<img alt="Large Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjJushzwzh1KSVe3CyT2ldeurTKFIkKSllBIdfTH1-CxahlyFqpBORL7n1sYpGCkOGsw1hMKvRMjXJ_XxLAsFl2uiSchlV_V3ASDENuwIJh2xbkVu0o-MruLyubV-hqpwgGuFzinY0NvJZcx433ep0UorrftcMniUphk5RoqU_6doBDzXG9P0uI49iEhg2zt5X6f12bov9QiWZwA8lqO1bMqvca43n2g8b36BMMSNhxfDO65obVfMzSYryoBCOh7F1d7Tkbl-sW10"/>
</div>
<button class="absolute bottom-0 right-0 size-10 bg-primary text-white rounded-full flex items-center justify-center shadow-lg border-2 border-white dark:border-slate-900 hover:scale-105 transition-transform">
<span class="material-symbols-outlined text-xl">photo_camera</span>
</button>
</div>
<div class="text-center md:text-left flex-1">
<h1 class="text-2xl font-bold text-slate-900 dark:text-white">Nguyễn Văn A</h1>
<p class="text-slate-500 mb-4">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
<button class="px-6 py-2 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-sm font-semibold transition-colors">Thay đổi ảnh đại diện</button>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Họ và tên</label>
<input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" type="text" value="Nguyễn Văn A"/>
</div>
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email</label>
<input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" type="email" value="nguyenvan@example.com"/>
</div>
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Số điện thoại</label>
<input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" type="text" value="0901 234 567"/>
</div>
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Ngày sinh</label>
<input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-primary p-3" type="date" value="1995-05-15"/>
</div>
<div class="space-y-2 md:col-span-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300 block mb-2">Giới tính</label>
<div class="flex gap-6">
<label class="flex items-center gap-2 cursor-pointer">
<input checked="" class="text-primary focus:ring-primary" name="gender" type="radio"/>
<span class="text-sm">Nam</span>
</label>
<label class="flex items-center gap-2 cursor-pointer">
<input class="text-primary focus:ring-primary" name="gender" type="radio"/>
<span class="text-sm">Nữ</span>
</label>
<label class="flex items-center gap-2 cursor-pointer">
<input class="text-primary focus:ring-primary" name="gender" type="radio"/>
<span class="text-sm">Khác</span>
</label>
</div>
</div>
</div>
<div class="mt-10 flex justify-end">
<button class="bg-primary hover:bg-primary/90 text-white font-bold py-3 px-10 rounded-lg shadow-lg shadow-primary/30 transition-all active:scale-95">
                                Lưu thay đổi
                            </button>
</div>
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
<th class="p-4 text-xs font-bold uppercase text-slate-500">Sản phẩm</th>
<th class="p-4 text-xs font-bold uppercase text-slate-500">Tổng tiền</th>
<th class="p-4 text-xs font-bold uppercase text-slate-500 text-center">Trạng thái</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100 dark:divide-slate-800">
<tr>
<td class="p-4 text-sm font-medium">#TF-9021</td>
<td class="p-4 text-sm text-slate-600 dark:text-slate-400">12/03/2024</td>
<td class="p-4 text-sm text-slate-600 dark:text-slate-400">Card màn hình ASUS RTX 4070 Ti...</td>
<td class="p-4 text-sm font-bold">24.500.000đ</td>
<td class="p-4 text-center">
<span class="px-2.5 py-1 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 text-xs font-bold">Đang giao</span>
</td>
</tr>
<tr>
<td class="p-4 text-sm font-medium">#TF-8845</td>
<td class="p-4 text-sm text-slate-600 dark:text-slate-400">28/02/2024</td>
<td class="p-4 text-sm text-slate-600 dark:text-slate-400">Chuột Razer DeathAdder V3 Pro</td>
<td class="p-4 text-sm font-bold">3.200.000đ</td>
<td class="p-4 text-center">
<span class="px-2.5 py-1 rounded-full bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold">Hoàn thành</span>
</td>
</tr>
<tr>
<td class="p-4 text-sm font-medium">#TF-8712</td>
<td class="p-4 text-sm text-slate-600 dark:text-slate-400">15/02/2024</td>
<td class="p-4 text-sm text-slate-600 dark:text-slate-400">Bàn phím cơ Keychron K2V2</td>
<td class="p-4 text-sm font-bold">1.850.000đ</td>
<td class="p-4 text-center">
<span class="px-2.5 py-1 rounded-full bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold">Hoàn thành</span>
</td>
</tr>
</tbody>
</table>
</div>
</section>
</div>
</div>
</main>
@endsection
