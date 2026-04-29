@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<main class="flex-1 w-full max-w-[1440px] mx-auto px-4 md:px-10 lg:px-40 py-8 min-h-[calc(100vh-200px)]">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        @include('profile.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col gap-8">
            <!-- Order History Section -->
            <section class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Lịch sử đơn hàng</h2>
                        <p class="text-sm text-slate-500 mt-1">Xem và quản lý tất cả các đơn hàng bạn đã đặt</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/50">
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 whitespace-nowrap">Mã đơn hàng</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 whitespace-nowrap">Ngày đặt</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 whitespace-nowrap text-right">Tổng tiền</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 whitespace-nowrap text-center">Trạng thái</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 whitespace-nowrap text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="p-4 text-sm font-bold text-primary">#{{ $order->id }}</td>
                                <td class="p-4 text-sm text-slate-600 dark:text-slate-400 whitespace-nowrap">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-4 text-sm font-bold text-right whitespace-nowrap">{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400',
                                            'processing' => 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
                                            'shipping' => 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400',
                                            'completed' => 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400',
                                            'cancelled' => 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Chờ xử lý',
                                            'processing' => 'Đang giao',
                                            'shipping' => 'Đang giao hàng',
                                            'completed' => 'Hoàn tất',
                                            'cancelled' => 'Đã hủy',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full {{ $statusClasses[$order->status] ?? 'bg-slate-100 text-slate-600' }} text-[11px] font-bold">
                                        {{ $statusLabels[$order->status] ?? $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        @if($order->status === 'cancelled')
                                            <form action="{{ route('profile.orders.reorder', $order->id) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-700 transition-colors text-sm font-bold flex items-center gap-2">
                                                    <i class="fa-solid fa-rotate-right text-xs"></i>
                                                    <span>Đặt lại</span>
                                                </button>
                                            </form>
                                        @endif
                                        <button onclick="showOrderDetails({{ $order->id }})" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 transition-colors text-sm font-bold">
                                            <span>Chi tiết</span>
                                            <i class="fa-solid fa-arrow-right-long text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <div class="flex flex-col items-center gap-4 text-slate-400">
                                        <i class="fa-solid fa-box-open text-6xl opacity-20"></i>
                                        <p class="text-lg italic">Bạn chưa có đơn hàng nào.</p>
                                        <a href="{{ route('store.index') }}" class="mt-2 inline-flex items-center gap-2 bg-primary text-white px-6 py-2 rounded-lg font-bold hover:shadow-lg transition-all">
                                            Mua sắm ngay
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($orders->hasPages())
                <div class="p-6 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50">
                    {{ $orders->links() }}
                </div>
                @endif
            </section>
        </div>
    </div>
</main>

<!-- Order Details Modal -->
<div id="orderModal" class="fixed inset-0 z-[9999] hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeOrderModal()"></div>
    
    <!-- Modal Content -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl px-4">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-800 animate-in fade-in zoom-in duration-300">
            <!-- Header -->
            <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/50">
                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white" id="modalOrderTitle">Chi tiết đơn hàng #...</h3>
                    <p class="text-sm text-slate-500" id="modalOrderDate">Đặt lúc ...</p>
                </div>
                <button onclick="closeOrderModal()" class="h-10 w-10 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 max-h-[60vh] overflow-y-auto custom-scrollbar">
                <!-- Status & Payment Info -->
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Trạng thái</p>
                        <div id="modalOrderStatus">...</div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Thanh toán</p>
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-300" id="modalPaymentMethod">...</p>
                    </div>
                </div>

                <!-- Shipping Info -->
                <div class="mb-8 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 relative group">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-location-dot"></i>
                            Thông tin giao hàng
                        </p>
                        <button id="editShippingBtn" onclick="toggleEditShipping()" class="text-primary text-xs font-bold hover:underline hidden">Chỉnh sửa</button>
                    </div>
                    
                    <!-- View Mode -->
                    <div id="shippingViewMode">
                        <p class="text-sm font-bold text-slate-900 dark:text-white mb-1" id="modalCustomerName">...</p>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1" id="modalCustomerPhone">...</p>
                        <p class="text-sm text-slate-600 dark:text-slate-400" id="modalShippingAddress">...</p>
                    </div>

                    <!-- Edit Mode -->
                    <div id="shippingEditMode" class="hidden space-y-3">
                        <input type="text" id="editName" class="w-full text-sm p-2 rounded border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800" placeholder="Họ tên">
                        <input type="text" id="editPhone" class="w-full text-sm p-2 rounded border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800" placeholder="Số điện thoại">
                        <input type="text" id="editAddress" class="w-full text-sm p-2 rounded border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800" placeholder="Địa chỉ">
                        <div class="flex gap-2 justify-end mt-2">
                            <button onclick="toggleEditShipping()" class="text-xs px-3 py-1 text-slate-500 hover:text-slate-700">Hủy</button>
                            <button onclick="saveShippingInfo()" class="text-xs px-4 py-1 bg-primary text-white rounded font-bold">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>

                <!-- Product List -->
                <div class="mb-2">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Danh sách sản phẩm</p>
                    <div id="modalProductList" class="space-y-4">
                        <!-- Products will be injected here -->
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="p-6 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-slate-500">Tạm tính:</span>
                            <span class="font-bold text-slate-700 dark:text-slate-300" id="modalSubtotal">0đ</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-slate-500">Phí vận chuyển:</span>
                            <span class="font-bold text-slate-700 dark:text-slate-300" id="modalShippingFee">0đ</span>
                        </div>
                        <div class="flex justify-between items-center text-lg mt-2 pt-2 border-t border-slate-200 dark:border-slate-700">
                            <span class="font-bold text-slate-900 dark:text-white">Tổng cộng:</span>
                            <span class="font-black text-primary" id="modalTotal">0đ</span>
                        </div>
                    </div>
                    
                    <!-- Cancel Button -->
                    <div id="cancelOrderWrapper" class="hidden">
                        <button onclick="confirmCancelOrder()" class="w-full py-3 border-2 border-red-500 text-red-500 font-bold rounded-xl hover:bg-red-50 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-ban"></i>
                            Hủy đơn hàng này
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentOrderId = null;
    let currentOrderStatus = null;

    function showOrderDetails(orderId) {
        currentOrderId = orderId;
        const modal = document.getElementById('orderModal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        // Reset modes
        document.getElementById('shippingViewMode').classList.remove('hidden');
        document.getElementById('shippingEditMode').classList.add('hidden');
        document.getElementById('editShippingBtn').classList.add('hidden');

        document.getElementById('modalOrderTitle').innerText = `Đang tải đơn hàng #${orderId}...`;
        document.getElementById('modalProductList').innerHTML = '<div class="py-10 text-center"><i class="fa-solid fa-circle-notch fa-spin text-2xl text-primary"></i></div>';

        fetch(`/my-orders/${orderId}/json`)
            .then(response => response.json())
            .then(data => {
                const order = data.order;
                const items = data.items;
                currentOrderStatus = order.status;

                // Update UI
                document.getElementById('modalOrderTitle').innerText = `Chi tiết đơn hàng #${order.id}`;
                document.getElementById('modalOrderDate').innerText = `Đặt lúc ${new Date(order.created_at).toLocaleString('vi-VN')}`;
                
                // Show Edit button if pending or processing
                if (['pending', 'processing'].includes(order.status)) {
                    document.getElementById('editShippingBtn').classList.remove('hidden');
                }

                // Show Cancel button only if pending
                if (order.status === 'pending') {
                    document.getElementById('cancelOrderWrapper').classList.remove('hidden');
                } else {
                    document.getElementById('cancelOrderWrapper').classList.add('hidden');
                }

                const statusLabels = {
                    'pending': 'Chờ xử lý',
                    'processing': 'Đang giao',
                    'shipping': 'Đang giao hàng',
                    'completed': 'Hoàn tất',
                    'cancelled': 'Đã hủy'
                };
                const statusClasses = {
                    'pending': 'bg-yellow-100 text-yellow-600',
                    'processing': 'bg-blue-100 text-blue-600',
                    'shipping': 'bg-purple-100 text-purple-600',
                    'completed': 'bg-green-100 text-green-600',
                    'cancelled': 'bg-red-100 text-red-600'
                };

                document.getElementById('modalOrderStatus').innerHTML = `
                    <span class="px-3 py-1 rounded-full ${statusClasses[order.status]} text-xs font-bold">
                        ${statusLabels[order.status]}
                    </span>
                `;

                document.getElementById('modalPaymentMethod').innerText = order.payment_method.toUpperCase();
                
                // View Data
                document.getElementById('modalCustomerName').innerText = order.customer_name;
                document.getElementById('modalCustomerPhone').innerText = order.customer_phone;
                document.getElementById('modalShippingAddress').innerText = order.shipping_address;

                // Pre-fill Edit Data
                document.getElementById('editName').value = order.customer_name;
                document.getElementById('editPhone').value = order.customer_phone;
                document.getElementById('editAddress').value = order.shipping_address;

                // Products
                let productListHtml = '';
                let subtotal = 0;
                items.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    subtotal += itemTotal;
                    productListHtml += `
                        <div class="flex items-center gap-4">
                            <div class="h-16 w-16 rounded-lg bg-slate-100 dark:bg-slate-800 overflow-hidden shrink-0">
                                <img src="${item.product.image ? '/storage/' + item.product.image : '/images/placeholder.png'}" alt="${item.product.name}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-slate-900 dark:text-white line-clamp-1">${item.product.name}</p>
                                <p class="text-xs text-slate-500">${new Intl.NumberFormat('vi-VN').format(item.price)}đ x ${item.quantity}</p>
                            </div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">
                                ${new Intl.NumberFormat('vi-VN').format(itemTotal)}đ
                            </div>
                        </div>
                    `;
                });
                document.getElementById('modalProductList').innerHTML = productListHtml;

                document.getElementById('modalSubtotal').innerText = new Intl.NumberFormat('vi-VN').format(subtotal) + 'đ';
                document.getElementById('modalShippingFee').innerText = new Intl.NumberFormat('vi-VN').format(order.total_price - subtotal) + 'đ';
                document.getElementById('modalTotal').innerText = new Intl.NumberFormat('vi-VN').format(order.total_price) + 'đ';
            })
            .catch(error => {
                console.error('Error fetching order details:', error);
                alert('Không thể tải thông tin đơn hàng!');
                closeOrderModal();
            });
    }

    function toggleEditShipping() {
        const viewMode = document.getElementById('shippingViewMode');
        const editMode = document.getElementById('shippingEditMode');
        const editBtn = document.getElementById('editShippingBtn');

        if (viewMode.classList.contains('hidden')) {
            viewMode.classList.remove('hidden');
            editMode.classList.add('hidden');
            editBtn.classList.remove('hidden');
        } else {
            viewMode.classList.add('hidden');
            editMode.classList.remove('hidden');
            editBtn.classList.add('hidden');
        }
    }

    function saveShippingInfo() {
        const data = {
            customer_name: document.getElementById('editName').value,
            customer_phone: document.getElementById('editPhone').value,
            shipping_address: document.getElementById('editAddress').value,
            _token: '{{ csrf_token() }}',
            _method: 'PUT'
        };

        fetch(`/my-orders/${currentOrderId}/update`, {
            method: 'POST', // We use POST with _method: PUT for Laravel compatibility
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                alert(res.success);
                showOrderDetails(currentOrderId); // Refresh modal
            } else {
                alert(res.error || 'Có lỗi xảy ra');
            }
        })
        .catch(err => alert('Lỗi kết nối máy chủ'));
    }

    function confirmCancelOrder() {
        if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này? Thao tác này không thể hoàn tác.')) {
            fetch(`/my-orders/${currentOrderId}/cancel`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(res => {
                if (res.success) {
                    alert(res.success);
                    location.reload(); // Reload page to update status in list
                } else {
                    alert(res.error || 'Có lỗi xảy ra');
                }
            })
            .catch(err => alert('Lỗi kết nối máy chủ'));
        }
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endsection
