@extends('layouts.app')

@section('title', 'Thông tin giỏ hàng')

@section('content')
<main class="max-w-7xl mx-auto w-full px-6 lg:px-20 py-10 flex-1 bg-slate-50 dark:bg-slate-900">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-6 text-sm text-slate-500">
        <a class="hover:text-primary" href="{{ route('home') }}">Trang chủ</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-slate-900 dark:text-slate-100 font-medium">Thông tin giỏ hàng</span>
    </div>
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-primary">Giỏ hàng</h1>
        @if(count($cart) > 0)
        <button onclick="clearCart()" class="text-red-500 hover:text-red-600 text-sm font-medium">Xóa toàn bộ giỏ hàng</button>
        @endif
    </div>

    @if(count($cart) > 0)
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mb-8 overflow-hidden">
        <!-- Desktop Table: Visible on md screens and up -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left min-w-[700px]">
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($cart as $id => $details)
                    <tr class="cart-item group" data-id="{{ $id }}">
                        <td class="p-4 w-24">
                            <div class="h-16 w-16 border border-slate-100 dark:border-slate-700 p-1 flex-shrink-0">
                                <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://placehold.co/200x200?text=No+Image' }}" class="h-full w-full object-contain">
                            </div>
                        </td>
                        <td class="p-4 max-w-[300px]">
                            <p class="font-bold text-slate-900 dark:text-slate-100 text-sm">{{ $details['name'] }}</p>
                            <div class="flex flex-col gap-1 mt-1">
                                @if(isset($details['color']) && $details['color'])
                                    <p class="text-xs text-slate-500">Màu sắc: <span class="text-primary font-bold">{{ $details['color'] }}</span></p>
                                @endif
                                <p class="text-xs text-slate-500">Bảo hành: <span class="text-primary font-medium">36 Tháng</span></p>
                            </div>
                        </td>
                        <td class="p-4 text-right">
                            <p class="font-bold text-slate-900 dark:text-slate-100 whitespace-nowrap text-sm">{{ number_format($details['price'], 0, ',', '.') }} VNĐ</p>
                        </td>
                        <td class="p-4 w-32">
                            <div class="flex items-center justify-center">
                                <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded bg-slate-50 dark:bg-slate-900 h-8">
                                    <button onclick="updateQuantity('{{ $id }}', -1)" class="w-8 h-full text-slate-500 hover:text-slate-700 flex items-center justify-center">
                                        <i class="fa-solid fa-minus text-[10px]"></i>
                                    </button>
                                    <input type="text" class="w-8 text-center text-sm bg-transparent border-none focus:ring-0 item-quantity p-0 font-medium text-slate-900 dark:text-white pointer-events-none" value="{{ $details['quantity'] }}" readonly>
                                    <button onclick="updateQuantity('{{ $id }}', 1)" class="w-8 h-full text-slate-500 hover:text-slate-700 flex items-center justify-center">
                                        <i class="fa-solid fa-plus text-[10px]"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-right">
                            <p class="font-bold text-slate-900 dark:text-slate-100 whitespace-nowrap item-total text-sm">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }} VNĐ</p>
                        </td>
                        <td class="p-4 text-center w-12">
                            <button onclick="removeFromCart('{{ $id }}')" class="text-slate-400 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-50 dark:hover:bg-red-900/20">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Layout: Visible only on mobile screens -->
        <div class="block md:hidden divide-y divide-slate-100 dark:divide-slate-700">
            @foreach($cart as $id => $details)
            <div class="p-4 flex gap-4 cart-item" data-id="{{ $id }}">
                <div class="h-16 w-16 border border-slate-100 dark:border-slate-700 p-1 flex-shrink-0 bg-white dark:bg-slate-900 rounded-lg">
                    <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://placehold.co/200x200?text=No+Image' }}" class="h-full w-full object-contain">
                </div>
                
                <div class="flex-grow min-w-0 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start gap-2">
                            <p class="font-bold text-slate-900 dark:text-slate-100 text-sm line-clamp-2 leading-snug">{{ $details['name'] }}</p>
                            <button onclick="removeFromCart('{{ $id }}')" class="text-slate-400 hover:text-red-500 transition-colors p-1 shrink-0">
                                <i class="fa-regular fa-trash-can text-sm"></i>
                            </button>
                        </div>
                        <div class="flex flex-col gap-0.5 mt-1">
                            @if(isset($details['color']) && $details['color'])
                                <p class="text-[11px] text-slate-500">Màu sắc: <span class="text-primary font-bold">{{ $details['color'] }}</span></p>
                            @endif
                            <p class="text-[11px] text-slate-500">Bảo hành: <span class="text-primary font-medium">36 Tháng</span></p>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mt-3 gap-2">
                        <!-- Quantity Controller -->
                        <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded bg-slate-50 dark:bg-slate-900 h-7">
                            <button onclick="updateQuantity('{{ $id }}', -1)" class="w-7 h-full text-slate-500 hover:text-slate-700 flex items-center justify-center">
                                <i class="fa-solid fa-minus text-[9px]"></i>
                            </button>
                            <input type="text" class="w-7 text-center text-xs bg-transparent border-none focus:ring-0 item-quantity p-0 font-bold text-slate-900 dark:text-white pointer-events-none" value="{{ $details['quantity'] }}" readonly>
                            <button onclick="updateQuantity('{{ $id }}', 1)" class="w-7 h-full text-slate-500 hover:text-slate-700 flex items-center justify-center">
                                <i class="fa-solid fa-plus text-[9px]"></i>
                            </button>
                        </div>
                        
                        <!-- Price -->
                        <span class="font-bold text-slate-900 dark:text-slate-100 text-sm whitespace-nowrap">
                            {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}<span class="text-xs font-semibold ml-0.5 underline">đ</span>
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Foot summary block -->
        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 border-t border-slate-100 dark:border-slate-700 flex justify-between md:justify-end items-center gap-4">
            <span class="font-bold text-slate-900 dark:text-white text-sm md:text-base">Tổng tiền:</span>
            <span class="font-bold text-primary text-lg md:text-xl cart-subtotal">
                {{ number_format($subtotal, 0, ',', '.') }}<span class="text-sm font-semibold ml-0.5 underline">đ</span>
            </span>
        </div>
    </div>

    <!-- Layout 2 cột: form info vs total -->
    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left: THÔNG TIN NGƯỜI MUA & GIAO HÀNG -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <h2 class="text-sm font-bold bg-slate-100 dark:bg-slate-700 p-3 uppercase text-slate-800 dark:text-slate-200 border-b border-slate-200 dark:border-slate-700">THÔNG TIN NGƯỜI MUA</h2>
                    <div class="p-6">
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">Để tiếp tục đặt hàng, quý khách xin vui lòng nhập thông tin bên dưới</p>
                        
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                                <label class="w-24 text-sm font-medium text-slate-700 dark:text-slate-300">Họ tên<span class="text-red-500">*</span></label>
                                <input name="customer_name" value="{{ $defaultAddress->receiver_name ?? (auth()->user()->name ?? '') }}" required class="flex-1 h-10 rounded border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:border-primary focus:ring-primary px-3" type="text" placeholder="Họ và tên"/>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                                <label class="w-24 text-sm font-medium text-slate-700 dark:text-slate-300">SĐT<span class="text-red-500">*</span></label>
                                <input name="customer_phone" value="{{ $defaultAddress->receiver_phone ?? (auth()->user()->phone ?? '') }}" required class="flex-1 h-10 rounded border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:border-primary focus:ring-primary px-3" type="tel" placeholder="Số điện thoại"/>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                                <label class="w-24 text-sm font-medium text-slate-700 dark:text-slate-300">Email<span class="text-red-500">*</span></label>
                                <input name="customer_email" value="{{ auth()->user()->email ?? '' }}" required class="flex-1 h-10 rounded border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:border-primary focus:ring-primary px-3" type="email" placeholder="Email"/>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-start gap-2 sm:gap-4">
                                <label class="w-24 text-sm font-medium text-slate-700 dark:text-slate-300 sm:pt-2">Địa chỉ<span class="text-red-500">*</span></label>
                                <input name="shipping_address" value="{{ $defaultAddress->address ?? (auth()->user()->address ?? '') }}" required class="flex-1 h-10 rounded border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:border-primary focus:ring-primary px-3" type="text" placeholder="Địa chỉ nhận hàng (Ví dụ: 123 Đường A, Phường B)"/>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-start gap-2 sm:gap-4">
                                <label class="w-24 text-sm font-medium text-slate-700 dark:text-slate-300 sm:pt-2">Ghi chú</label>
                                <textarea name="note" rows="3" class="flex-1 rounded border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:border-primary focus:ring-primary px-3 py-2" placeholder="Ghi chú về đơn hàng, thời gian giao hàng..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <h2 class="text-sm font-bold bg-slate-100 dark:bg-slate-700 p-3 uppercase text-slate-800 dark:text-slate-200 border-b border-slate-200 dark:border-slate-700">PHƯƠNG THỨC VẬN CHUYỂN & THANH TOÁN</h2>
                    
                    <div class="p-6">
                        <div class="space-y-3 mb-8">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Vận chuyển</p>
                            <label class="flex items-center p-3 border border-slate-200 dark:border-slate-700 rounded cursor-pointer shipping-option bg-primary/5">
                                <input checked name="shipping_method" value="standard" class="text-primary focus:ring-primary" type="radio" onchange="updateTotalsUI()"/>
                                <span class="ml-3 text-sm font-medium">Giao hàng tiêu chuẩn (30.000 VNĐ)</span>
                            </label>
                            <label class="flex items-center p-3 border border-slate-200 dark:border-slate-700 rounded cursor-pointer shipping-option">
                                <input name="shipping_method" value="express" class="text-primary focus:ring-primary" type="radio" onchange="updateTotalsUI()"/>
                                <span class="ml-3 text-sm font-medium">Giao hàng hỏa tốc (65.000 VNĐ)</span>
                            </label>
                        </div>

                        <div class="space-y-3">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Thanh toán</p>
                            <label class="flex items-center p-3 border border-slate-200 dark:border-slate-700 rounded cursor-pointer hover:border-primary transition-colors">
                                <input class="text-primary focus:ring-primary" name="payment_method" value="banking" type="radio"/>
                                <i class="fa-solid fa-building-columns text-slate-400 mx-3 w-5 text-center"></i>
                                <span class="text-sm font-medium">Chuyển khoản ngân hàng</span>
                            </label>
                            <label class="flex items-center p-3 border border-slate-200 dark:border-slate-700 rounded cursor-pointer hover:border-primary transition-colors">
                                <input class="text-primary focus:ring-primary" name="payment_method" value="card" type="radio"/>
                                <i class="fa-solid fa-credit-card text-slate-400 mx-3 w-5 text-center"></i>
                                <span class="text-sm font-medium">Thẻ tín dụng / Thẻ ghi nợ</span>
                            </label>
                            <label class="flex items-center p-3 border border-slate-200 dark:border-slate-700 rounded cursor-pointer hover:border-primary transition-colors">
                                <input checked class="text-primary focus:ring-primary" name="payment_method" value="cod" type="radio"/>
                                <i class="fa-solid fa-hand-holding-dollar text-slate-400 mx-3 w-5 text-center"></i>
                                <span class="text-sm font-medium">Thanh toán khi nhận hàng (COD)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: TỔNG TIỀN -->
            <div>
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden sticky top-24">
                    <h2 class="text-sm font-bold bg-slate-100 dark:bg-slate-700 p-3 uppercase text-slate-800 dark:text-slate-200 border-b border-slate-200 dark:border-slate-700">TỔNG TIỀN</h2>
                    
                    <div class="p-6">
                        <div class="flex gap-2 mb-6">
                            <input type="text" id="coupon_code_input" value="{{ $coupon ? $coupon['code'] : '' }}" {{ $coupon ? 'disabled' : '' }} class="flex-1 h-10 rounded border-slate-200 dark:border-slate-600 dark:bg-slate-900 text-sm focus:border-primary focus:ring-primary px-3 disabled:opacity-50" placeholder="Mã Voucher">
                            @if($coupon)
                            <button type="button" onclick="removeCoupon()" class="px-4 h-10 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded flex items-center gap-2">
                                <i class="fa-solid fa-xmark"></i> GỠ MÃ
                            </button>
                            @else
                            <button type="button" onclick="applyCoupon()" class="px-4 h-10 bg-[#283655] hover:bg-[#1d273d] text-white text-xs sm:text-sm font-bold rounded flex items-center gap-1.5 shrink-0">
                                <i class="fa-solid fa-tag"></i> Áp dụng
                            </button>
                            @endif
                        </div>
                        <p id="coupon_message" class="text-xs mb-4 hidden"></p>

                        <div class="space-y-3 text-sm text-slate-700 dark:text-slate-300 border-b border-slate-200 dark:border-slate-700 pb-4 mb-4">
                            <div class="flex justify-between">
                                <span>Tổng cộng</span>
                                <span class="font-bold cart-subtotal">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Phí vận chuyển</span>
                                <span class="font-bold" id="shipping-fee-text">30.000 VNĐ</span>
                            </div>
                            @if($discount > 0)
                            <div class="flex justify-between">
                                <span>Giảm giá Voucher</span>
                                <span class="font-bold text-red-500">-{{ number_format($discount, 0, ',', '.') }} VNĐ</span>
                            </div>
                            @endif
                        </div>

                        <div class="flex justify-between items-center mb-6">
                            <span class="font-bold text-slate-900 dark:text-white">Thành tiền</span>
                            <div class="text-right">
                                <span class="font-bold text-red-600 text-xl" id="grand-total-text">{{ number_format(max(0, $subtotal + 30000 - $discount), 0, ',', '.') }} VNĐ</span>
                                <p class="text-[10px] text-slate-500 mt-1">(Giá đã bao gồm VAT)</p>
                            </div>
                        </div>

                        <label class="flex items-center gap-2 mb-6 cursor-pointer">
                            <input type="checkbox" required class="text-primary focus:ring-primary rounded border-slate-300">
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Tôi đã đọc và đồng ý với các Điều kiện giao dịch chung của website</span>
                        </label>

                        <div class="flex flex-col gap-2">
                            <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-4 rounded text-sm flex justify-center items-center gap-2 transition-colors">
                                <i class="fa-solid fa-check"></i> ĐẶT HÀNG
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="text-center py-20 bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700">
        <i class="fa-solid fa-cart-arrow-down text-6xl text-slate-300 mb-6"></i>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Giỏ hàng của bạn đang trống!</h2>
        <p class="text-slate-500 mb-6">Hãy quay lại cửa hàng để chọn mua sản phẩm.</p>
        <a href="{{ route('store.index') }}" class="inline-block bg-primary text-white font-bold py-3 px-8 rounded">
            Tiếp tục mua sắm
        </a>
    </div>
    @endif
