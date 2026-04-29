@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Danh sách đơn hàng</h2>
            <p class="text-slate-500 text-sm font-medium">Quản lý và xử lý đơn hàng từ khách hàng</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden flex items-center p-1">
                <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider transition-colors {{ !request('status') ? 'bg-primary text-white' : 'text-slate-500 hover:bg-slate-50' }}">Tất cả</a>
                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider transition-colors {{ request('status') == 'pending' ? 'bg-amber-500 text-white' : 'text-slate-500 hover:bg-slate-50' }}">Chờ xử lý</a>
                <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider transition-colors {{ request('status') == 'processing' ? 'bg-primary text-white' : 'text-slate-500 hover:bg-slate-50' }}">Đang giao</a>
                <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider transition-colors {{ request('status') == 'completed' ? 'bg-emerald-500 text-white' : 'text-slate-500 hover:bg-slate-50' }}">Hoàn tất</a>
                <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider transition-colors {{ request('status') == 'cancelled' ? 'bg-red-500 text-white' : 'text-slate-500 hover:bg-slate-50' }}">Đã hủy</a>
            </div>
        </div>
    </div>



    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="px-8 py-5">Mã đơn</th>
                        <th class="px-8 py-5">Khách hàng</th>
                        <th class="px-8 py-5">Phương thức</th>
                        <th class="px-8 py-5">Ngày đặt</th>
                        <th class="px-8 py-5 text-right">Tổng tiền</th>
                        <th class="px-8 py-5 text-center">Trạng thái</th>
                        <th class="px-8 py-5 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($orders as $order)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-primary/5 transition-colors">
                        <td class="px-8 py-5">
                            <span class="text-xs font-black text-primary font-mono bg-primary/5 px-2 py-1 rounded">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $order->customer_name }}</span>
                                <span class="text-[10px] text-slate-400 font-medium">{{ $order->customer_phone }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-[10px] font-black uppercase text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded">
                                {{ $order->payment_method === 'cod' ? 'Tiền mặt (COD)' : 'Chuyển khoản' }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-bold text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <span class="text-sm font-black text-slate-900 dark:text-white font-mono">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            @php
                                $statusMap = [
                                    'pending' => ['label' => 'Chờ xử lý', 'color' => 'bg-amber-500/10 text-amber-600 border-amber-500/20'],
                                    'processing' => ['label' => 'Đang giao', 'color' => 'bg-primary/10 text-primary border-primary/20'],
                                    'completed' => ['label' => 'Hoàn tất', 'color' => 'bg-emerald-500/10 text-emerald-600 border-emerald-500/20'],
                                    'cancelled' => ['label' => 'Đã hủy', 'color' => 'bg-red-500/10 text-red-600 border-red-500/20'],
                                ];
                                $st = $statusMap[$order->status] ?? ['label' => $order->status, 'color' => 'bg-slate-500/10 text-slate-500'];
                            @endphp
                            <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase border {{ $st['color'] }}">
                                {{ $st['label'] }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
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
@endsection
