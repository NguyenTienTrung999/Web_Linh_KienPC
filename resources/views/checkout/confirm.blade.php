@extends('layouts.app')

@section('title', 'Xác nhận đặt hàng')

@section('content')
<main class="flex flex-1 justify-center py-8 px-4">
<div class="layout-content-container flex flex-col max-w-[800px] flex-1">
<!-- Success Hero Section -->
<div class="flex flex-col items-center justify-center py-10 px-4 bg-white dark:bg-slate-900 rounded-xl shadow-sm mb-6 border border-slate-100 dark:border-slate-800">
<div class="mb-6 flex items-center justify-center size-20 rounded-full bg-primary/10 text-primary">
<span class="material-symbols-outlined text-6xl">check_circle</span>
</div>
<h1 class="text-slate-900 dark:text-slate-100 tracking-tight text-3xl font-bold leading-tight text-center pb-2">Đặt hàng thành công!</h1>
<h2 class="text-primary text-lg font-semibold leading-tight tracking-[-0.015em] text-center pb-4">Mã đơn hàng: #TF-123456</h2>
<p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-relaxed max-w-md text-center">
                        Cảm ơn bạn đã mua sắm tại TechFlow. Chúng tôi đã nhận được đơn hàng của bạn và đang chuẩn bị vận chuyển.
                    </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Order Summary -->
<div class="bg-white dark:bg-slate-900 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
<h3 class="text-slate-900 dark:text-slate-100 text-lg font-bold mb-4 flex items-center gap-2">
<span class="material-symbols-outlined text-primary">shopping_cart</span>
                            Tóm tắt đơn hàng
                        </h3>
<div class="space-y-4">
<div class="flex items-center gap-3">
<div class="size-16 rounded bg-slate-100 dark:bg-slate-800 overflow-hidden shrink-0">
<img class="w-full h-full object-cover" data-alt="NVIDIA GeForce RTX 4080 Graphics Card" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBkwItD6iGmQEvrhgaCTVNyLi4eui2qLLbq4__J7vT7rrf2VCAvLyxf8XcERXizoV19fodXVFvcAR1rpLsDop7zvbe-tBiL57MVq6wUqlFtwjhAJ75shRo-h5-h4a41KFfk_Pn3_pTQLG0p3AIgwY-6wkDb2FCfteHWL0n9tJ4T1BDx9WSPOzQCaouEuLAg3nYOVMoM3n0gC0iwSP_Pckgl0ZPKqYhn9j8-pV7-IGRQZ0K5lKaCmHx5FfqxN9JoJaMuw4hIUM9mI9c"/>
</div>
<div class="flex-1">
<p class="text-sm font-semibold text-slate-900 dark:text-slate-100">NVIDIA GeForce RTX 4080</p>
<p class="text-xs text-slate-500 dark:text-slate-400">Số lượng: 1</p>
</div>
<p class="text-sm font-bold text-slate-900 dark:text-slate-100">28.990.000đ</p>
</div>
<div class="flex items-center gap-3">
<div class="size-16 rounded bg-slate-100 dark:bg-slate-800 overflow-hidden shrink-0">
<img class="w-full h-full object-cover" data-alt="AMD Ryzen 9 Processor Box" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBB6zbjeGIg1M4mGqlxuOnGYrHSBWRLWuuaxRCtmAdFxAZfKLqjRN417vh8FO9oFJu80zb4s58iVZd9eYVkKnfGa1MmpOkXwlM8Rg_0_I7Zctc3voNqRjD2ydsXBBd0_d7V0mZVlWSLlOTALwrUpSRZjuMzv8qEtaRUYovqbRKixEtF3ud9dld2C_9hiELrkmMkuZ4vuQLR0bopkybWcWv11VcljgQEcIDdru066HtH_qj1hx-A3nblgriX-q8SOYpRJY6g-qHbuRU"/>
</div>
<div class="flex-1">
<p class="text-sm font-semibold text-slate-900 dark:text-slate-100">AMD Ryzen 9 7950X</p>
<p class="text-xs text-slate-500 dark:text-slate-400">Số lượng: 1</p>
</div>
<p class="text-sm font-bold text-slate-900 dark:text-slate-100">14.500.000đ</p>
</div>
</div>
<div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800">
<div class="flex justify-between text-sm mb-2 text-slate-600 dark:text-slate-400">
<span>Tạm tính</span>
<span>43.490.000đ</span>
</div>
<div class="flex justify-between text-sm mb-2 text-slate-600 dark:text-slate-400">
<span>Phí vận chuyển</span>
<span class="text-green-500">Miễn phí</span>
</div>
<div class="flex justify-between text-lg font-bold text-slate-900 dark:text-slate-100 pt-2">
<span>Tổng cộng</span>
<span class="text-primary">43.490.000đ</span>
</div>
</div>
</div>
<!-- Shipping Info -->
<div class="bg-white dark:bg-slate-900 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
<h3 class="text-slate-900 dark:text-slate-100 text-lg font-bold mb-4 flex items-center gap-2">
<span class="material-symbols-outlined text-primary">local_shipping</span>
                            Thông tin vận chuyển
                        </h3>
