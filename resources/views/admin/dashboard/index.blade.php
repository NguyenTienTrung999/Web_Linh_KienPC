@extends('layouts.admin')

@section('title', 'Tổng quan - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Tổng quan hệ thống</h2>
            <p class="text-slate-500 text-sm font-medium">Cập nhật lúc {{ now()->format('H:i, d/m/Y') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-calendar-days mr-2"></i> 7 Ngày qua
            </button>
            <button class="bg-primary hover:bg-primary/90 text-white px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-widest flex items-center gap-2 shadow-lg shadow-primary/20 transition-all hover:scale-105 active:scale-95">
                <i class="fa-solid fa-file-export"></i> Xuất báo cáo
            </button>
        </div>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-money-bill-trend-up text-6xl text-primary"></i>
            </div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-12 h-12 bg-primary/10 rounded-xl text-primary flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-wave text-xl"></i>
                </div>
                <span class="text-emerald-500 text-[10px] font-black uppercase flex items-center gap-1 bg-emerald-500/10 px-2 py-1 rounded-full">
                    +12.5% <i class="fa-solid fa-arrow-trend-up"></i>
                </span>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Tổng doanh thu</p>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ number_format($totalRevenue, 0, ',', '.') }}₫</h3>
            <div class="mt-4 w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                <div class="bg-primary h-full rounded-full" style="width: 75%"></div>
            </div>
        </div>

        <!-- Orders -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-cart-shopping text-6xl text-amber-500"></i>
            </div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-12 h-12 bg-amber-500/10 rounded-xl text-amber-600 flex items-center justify-center">
                    <i class="fa-solid fa-bag-shopping text-xl"></i>
                </div>
                <span class="text-rose-500 text-[10px] font-black uppercase flex items-center gap-1 bg-rose-500/10 px-2 py-1 rounded-full">
                    -2.4% <i class="fa-solid fa-arrow-trend-down"></i>
                </span>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Đơn hàng</p>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ number_format($ordersCount) }}</h3>
            <div class="mt-4 w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                <div class="bg-amber-500 h-full rounded-full" style="width: 45%"></div>
            </div>
        </div>

        <!-- Customers -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-users text-6xl text-indigo-500"></i>
            </div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-12 h-12 bg-indigo-500/10 rounded-xl text-indigo-600 flex items-center justify-center">
                    <i class="fa-solid fa-user-plus text-xl"></i>
                </div>
                <span class="text-emerald-500 text-[10px] font-black uppercase flex items-center gap-1 bg-emerald-500/10 px-2 py-1 rounded-full">
                    +5.1% <i class="fa-solid fa-arrow-trend-up"></i>
                </span>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Khách hàng</p>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ number_format($customersCount) }}</h3>
            <div class="mt-4 w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                <div class="bg-indigo-500 h-full rounded-full" style="width: 60%"></div>
            </div>
        </div>

        <!-- Products -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-box-open text-6xl text-emerald-500"></i>
            </div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-12 h-12 bg-emerald-500/10 rounded-xl text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-boxes-stacked text-xl"></i>
                </div>
                <span class="text-slate-400 text-[10px] font-black uppercase flex items-center gap-1 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full">
                    Active
                </span>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Sản phẩm</p>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ number_format($productsCount) }}</h3>
            <div class="mt-4 w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                <div class="bg-emerald-500 h-full rounded-full" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Growth Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg">Tăng trưởng doanh số</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">7 ngày vừa qua</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-primary rounded-full"></span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Doanh thu</span>
                </div>
            </div>
            
            <div class="h-64 flex flex-col">
                <!-- SVG Visualization of Sales Data -->
                <div class="relative flex-1 group overflow-hidden">
                    <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100" style="filter: drop-shadow(0 4px 6px rgba(43, 173, 238, 0.1));">
                        @php
                            $maxSales = max($salesData) ?: 100000;
                            $points = [];
                            foreach($salesData as $index => $val) {
                                $x = ($index / 6) * 100;
                                $y = 85 - (($val / $maxSales) * 70); 
                                $points[] = "$x,$y";
                            }
                            $pathString = "M " . $points[0] . " " . implode(" ", array_map(fn($p) => "L $p", array_slice($points, 1)));
                            $fillPath = $pathString . " L 100 100 L 0 100 Z";
                        @endphp
                        <path d="{{ $fillPath }}" fill="url(#chartGradient)"></path>
                        <path d="{{ $pathString }}" fill="none" stroke="#2badee" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                        <defs>
                            <linearGradient id="chartGradient" x1="0%" x2="0%" y1="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#2badee;stop-opacity:0.2"></stop>
                                <stop offset="100%" style="stop-color:#2badee;stop-opacity:0"></stop>
                            </linearGradient>
                        </defs>
                        
                        @foreach($points as $p)
                            @php $parts = explode(',', $p); @endphp
                            <circle cx="{{ $parts[0] }}" cy="{{ $parts[1] }}" r="1.5" fill="white" stroke="#2badee" stroke-width="1.5"></circle>
                        @endforeach
                    </svg>
                </div>
                
                <div class="flex justify-between border-t border-slate-50 dark:border-slate-800 pt-6 mt-4">
                    @foreach($labels as $label)
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">{{ $label }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Categories Distribution -->
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg mb-8">Danh mục sản phẩm</h3>
            <div class="space-y-6">
                @foreach($categories->take(5) as $cat)
                <div class="group">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide group-hover:text-primary transition-colors">{{ $cat['name'] }}</span>
                        <span class="text-[10px] font-black text-slate-400">{{ $cat['count'] }} SP ({{ $cat['percentage'] }}%)</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                        @php
                            $colors = ['bg-primary', 'bg-indigo-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500'];
                            $color = $colors[$loop->index % 5];
                        @endphp
                        <div class="{{ $color }} h-full rounded-full transition-all duration-1000" style="width: {{ $cat['percentage'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-10">
                <a href="{{ route('admin.categories.index') }}" class="w-full py-3 border-2 border-slate-100 dark:border-slate-800 rounded-2xl text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center block hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    Quản lý danh mục
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-xl">Đơn hàng vừa nhận</h3>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Thanh toán & Xử lý gần đây</p>
            </div>
            <a href="#" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 rounded-xl text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest hover:bg-slate-200 transition-colors">
                Xem tất cả
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="px-8 py-5">Mã đơn</th>
                        <th class="px-8 py-5">Khách hàng</th>
                        <th class="px-8 py-5">Ngày đặt</th>
                        <th class="px-8 py-5 text-right">Tổng tiền</th>
                        <th class="px-8 py-5 text-center">Trạng thái</th>
                        <th class="px-8 py-5 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($recentOrders as $order)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-emerald-500/5 transition-colors">
                        <td class="px-8 py-5">
                            <span class="text-xs font-black text-primary font-mono bg-primary/5 px-2 py-1 rounded">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 uppercase">
                                    {{ substr($order->customer_name, 0, 2) }}
                                </div>
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $order->customer_name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-bold text-slate-500">{{ $order->created_at->format('d/m/Y') }}</span>
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
                            <button class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-400 hover:text-primary hover:border-primary transition-all shadow-sm">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-10 text-center text-slate-400 text-sm italic font-medium">Chưa có đơn hàng nào trong hệ thống.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
