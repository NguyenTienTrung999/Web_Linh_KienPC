@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<main class="max-w-7xl mx-auto w-full px-6 lg:px-20 py-10 flex-1">
    <div class="flex flex-col gap-2 mb-8">
        <nav class="flex items-center gap-2 text-sm text-slate-500">
            <a class="hover:text-primary" href="{{ route('home') }}">Trang chủ</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-900 dark:text-slate-100 font-medium">Giỏ hàng</span>
        </nav>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100">
            Giỏ hàng của bạn 
            <span class="text-primary font-normal text-xl ml-2 cart-count-total">({{ count($cart) }} sản phẩm)</span>
        </h1>
    </div>

    @if(count($cart) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10" id="cart-content">
        <div class="lg:col-span-2 space-y-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-slate-800 text-slate-500 text-sm uppercase tracking-wider font-semibold">
                            <th class="py-4 px-2">Sản phẩm</th>
                            <th class="py-4 px-2 text-center">Số lượng</th>
                            <th class="py-4 px-2 text-right">Giá</th>
                            <th class="py-4 px-2 text-right">Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($cart as $id => $details)
                        <tr class="group cart-item" data-id="{{ $id }}">
                            <td class="py-6 px-2">
                                <div class="flex items-center gap-4">
                                    <div class="h-20 w-20 rounded-xl bg-white dark:bg-slate-800 p-2 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                                        <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://placehold.co/200x200?text=No+Image' }}" class="h-full w-full object-contain">
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-slate-100">{{ $details['name'] }}</p>
                                        <button onclick="removeFromCart({{ $id }})" class="mt-2 text-xs text-red-500 hover:text-red-600 flex items-center gap-1 font-medium">
                                            <i class="fa-solid fa-trash-can text-[10px]"></i> Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-2">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden bg-white dark:bg-slate-900">
                                        <button onclick="updateQuantity({{ $id }}, -1)" class="px-3 py-1 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            <i class="fa-solid fa-minus text-[10px]"></i>
                                        </button>
                                        <span class="px-4 py-1 text-sm font-semibold border-x border-slate-200 dark:border-slate-700 item-quantity">{{ $details['quantity'] }}</span>
                                        <button onclick="updateQuantity({{ $id }}, 1)" class="px-3 py-1 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-6 px-2 text-right text-slate-900 dark:text-slate-100 font-bold whitespace-nowrap">{{ number_format($details['price'], 0, ',', '.') }}đ</td>
                            <td class="py-6 px-2 text-right font-bold text-primary text-[16px] item-total">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6">
                <a href="{{ route('store.index') }}" class="flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all">
                    <i class="fa-solid fa-arrow-left text-sm"></i> Tiếp tục mua sắm
                </a>
                <button onclick="clearCart()" class="text-slate-500 hover:text-slate-900 dark:hover:text-slate-100 text-sm font-medium">Xóa toàn bộ giỏ hàng</button>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                <h2 class="text-lg font-bold mb-6">Tóm tắt đơn hàng</h2>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-slate-600 dark:text-slate-400">
                        <span>Tạm tính</span>
                        <span class="font-medium text-slate-900 dark:text-slate-100 cart-subtotal">{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>
                    <div class="flex justify-between text-slate-600 dark:text-slate-400">
                        <span>Phí vận chuyển dự tính</span>
                        <span class="font-medium text-slate-900 dark:text-slate-100">0đ</span>
                    </div>
                    <div class="flex justify-between text-slate-600 dark:text-slate-400">
                        <span>Thuế dự tính (10%)</span>
                        <span class="font-medium text-slate-900 dark:text-slate-100 cart-tax">{{ number_format($total * 0.1, 0, ',', '.') }}đ</span>
                    </div>
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between">
                        <span class="text-lg font-bold">Tổng cộng</span>
                        <span class="text-[16px] font-bold text-primary cart-total-price">{{ number_format($total * 1.1, 0, ',', '.') }}đ</span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Mã giảm giá</label>
                    <div class="flex gap-2">
                        <input class="flex-1 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:border-primary focus:ring-0" placeholder="Nhập mã" type="text"/>
                        <button class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-lg text-sm font-bold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">Áp dụng</button>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}" class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-primary/30 transition-all flex items-center justify-center gap-2">Tiến hành thanh toán <i class="fa-solid fa-arrow-right text-sm"></i></a>
                <p class="mt-4 text-center text-xs text-slate-400">Miễn phí trả hàng trong vòng 30 ngày. Giao hàng nhanh &amp; bảo mật.</p>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-20 bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800">
        <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-cart-shopping text-4xl text-slate-300"></i>
        </div>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Giỏ hàng trống!</h2>
        <p class="text-slate-500 mb-8 max-w-sm mx-auto">Bạn chưa thêm sản phẩm nào vào giỏ hàng. Hãy bắt đầu chọn những thiết bị công nghệ ưng ý nhất nhé!</p>
        <a href="{{ route('store.index') }}" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-xl font-bold hover:shadow-lg transition-all">
            Đến Cửa Hàng <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
    @endif
</main>

<script>
    async function updateQuantity(productId, change) {
        const row = document.querySelector(`.cart-item[data-id="${productId}"]`);
        const quantitySpan = row.querySelector('.item-quantity');
        let newQuantity = parseInt(quantitySpan.innerText) + change;
        
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
                quantitySpan.innerText = newQuantity;
                row.querySelector('.item-total').innerText = data.itemTotal;
                updateTotals(data.cartTotal);
            }
        } catch (error) {
            console.error('Error updating quantity:', error);
            showToast('Không thể cập nhật số lượng!', 'error');
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
                const row = document.querySelector(`.cart-item[data-id="${productId}"]`);
                row.remove();
                
                // Update header count
                const cartCountHeader = document.getElementById('cart-count');
                if (cartCountHeader) cartCountHeader.innerText = data.cartCount;
                
                // Update total label
                document.querySelector('.cart-count-total').innerText = `(${data.cartCount} sản phẩm)`;

                if (data.cartCount === 0) {
                    location.reload(); // Quick way to show empty state
                } else {
                    updateTotals(data.cartTotal);
                }
                
                showToast(data.message);
            }
        } catch (error) {
            console.error('Error removing item:', error);
            showToast('Không thể xóa sản phẩm!', 'error');
        }
    }

    async function clearCart() {
        if (!confirm('Xóa toàn bộ sản phẩm khỏi giỏ hàng?')) return;

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
                location.reload();
            }
        } catch (error) {
            console.error('Error clearing cart:', error);
            showToast('Không thể xóa giỏ hàng!', 'error');
        }
    }

    function updateTotals(cartTotalStr) {
        // Simple numeric parsing for the string (e.g. "1.200.000đ")
        const subtotal = parseInt(cartTotalStr.replace(/\./g, ''));
        const tax = subtotal * 0.1;
        const total = subtotal + tax;

        document.querySelector('.cart-subtotal').innerText = cartTotalStr;
        document.querySelector('.cart-tax').innerText = formatCurrency(tax);
        document.querySelector('.cart-total-price').innerText = formatCurrency(total);
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN').format(Math.round(amount)) + 'đ';
    }
</script>
@endsection
