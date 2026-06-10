@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Danh sách đơn hàng</h2>
            <p class="text-slate-500 text-sm font-medium">Quản lý và xử lý đơn hàng từ khách hàng</p>
        </div>
        <div class="w-full md:w-auto flex items-center gap-4">
            <form action="{{ route('admin.orders.index') }}" method="GET" id="filter-form" class="w-full flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <select name="status" onchange="this.form.submit()" class="w-full sm:w-auto bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl pl-4 pr-10 py-2.5 text-xs font-bold text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="" {{ !$status ? 'selected' : '' }}>Tất cả trạng thái</option>
                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Chờ thanh toán</option>
                    <option value="processing" {{ $status == 'processing' ? 'selected' : '' }}>Chờ xác nhận</option>
                    <option value="packing" {{ $status == 'packing' ? 'selected' : '' }}>Đang chuẩn bị</option>
                    <option value="shipping" {{ $status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                    <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                    <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>

                <select name="sort" onchange="this.form.submit()" class="w-full sm:w-auto bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl pl-4 pr-10 py-2.5 text-xs font-bold text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
                
                <div class="relative group w-full sm:w-64">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Tìm mã đơn, tên, sđt..." class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-xs font-bold text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 transition-all">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xs"></i>
                </div>
                
                @if($status || $search || $sort !== 'newest')
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-rose-500 hover:underline whitespace-nowrap text-center sm:text-left">Xóa lọc</a>
                @endif
            </form>
        </div>
    </div>



    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="px-8 py-5">Mã đơn</th>
                        <th class="px-8 py-5">Khách hàng</th>
                        <th class="hidden md:table-cell px-8 py-5">Phương thức</th>
                        <th class="hidden md:table-cell px-8 py-5">Ngày đặt</th>
                        <th class="hidden md:table-cell px-8 py-5 text-right">Tổng tiền</th>
                        <th class="hidden md:table-cell px-8 py-5 text-center">Trạng thái</th>
                        <th class="hidden md:table-cell px-8 py-5 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($orders as $order)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-primary/5 transition-colors cursor-pointer md:cursor-default" onclick="handleOrderRowClick(event, {
                        id: '{{ $order->id }}',
                        padId: '#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}',
                        customerName: '{{ addslashes($order->customer_name) }}',
                        customerPhone: '{{ $order->customer_phone }}',
                        paymentMethod: '{{ $order->payment_method === 'cod' ? 'Tiền mặt (COD)' : 'Chuyển khoản' }}',
                        date: '{{ $order->created_at->format('d/m/Y H:i') }}',
                        total: '{{ number_format($order->total_price, 0, ',', '.') }}₫',
                        status: '{{ $order->getStatusLabel() }}',
                        statusClass: '{{ $order->getStatusColor() }}',
                        showUrl: '{{ route('admin.orders.show', $order->id) }}'
                    })">
                        <td class="px-8 py-5">
                            <span class="text-xs font-black text-primary font-mono bg-primary/5 px-2 py-1 rounded">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $order->customer_name }}</span>
                                <span class="text-[10px] text-slate-400 font-medium">{{ $order->customer_phone }}</span>
                            </div>
                        </td>
                        <td class="hidden md:table-cell px-8 py-5">
                            <span class="text-[10px] font-black uppercase text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded">
                                {{ $order->payment_method === 'cod' ? 'Tiền mặt (COD)' : 'Chuyển khoản' }}
                            </span>
                        </td>
                        <td class="hidden md:table-cell px-8 py-5">
                            <span class="text-xs font-bold text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </td>
                        <td class="hidden md:table-cell px-8 py-5 text-right">
                            <span class="text-sm font-black text-slate-900 dark:text-white font-mono">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                        </td>
                        <td class="hidden md:table-cell px-8 py-5 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase border {{ $order->getStatusColor() }}">
                                {{ $order->getStatusLabel() }}
                            </span>
                        </td>
                        <td class="hidden md:table-cell px-8 py-5 text-right">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-400 hover:text-primary hover:border-primary items-center justify-center transition-all shadow-sm">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-8 py-10 text-center text-slate-400 text-sm italic font-medium">Không tìm thấy đơn hàng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($orders->hasPages())
        <div class="px-8 py-6 border-t border-slate-50 dark:border-slate-800">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Mobile Order Detail Modal -->
