@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
<main class="mx-auto max-w-7xl w-full px-4 md:px-10 py-8">
<!-- Breadcrumbs -->
<div class="flex items-center gap-2 mb-8 text-sm font-medium">
<a class="text-primary hover:underline" href="{{ route('cart.index') }}">Giỏ hàng</a>
<span class="text-slate-400 material-symbols-outlined text-xs">chevron_right</span>
<span class="text-slate-900 dark:text-white">Thanh toán</span>
<span class="text-slate-400 material-symbols-outlined text-xs">chevron_right</span>
<span class="text-slate-400">Hoàn tất</span>
</div>
<div class="flex flex-col lg:flex-row gap-8">
<!-- Left Column: Forms -->
<div class="flex-1 space-y-8">
<div>
<h1 class="text-3xl font-black text-slate-900 dark:text-white mb-2">Thanh toán</h1>
<p class="text-slate-500">Vui lòng kiểm tra lại thông tin trước khi hoàn tất đặt hàng.</p>
</div>
<!-- Shipping Info Section -->
<section class="bg-white dark:bg-slate-800/50 p-6 rounded-xl border border-primary/10 shadow-sm">
<div class="flex items-center gap-3 mb-6">
<span class="material-symbols-outlined text-primary">local_shipping</span>
<h2 class="text-lg font-bold text-slate-900 dark:text-white uppercase tracking-wider">Thông tin giao hàng</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="col-span-2">
<label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Họ và tên</label>
<input class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary transition-all px-4" placeholder="Nguyễn Văn A" type="text"/>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Số điện thoại</label>
<input class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4" placeholder="0901 234 567" type="tel"/>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Email</label>
<input class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4" placeholder="email@example.com" type="email"/>
</div>
<div class="col-span-2">
<label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Địa chỉ nhận hàng</label>
<input class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4" placeholder="Số nhà, tên đường, phường/xã..." type="text"/>
</div>
</div>
</section>
<!-- Shipping Method Section -->
<section class="bg-white dark:bg-slate-800/50 p-6 rounded-xl border border-primary/10 shadow-sm">
<div class="flex items-center gap-3 mb-6">
<span class="material-symbols-outlined text-primary">speed</span>
<h2 class="text-lg font-bold text-slate-900 dark:text-white uppercase tracking-wider">Phương thức vận chuyển</h2>
</div>
<div class="space-y-3">
<label class="relative flex items-center p-4 rounded-lg border border-primary/20 bg-primary/5 cursor-pointer">
<input checked="" class="text-primary focus:ring-primary h-4 w-4" name="shipping" type="radio"/>
<div class="ml-4 flex-1">
<div class="flex justify-between font-semibold">
<span>Giao hàng tiêu chuẩn</span>
<span>30.000₫</span>
</div>
<p class="text-sm text-slate-500">Dự kiến giao hàng trong 2-3 ngày làm việc</p>
</div>
</label>
<label class="relative flex items-center p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary/50 cursor-pointer">
<input class="text-primary focus:ring-primary h-4 w-4" name="shipping" type="radio"/>
<div class="ml-4 flex-1">
<div class="flex justify-between font-semibold">
<span>Giao hàng hỏa tốc</span>
<span>65.000₫</span>
</div>
<p class="text-sm text-slate-500">Nhận hàng trong vòng 2-4 giờ tại nội thành</p>
</div>
</label>
</div>
</section>
<!-- Payment Method Section -->
<section class="bg-white dark:bg-slate-800/50 p-6 rounded-xl border border-primary/10 shadow-sm">
<div class="flex items-center gap-3 mb-6">
<span class="material-symbols-outlined text-primary">payments</span>
<h2 class="text-lg font-bold text-slate-900 dark:text-white uppercase tracking-wider">Phương thức thanh toán</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<label class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary transition-all cursor-pointer group">
<input class="hidden peer" name="payment" type="radio"/>
<span class="material-symbols-outlined text-3xl mb-2 text-slate-400 group-hover:text-primary transition-colors">account_balance</span>
<span class="text-sm font-semibold">Chuyển khoản</span>
<div class="peer-checked:bg-primary absolute inset-0 border-2 border-transparent peer-checked:border-primary rounded-lg pointer-events-none"></div>
</label>
<label class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary transition-all cursor-pointer group">
<input class="hidden peer" name="payment" type="radio"/>
<span class="material-symbols-outlined text-3xl mb-2 text-slate-400 group-hover:text-primary transition-colors">credit_card</span>
<span class="text-sm font-semibold">Thẻ tín dụng</span>
<div class="peer-checked:bg-primary absolute inset-0 border-2 border-transparent peer-checked:border-primary rounded-lg pointer-events-none"></div>
</label>
<label class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary transition-all cursor-pointer group">
<input checked="" class="hidden peer" name="payment" type="radio"/>
<span class="material-symbols-outlined text-3xl mb-2 text-primary">payments</span>
<span class="text-sm font-semibold">Thanh toán COD</span>
<div class="absolute inset-0 border-2 border-primary rounded-lg pointer-events-none"></div>
</label>
</div>
</section>
</div>
<!-- Right Column: Order Summary -->
<aside class="w-full lg:w-[400px]">
<div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-primary/10 shadow-lg sticky top-24">
<h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Tóm tắt đơn hàng</h2>
<!-- Product List -->
<div class="space-y-4 mb-6 pb-6 border-b border-slate-100 dark:border-slate-700">
<div class="flex gap-4">
<div class="w-20 h-20 rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-900 flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="NVIDIA GeForce RTX 4080 Graphics Card" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBdf4kCXfLq-8BUcoHf34TPSAv9X69afC4nEDX78EC41hTqPWsoiIzqqLQYflKtOkS0Z39rdlK9MZiFdeRHfxMppinXpnwLEuBl7gAVG1rUwhsrvD44zEp9UTJKlcyBBdwEGCAeDP-OTg5zdqwYLCjxJUc7vMecgFcGPaHU6MmsN77KgyFdggPS9tM69ruF9rE7KALKNN2KMy0uZfNM5_0lrGHbzUQ8n4MlWYPsCMNpVUjljsLV2tZ8N5tycnOmMOQV45rLmsX_Dqc"/>
</div>
<div class="flex-1">
<h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 line-clamp-2">Card màn hình ASUS ROG Strix GeForce RTX 4080 OC Edition</h3>
<p class="text-xs text-slate-500 mt-1">Số lượng: 1</p>
<p class="text-sm font-bold text-primary mt-1">32.500.000₫</p>
</div>
</div>
<div class="flex gap-4">
<div class="w-20 h-20 rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-900 flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="AMD Ryzen 9 Processor Box" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCigKg7S0euEELL3-JeCqXdITlxGT57EHIsSO1_Wb3jxqnbzjea3VSluc_9A-0_KP7BTOJoqHcc8rGeWvIn-z7Omg3XDrlFl2-Ry1m7ZECbZVQH0b1XMyadQ08fuo_b1S8mydERsiMAn52P_HDJj7gsUilu46zoVhEe1z98mVXD3as28qfBDixgLkcrRCFWysi2Z0gUFS97c1EAMd314kjG0dvpJES9aEcqhGjZBq6dA5rHUX6ND4pBOo1UTDOpPfKEI2aJswer3Mc"/>
</div>
<div class="flex-1">
<h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 line-clamp-2">CPU AMD Ryzen 9 7950X - 16 Nhân 32 Luồng</h3>
<p class="text-xs text-slate-500 mt-1">Số lượng: 1</p>
<p class="text-sm font-bold text-primary mt-1">15.900.000₫</p>
</div>
</div>
</div>
<!-- Calculations -->
<div class="space-y-3 mb-6">
<div class="flex justify-between text-slate-600 dark:text-slate-400">
<span>Tạm tính</span>
<span>48.400.000₫</span>
</div>
<div class="flex justify-between text-slate-600 dark:text-slate-400">
<span>Phí vận chuyển</span>
<span>30.000₫</span>
</div>
<div class="flex justify-between text-slate-600 dark:text-slate-400">
<span>Thuế (VAT 10%)</span>
<span>4.843.000₫</span>
</div>
<div class="flex justify-between text-xl font-black text-slate-900 dark:text-white pt-3 border-t border-slate-100 dark:border-slate-700">
<span>Tổng cộng</span>
<span class="text-primary">53.273.000₫</span>
</div>
</div>
<!-- Action Button -->
<a href="{{ route('checkout.confirm') }}" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-lg flex items-center justify-center gap-2 transition-all shadow-lg shadow-primary/20">
<span class="material-symbols-outlined">verified_user</span>
                                HOÀN TẤT ĐẶT HÀNG
                            </a>
<p class="text-[10px] text-center text-slate-400 mt-4 leading-relaxed">
                                Bằng cách nhấn đặt hàng, bạn đồng ý với Điều khoản dịch vụ và Chính sách bảo mật của TechFlow.
                            </p>
</div>
</aside>
</div>
</main>
@endsection
