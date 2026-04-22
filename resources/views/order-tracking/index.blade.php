@extends('layouts.app')

@section('title', 'Tra cứu đơn hàng')

@section('content')
<main class="mx-auto max-w-4xl w-full px-4 md:px-10 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-black text-slate-900 dark:text-white mb-4 uppercase tracking-tighter italic">Tra cứu <span class="text-primary italic-none">đơn hàng</span></h1>
        <p class="text-slate-500 max-w-lg mx-auto">Nhập mã đơn hàng và địa chỉ email của bạn để kiểm tra trạng thái vận chuyển và thông tin đơn hàng.</p>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Search Form -->
        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl border border-primary/10 shadow-xl overflow-hidden relative">
            <form action="{{ route('order.track') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                @csrf
                <div class="md:col-span-1">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Mã đơn hàng</label>
                    <input name="order_id" value="{{ old('order_id', isset($order) ? '#'.str_pad($order->id, 8, '0', STR_PAD_LEFT) : '') }}" required class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 font-mono" placeholder="#00000001" type="text"/>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Địa chỉ Email</label>
                    <input name="email" value="{{ old('email', isset($order) ? $order->customer_email : '') }}" required class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-900 dark:border-slate-700 focus:ring-primary focus:border-primary px-4" placeholder="email@example.com" type="email"/>
                </div>
                <div class="md:col-span-1">
                    <button type="submit" class="w-full h-12 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg transition-transform hover:scale-[1.02] flex items-center justify-center gap-2 shadow-lg shadow-primary/20">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        TRA CỨU NGAY
                    </button>
                </div>
            </form>
        </div>

        @if(isset($order))
            <!-- Search Results -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-primary/20 shadow-2xl overflow-hidden animate-slide-up">
                <div class="bg-primary p-6 text-white flex justify-between items-center">
                    <div>
                        <span class="text-[10px] font-black uppercase opacity-70 block mb-1">Trạng thái đơn hàng</span>
                        <div class="flex items-center gap-2">
                            <span class="text-xl font-black uppercase tracking-widest tracking-tighter">
                                @if($order->status === 'pending') Chờ xử lý @elseif($order->status === 'processing') Đang xử lý @elseif($order->status === 'shipping') Đang giao hàng @elseif($order->status === 'completed') Hoàn tất @else Đã hủy @endif
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] font-black uppercase opacity-70 block mb-1">Tổng cộng</span>
                        <span class="text-2xl font-black">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h3 class="text-xs font-black uppercase tracking-widest text-primary mb-4 border-b border-primary/10 pb-2">Thông tin khách hàng</h3>
                            <div class="space-y-3">
                                <div class="flex gap-3">
                                    <i class="fa-solid fa-user text-slate-400 w-4"></i>
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $order->customer_name }}</span>
                                </div>
                                <div class="flex gap-3">
                                    <i class="fa-solid fa-phone text-slate-400 w-4"></i>
                                    <span class="text-sm text-slate-500">{{ $order->customer_phone }}</span>
                                </div>
                                <div class="flex gap-3">
                                    <i class="fa-solid fa-location-dot text-slate-400 w-4"></i>
                                    <span class="text-sm text-slate-500 leading-relaxed">{{ $order->shipping_address }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xs font-black uppercase tracking-widest text-primary mb-4 border-b border-primary/10 pb-2">Thông tin thanh toán</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-400">Phương thức:</span>
                                    <span class="font-bold text-slate-700 dark:text-slate-200 uppercase">{{ $order->payment_method }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-400">Thời gian đặt:</span>
                                    <span class="text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                @if($order->note)
                                <div class="mt-4 p-3 bg-slate-50 dark:bg-slate-900 rounded-lg italic text-xs text-slate-500">
                                    "{{ $order->note }}"
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h3 class="text-xs font-black uppercase tracking-widest text-primary mb-4 border-b border-primary/10 pb-2">Chi tiết sản phẩm</h3>
                    <div class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($order->items as $item)
                        <div class="py-4 flex items-center gap-4">
                            <div class="w-12 h-12 rounded bg-slate-50 dark:bg-slate-900 border border-slate-100 flex-shrink-0">
                                <img class="w-full h-full object-contain p-1" src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://placehold.co/400x400?text=No+Image' }}" alt="{{ $item->product->name }}">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200 line-clamp-1">{{ $item->product->name }}</h4>
                                <p class="text-xs text-slate-500">{{ number_format($item->price, 0, ',', '.') }}₫ x {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-bold text-slate-900 dark:text-white">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
