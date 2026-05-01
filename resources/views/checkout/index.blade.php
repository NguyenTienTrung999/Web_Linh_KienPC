@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
<main class="mx-auto max-w-7xl w-full px-4 md:px-10 py-8">
    <!-- Breadcrumbs -->
    <div class="flex items-center gap-2 mb-8 text-sm font-medium">
        <a class="text-primary hover:underline" href="{{ route('cart.index') }}">Giỏ hàng</a>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
        <span class="text-slate-900 dark:text-white">Thanh toán</span>
        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
        <span class="text-slate-400">Hoàn tất</span>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
        @csrf
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
                        <i class="fa-solid fa-truck text-primary"></i>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white uppercase tracking-wider">Thông tin giao hàng</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Họ và tên</label>
                            <input name="customer_name" value="{{ $defaultAddress->receiver_name ?? (auth()->user()->name ?? '') }}" required class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary transition-all px-4" placeholder="Nguyễn Văn A" type="text"/>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Số điện thoại</label>
                            <input name="customer_phone" value="{{ $defaultAddress->receiver_phone ?? (auth()->user()->phone ?? '') }}" required class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4" placeholder="0901 234 567" type="tel"/>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                            <input name="customer_email" value="{{ auth()->user()->email ?? '' }}" required class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4" placeholder="email@example.com" type="email"/>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Địa chỉ nhận hàng</label>
                            <input name="shipping_address" value="{{ $defaultAddress->address ?? (auth()->user()->address ?? '') }}" required class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4" placeholder="Số nhà, tên đường, phường/xã..." type="text"/>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Ghi chú (tùy chọn)</label>
                            <textarea name="note" class="w-full rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 py-2" rows="3" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian giao hàng..."></textarea>
                        </div>
                    </div>
                </section>

                <!-- Shipping Method Section -->
                <section class="bg-white dark:bg-slate-800/50 p-6 rounded-xl border border-primary/10 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fa-solid fa-bolt text-primary"></i>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white uppercase tracking-wider">Phương thức vận chuyển</h2>
                    </div>
                    <div class="space-y-3">
                        <label class="relative flex items-center p-4 rounded-lg border border-primary/20 bg-primary/5 cursor-pointer shipping-option">
                            <input checked name="shipping_method" value="standard" class="text-primary focus:ring-primary h-4 w-4" type="radio" onchange="updateTotals()"/>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between font-semibold">
                                    <span>Giao hàng tiêu chuẩn</span>
                                    <span>30.000₫</span>
                                </div>
                                <p class="text-sm text-slate-500">Dự kiến giao hàng trong 2-3 ngày làm việc</p>
                            </div>
                        </label>
                        <label class="relative flex items-center p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary/50 cursor-pointer shipping-option">
                            <input name="shipping_method" value="express" class="text-primary focus:ring-primary h-4 w-4" type="radio" onchange="updateTotals()"/>
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
                        <i class="fa-solid fa-money-bill-wave text-primary"></i>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white uppercase tracking-wider">Phương thức thanh toán</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary transition-all cursor-pointer group relative">
                            <input class="hidden peer" name="payment_method" value="banking" type="radio"/>
                            <i class="fa-solid fa-building-columns text-3xl mb-2 text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary"></i>
                            <span class="text-sm font-semibold">Chuyển khoản</span>
                            <div class="absolute inset-0 border-2 border-transparent peer-checked:border-primary rounded-lg pointer-events-none"></div>
                        </label>
                        <label class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary transition-all cursor-pointer group relative">
                            <input class="hidden peer" name="payment_method" value="card" type="radio"/>
                            <i class="fa-solid fa-credit-card text-3xl mb-2 text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary"></i>
                            <span class="text-sm font-semibold">Thẻ tín dụng</span>
                            <div class="absolute inset-0 border-2 border-transparent peer-checked:border-primary rounded-lg pointer-events-none"></div>
                        </label>
                        <label class="flex flex-col items-center justify-center p-4 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-primary transition-all cursor-pointer group relative">
                            <input checked class="hidden peer" name="payment_method" value="cod" type="radio"/>
                            <i class="fa-solid fa-hand-holding-dollar text-3xl mb-2 text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary"></i>
                            <span class="text-sm font-semibold">Thanh toán COD</span>
                            <div class="absolute inset-0 border-2 border-transparent peer-checked:border-primary rounded-lg pointer-events-none"></div>
                        </label>
                    </div>
                </section>
            </div>

            <!-- Right Column: Order Summary -->
            <aside class="w-full lg:w-[400px]">
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-primary/10 shadow-lg sticky top-24">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Tóm tắt đơn hàng</h2>
                    
                    <!-- Coupon Input -->
                    <div class="mb-6 pb-6 border-b border-slate-100 dark:border-slate-700">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Mã giảm giá</label>
                        <div class="flex gap-2">
                            <input type="text" id="coupon_code_input" value="{{ $coupon ? $coupon['code'] : '' }}" {{ $coupon ? 'disabled' : '' }} class="w-full h-11 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 uppercase text-sm font-bold text-slate-700 dark:text-white disabled:opacity-50" placeholder="Nhập mã...">
                            
                            @if($coupon)
                            <button type="button" onclick="removeCoupon()" class="px-4 h-11 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 font-bold transition-colors whitespace-nowrap border border-red-100 text-sm">
                                GỠ MÃ
                            </button>
                            @else
                            <button type="button" onclick="applyCoupon()" class="px-4 h-11 rounded-lg bg-slate-900 hover:bg-slate-800 dark:bg-slate-700 dark:hover:bg-slate-600 text-white font-bold transition-colors whitespace-nowrap text-sm">
                                ÁP DỤNG
                            </button>
                            @endif
                        </div>
                        <p id="coupon_message" class="text-xs mt-2 hidden"></p>
                    </div>

                    <!-- Product List -->
                    <div class="space-y-4 mb-6 pb-6 border-b border-slate-100 dark:border-slate-700 max-h-[400px] overflow-y-auto pr-2">
                        @foreach($cart as $id => $details)
                        <div class="flex gap-4">
                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-white flex-shrink-0 border border-slate-100">
                                <img class="w-full h-full object-contain p-1" src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://placehold.co/400x400?text=No+Image' }}" alt="{{ $details['name'] }}">
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xs font-bold text-slate-800 dark:text-slate-200 line-clamp-2">{{ $details['name'] }}</h3>
                                <div class="flex justify-between items-center mt-1">
                                    <p class="text-[10px] text-slate-500">SL: {{ $details['quantity'] }}</p>
                                    <p class="text-[16px] font-bold text-primary">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}₫</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Calculations -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm text-slate-600 dark:text-slate-400">
                            <span>Tạm tính</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ number_format($subtotal, 0, ',', '.') }}₫</span>
                        </div>
                        
                        @if($discount > 0)
                        <div class="flex justify-between text-sm text-green-600 font-bold">
                            <span>Giảm giá ({{ $coupon['code'] }})</span>
                            <span>-{{ number_format($discount, 0, ',', '.') }}₫</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-sm text-slate-600 dark:text-slate-400">
                            <span>Phí vận chuyển</span>
                            <span id="shipping-fee-text" class="font-bold text-slate-900 dark:text-white">30.000₫</span>
                        </div>
                        <div class="flex justify-between text-sm text-slate-600 dark:text-slate-400">
                            <span>Thuế (VAT 10%)</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ number_format($tax, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-slate-900 dark:text-white pt-3 border-t border-slate-100 dark:border-slate-700">
                            <span>Tổng cộng</span>
                            <span class="text-primary font-bold text-[16px]" id="grand-total-text">{{ number_format(max(0, $subtotal + $tax + 30000 - $discount), 0, ',', '.') }}₫</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-4 rounded-lg flex items-center justify-center gap-2 transition-all shadow-lg shadow-primary/20">
                        <i class="fa-solid fa-circle-check"></i>
                        HOÀN TẤT ĐẶT HÀNG
                    </button>
                    
                    <p class="text-[10px] text-center text-slate-400 mt-4 leading-relaxed">
                        Bằng cách nhấn đặt hàng, bạn đồng ý với Điều khoản dịch vụ và Chính sách bảo mật của TechFlow.
                    </p>
                </div>
            </aside>
        </div>
    </form>
</main>

<script>
    const subtotal = {{ $subtotal }};
    const tax = {{ $tax }};
    const discount = {{ $discount }};

    function updateTotals() {
        const shippingMethod = document.querySelector('input[name="shipping_method"]:checked').value;
        const shippingFee = shippingMethod === 'express' ? 65000 : 30000;
        let total = subtotal + tax + shippingFee - discount;
        if(total < 0) total = 0;

        document.getElementById('shipping-fee-text').innerText = shippingFee.toLocaleString('vi-VN') + '₫';
        document.getElementById('grand-total-text').innerText = total.toLocaleString('vi-VN') + '₫';

        // Update styling of shipping labels
        document.querySelectorAll('.shipping-option').forEach(el => {
            el.classList.remove('bg-primary/5', 'border-primary/20');
            el.classList.add('border-slate-200', 'dark:border-slate-700');
        });
        
        const activeOption = document.querySelector('input[name="shipping_method"]:checked').closest('.shipping-option');
        activeOption.classList.remove('border-slate-200', 'dark:border-slate-700');
        activeOption.classList.add('bg-primary/5', 'border-primary/20');
    }

    function applyCoupon() {
        const code = document.getElementById('coupon_code_input').value.trim();
        if (!code) return;

        fetch('{{ route('coupon.apply') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ coupon_code: code })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                const msg = document.getElementById('coupon_message');
                msg.textContent = data.message;
                msg.classList.remove('hidden', 'text-green-500');
                msg.classList.add('text-red-500');
            }
        })
        .catch(err => console.error(err));
    }

    function removeCoupon() {
        fetch('{{ route('coupon.remove') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(err => console.error(err));
    }
</script>
@endsection
