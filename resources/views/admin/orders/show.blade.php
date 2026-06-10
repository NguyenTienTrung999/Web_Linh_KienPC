@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng #' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.index') }}" class="w-10 h-10 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl flex items-center justify-center text-slate-500 hover:text-primary transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Đơn hàng #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h2>
                <p class="text-slate-500 text-sm font-medium">Đặt lúc {{ $order->created_at->format('H:i, d/m/Y') }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-4 py-2 rounded-xl text-xs font-black uppercase border {{ $order->getStatusColor() }}">
                {{ $order->getStatusLabel() }}
            </span>
        </div>
    </div>



    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Order Details & Status Update -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Items Table -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50 dark:border-slate-800">
                    <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg">Chi tiết sản phẩm</h3>
                </div>
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                                <th class="px-6 py-4">Sản phẩm</th>
                                <th class="px-6 py-4 text-center">Số lượng</th>
                                <th class="px-6 py-4 text-right">Đơn giá</th>
                                <th class="px-6 py-4 text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://placehold.co/200x200?text=Product' }}" alt="{{ $item->product->name }}" class="w-12 h-12 rounded-xl object-contain bg-slate-50 dark:bg-slate-800 p-1 border border-slate-100 dark:border-slate-800">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $item->product->name }}</span>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="text-[10px] text-slate-400 font-medium">SKU: {{ $item->product->sku ?? 'N/A' }}</span>
                                                @if($item->color)
                                                    <span class="text-[10px] font-black text-primary uppercase tracking-widest">Màu: {{ $item->color }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center text-sm font-bold text-slate-600 dark:text-slate-400">
                                    x{{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-bold text-slate-600 dark:text-slate-400 font-mono">
                                    {{ number_format($item->price, 0, ',', '.') }}₫
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-black text-slate-900 dark:text-white font-mono">
                                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-slate-50/30 dark:bg-slate-800/20">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right text-xs font-black text-slate-400 uppercase tracking-widest">Phí vận chuyển</td>
                                <td class="px-6 py-4 text-right text-sm font-bold text-slate-600 dark:text-slate-400 font-mono">
                                    @php $shipping = $order->total_price - $order->items->sum(fn($i) => $i->price * $i->quantity); @endphp
                                    {{ number_format($shipping, 0, ',', '.') }}₫
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right text-xs font-black text-slate-400 uppercase tracking-widest">Tổng cộng</td>
                                <td class="px-6 py-4 text-right text-xl font-black text-primary font-mono">
                                    {{ number_format($order->total_price, 0, ',', '.') }}₫
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Mobile List view of items -->
                <div class="block md:hidden divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($order->items as $item)
                    <div class="p-5 flex gap-4">
                        <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://placehold.co/200x200?text=Product' }}" alt="{{ $item->product->name }}" class="w-16 h-16 rounded-xl object-contain bg-slate-50 dark:bg-slate-800 p-1 border border-slate-100 dark:border-slate-800 shrink-0">
                        <div class="flex-1 min-w-0 flex flex-col justify-between">
                            <div>
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-200 block truncate leading-tight">{{ $item->product->name }}</span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[10px] text-slate-400">SKU: {{ $item->product->sku ?? 'N/A' }}</span>
                                    @if($item->color)
                                        <span class="text-[10px] font-black text-primary uppercase">Màu: {{ $item->color }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs text-slate-500 font-bold">x{{ $item->quantity }}</span>
                                <span class="text-sm font-black text-slate-900 dark:text-white font-mono">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @php $shipping = $order->total_price - $order->items->sum(fn($i) => $i->price * $i->quantity); @endphp
                    <div class="p-5 bg-slate-50/50 dark:bg-slate-800/10 space-y-3">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">Phí vận chuyển</span>
                            <span class="font-bold text-slate-700 dark:text-slate-350 font-mono">{{ number_format($shipping, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-slate-100 dark:border-slate-800">
                            <span class="text-slate-900 dark:text-white font-black uppercase tracking-wider text-[10px]">Tổng cộng</span>
                            <span class="text-lg font-black text-primary font-mono">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Note -->
            @if($order->note)
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm">
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg mb-4">Ghi chú từ khách hàng</h3>
                <div class="p-4 bg-amber-50 dark:bg-amber-500/5 border border-amber-200/50 dark:border-amber-500/20 rounded-2xl text-sm text-amber-700 dark:text-amber-400 italic">
                    "{{ $order->note }}"
                </div>
            </div>
            @endif
        </div>

        <!-- Right: Customer Info & Status Update -->
        <div class="space-y-8">
            <!-- Customer Card -->
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm">
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg mb-6">Thông tin khách hàng</h3>
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl text-indigo-600 flex items-center justify-center text-xl font-black">
                            {{ substr($order->customer_name, 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-slate-700 dark:text-slate-200">{{ $order->customer_name }}</span>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Loại: {{ $order->user_id ? 'Khách hàng' : 'Khách vãng lai' }}</span>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-slate-50 dark:border-slate-800 space-y-4">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope w-5 text-center text-slate-400"></i>
                            <span class="text-xs font-bold text-slate-600 dark:text-slate-400">{{ $order->customer_email }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-phone w-5 text-center text-slate-400"></i>
                            <span class="text-xs font-bold text-slate-600 dark:text-slate-400">{{ $order->customer_phone }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot w-5 text-center text-slate-400 mt-0.5"></i>
                            <span class="text-xs font-bold text-slate-600 dark:text-slate-400 leading-relaxed">{{ $order->shipping_address }}</span>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-50 dark:border-slate-800">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Thanh toán</span>
                            <span class="text-[10px] font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded">
                                {{ $order->payment_method === 'cod' ? 'Tiền mặt (COD)' : 'Chuyển khoản' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Update Form -->
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div class="absolute -top-6 -right-6 opacity-5 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-pen-to-square text-8xl text-primary"></i>
                </div>
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg mb-6 relative z-10">Cập nhật trạng thái</h3>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-4 relative z-10">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Trạng thái mới</label>
                        <select name="status" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer">
                            @foreach(\App\Models\Order::getAllStatuses() as $value => $label)
                                <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-primary/20">
                        Cập nhật ngay
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