<div class="space-y-4">
<div>
<p class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-bold">Người nhận</p>
<p class="text-slate-900 dark:text-slate-100 font-medium">Nguyễn Văn An</p>
<p class="text-sm text-slate-600 dark:text-slate-400">090 123 4567</p>
</div>
<div>
<p class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-bold">Địa chỉ giao hàng</p>
<p class="text-sm text-slate-600 dark:text-slate-400">123 Đường Lê Lợi, Phường Bến Thành, Quận 1, TP. Hồ Chí Minh</p>
</div>
<div>
<p class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-bold">Phương thức thanh toán</p>
<p class="text-sm text-slate-600 dark:text-slate-400">Thanh toán qua Thẻ tín dụng (Visa/Mastercard)</p>
</div>
<div>
<p class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-bold">Thời gian dự kiến</p>
<p class="text-sm text-slate-900 dark:text-slate-100 font-medium flex items-center gap-1">
<span class="material-symbols-outlined text-sm">calendar_today</span>
                                    Giao hàng từ 2-3 ngày làm việc
                                </p>
</div>
</div>
</div>
</div>
<!-- Actions -->
<div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
<a href="{{ route('home') }}" class="flex items-center justify-center gap-2 px-8 py-3 rounded-lg bg-primary text-white font-bold transition-opacity hover:opacity-90 min-w-[200px]">
<span class="material-symbols-outlined">shopping_bag</span>
                        Tiếp tục mua sắm
                    </a>
<a href="{{ route('profile.index') }}" class="flex items-center justify-center gap-2 px-8 py-3 rounded-lg bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-bold transition-colors hover:bg-slate-300 dark:hover:bg-slate-700 min-w-[200px]">
<span class="material-symbols-outlined">history</span>
                        Xem lịch sử đơn hàng
                    </a>
</div>
<!-- Map/Location Placeholder -->
<div class="mt-12 rounded-xl overflow-hidden h-48 relative border border-slate-100 dark:border-slate-800">
<div class="absolute inset-0 bg-primary/5 flex items-center justify-center">
<div class="text-center">
<span class="material-symbols-outlined text-primary text-4xl mb-2">map</span>
<p class="text-sm text-slate-500 dark:text-slate-400">Theo dõi hành trình đơn hàng của bạn</p>
</div>
</div>
<img class="w-full h-full object-cover opacity-30 mix-blend-multiply dark:mix-blend-overlay" data-alt="Stylized blue digital map of a city" data-location="Ho Chi Minh City" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_8I1IDCQmJ-PGk4SPlkIUqiHrtAAVRWnipuymJCqLBLHTFn7XQNAKoYJo6jOL84VRkBFVTAlS8ENAQxX8EtyxX_VfbDT5jLQT2dhEkF1rkKIFSBuSQZrzeJmQCoaYcpHVeQv_pUgyoG26mVQ2xVkXEOzwX59BTf5cn-hCSTTTIhQz2o0oDIBQ-RT_Exb6taJe4pzGebAz7YPLmEQoq97IqCkopRFiVDZx9-DMrnlHkJMhx5Mb9cJ04ag4MKfyfcuJ4IpQQJz5Wlk"/>
</div>
</div>
</main>
@endsection