<div id="order-detail-modal" class="fixed inset-0 z-[10000] hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" onclick="if(event.target === this) closeOrderModal()">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-sm w-full overflow-hidden shadow-2xl border border-slate-100 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="order-modal-card">
        <!-- Header -->
        <div class="p-5 pb-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-base text-slate-900 dark:text-white">Chi tiết đơn hàng</h3>
            <button onclick="closeOrderModal()" class="text-slate-400 hover:text-slate-650 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>
        <!-- Body -->
        <div class="p-5 space-y-4">
            <div>
                <h4 id="order-modal-id" class="font-black text-base text-primary font-mono bg-primary/5 inline-block px-2.5 py-1 rounded"></h4>
                <p class="text-[10px] text-slate-405 mt-2">Ngày đặt: <span id="order-modal-date" class="font-semibold text-slate-700 dark:text-slate-350"></span></p>
            </div>
            
            <div class="divide-y divide-slate-100 dark:divide-slate-800 text-xs">
                <div class="py-2.5">
                    <span class="text-slate-500 block mb-1">Khách hàng:</span>
                    <p id="order-modal-customer" class="font-bold text-slate-900 dark:text-slate-100"></p>
                    <p id="order-modal-phone" class="text-slate-500 mt-0.5"></p>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Phương thức:</span>
                    <span id="order-modal-payment" class="font-semibold text-slate-900 dark:text-white bg-slate-100 dark:bg-slate-850 px-2 py-0.5 rounded"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Tổng tiền:</span>
                    <span id="order-modal-total" class="font-black text-slate-900 dark:text-white font-mono text-sm"></span>
                </div>
                <div class="py-2.5 flex justify-between items-center">
                    <span class="text-slate-500">Trạng thái:</span>
                    <span id="order-modal-status" class="px-2.5 py-0.5 rounded-lg text-[9px] font-black uppercase border"></span>
                </div>
            </div>
        </div>
        <!-- Footer / Actions -->
        <div class="p-5 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex items-center gap-3">
            <a id="order-modal-show-btn" href="" class="w-full justify-center bg-primary text-white py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors text-xs shadow-md shadow-primary/10">
                <i class="fa-solid fa-eye"></i>
                Xem chi tiết đơn hàng
            </a>
        </div>
    </div>
</div>

<script>
    function handleOrderRowClick(event, data) {
        if (event.target.closest('button') || event.target.closest('form') || event.target.closest('a')) {
            return;
        }
        if (window.innerWidth >= 768) return;

        const modal = document.getElementById('order-detail-modal');
        const card = document.getElementById('order-modal-card');

        document.getElementById('order-modal-id').textContent = data.padId;
        document.getElementById('order-modal-date').textContent = data.date;
        document.getElementById('order-modal-customer').textContent = data.customerName;
        document.getElementById('order-modal-phone').textContent = data.customerPhone;
        document.getElementById('order-modal-payment').textContent = data.paymentMethod;
        document.getElementById('order-modal-total').textContent = data.total;
        
        const statusEl = document.getElementById('order-modal-status');
        statusEl.textContent = data.status;
        statusEl.className = 'px-2.5 py-0.5 rounded-lg text-[9px] font-black uppercase border ' + data.statusClass;

        document.getElementById('order-modal-show-btn').href = data.showUrl;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeOrderModal() {
        const modal = document.getElementById('order-detail-modal');
        const card = document.getElementById('order-modal-card');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