</main>

<script>
    const subtotal = {{ $subtotal ?? 0 }};
    const discount = {{ $discount ?? 0 }};

    function updateTotalsUI() {
        if (subtotal === 0) return;
        const shippingMethod = document.querySelector('input[name="shipping_method"]:checked').value;
        const shippingFee = shippingMethod === 'express' ? 65000 : 30000;
        let total = subtotal + shippingFee - discount;
        if(total < 0) total = 0;

        document.getElementById('shipping-fee-text').innerText = shippingFee.toLocaleString('vi-VN') + ' VNĐ';
        document.getElementById('grand-total-text').innerText = total.toLocaleString('vi-VN') + ' VNĐ';

        document.querySelectorAll('.shipping-option').forEach(el => {
            el.classList.remove('bg-primary/5');
        });
        document.querySelector('input[name="shipping_method"]:checked').closest('.shipping-option').classList.add('bg-primary/5');
    }

    async function updateQuantity(productId, change) {
        const row = document.querySelector(`.cart-item[data-id="${productId}"]`);
        const quantityInput = row.querySelector('.item-quantity');
        let newQuantity = parseInt(quantityInput.value) + change;
        if (newQuantity < 1) return;

        try {
            const response = await fetch(`/cart/update/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ quantity: newQuantity })
            });

            const data = await response.json();
            if (data.success) {
                // Reload to recalculate everything properly (including coupons)
                window.location.reload();
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    async function removeFromCart(productId) {
        if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) return;
        try {
            const response = await fetch(`/cart/remove/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();
            if (data.success) {
                window.location.reload();
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function clearCart() {
        if (!confirm('Xóa toàn bộ giỏ hàng?')) return;
        try {
            const response = await fetch(`/cart/clear`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();
            if (data.success) {
                window.location.reload();
            }
        } catch (error) {
            console.error('Error:', error);
        }
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
        });
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
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        @if($errors->any())
            alert("Vui lòng kiểm tra lại thông tin nhập:\n{{ implode('\n', $errors->all()) }}");
        @endif
        @if(session('error'))
            alert("{{ session('error') }}");
        @endif
    });
</script>
@endsection
