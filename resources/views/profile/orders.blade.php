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
                                            'shipped' => 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400',
                                            'delivered' => 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400',
                                            'cancelled' => 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Chờ xử lý',
                                            'processing' => 'Đang xử lý',
                                            'shipped' => 'Đang giao',
                                            'delivered' => 'Đã giao',
                                            'cancelled' => 'Đã hủy',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full {{ $statusClasses[$order->status] ?? 'bg-slate-100 text-slate-600' }} text-[11px] font-bold">
                                        {{ $statusLabels[$order->status] ?? $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('order.status', $order->id) }}" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 transition-colors text-sm font-bold">
                                        <span>Chi tiết</span>
                                        <i class="fa-solid fa-arrow-right-long text-xs"></i>
                                    </a>
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
@endsection
