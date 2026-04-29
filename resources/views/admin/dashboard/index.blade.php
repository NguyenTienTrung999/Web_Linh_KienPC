@extends('layouts.admin')

@section('title', 'Tổng quan - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Tổng quan hệ thống</h2>
            <p class="text-slate-500 text-sm font-medium">Cập nhật lúc {{ now()->format('H:i, d/m/Y') }}</p>
        </div>
        <div class="flex items-center gap-2" x-data="{ period: '{{ $period ?? '7days' }}' }">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center gap-2">
                <div x-show="period === 'custom'" class="flex items-center gap-2" x-cloak>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-4 py-2.5 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary shadow-sm hover:border-slate-300 dark:hover:border-slate-600 transition-all cursor-pointer">
                    <span class="text-slate-400 text-xs font-bold">-</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-4 py-2.5 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary shadow-sm hover:border-slate-300 dark:hover:border-slate-600 transition-all cursor-pointer">
                </div>
                <select name="period" x-model="period" @change="if(period !== 'custom') $el.form.submit()" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 pl-5 pr-10 py-2.5 rounded-2xl text-xs font-bold uppercase tracking-wider outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary shadow-sm hover:border-slate-300 dark:hover:border-slate-600 transition-all cursor-pointer">
                    <option value="7days">7 Ngày qua</option>
                    <option value="month">Tháng hiện tại</option>
                    <option value="year">Năm hiện tại</option>
                    <option value="custom">Tùy chỉnh ngày...</option>
                </select>
                <button x-show="period === 'custom'" type="submit" class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-2xl text-xs font-bold uppercase tracking-widest shadow-lg shadow-primary/30 transition-all hover:-translate-y-0.5 active:translate-y-0" x-cloak>
                    Lọc
                </button>
            </form>
            <a href="{{ route('admin.reports.export', request()->query()) }}" class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-2xl text-xs font-bold uppercase tracking-widest flex items-center gap-2 shadow-lg shadow-primary/20 transition-all hover:-translate-y-0.5 active:translate-y-0 ml-2">
                <i class="fa-solid fa-file-export"></i> Xuất báo cáo
            </a>
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
            <div class="h-64 flex flex-col w-full overflow-hidden relative z-0">
                <div id="dashboardRevenueChart" style="min-height: 256px;"></div>
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
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-xl">Đơn hàng gần đây</h3>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Thanh toán & Xử lý gần đây</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 rounded-xl text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest hover:bg-slate-200 transition-colors">
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-slate-400 text-sm italic font-medium">Chưa có đơn hàng nào trong hệ thống.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const salesData = @json($salesData);
        const labels = @json($labels);
        
        const isDarkMode = document.documentElement.classList.contains('dark');
        const textColor = isDarkMode ? '#94a3b8' : '#64748b';
        const gridColor = isDarkMode ? '#334155' : '#f1f5f9';

        const options = {
            series: [{
                name: 'Doanh thu',
                data: salesData
            }],
            chart: {
                type: 'area',
                height: 256,
                fontFamily: "'Be Vietnam Pro', sans-serif",
                toolbar: { show: false },
                zoom: { enabled: false },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    dynamicAnimation: { enabled: true, speed: 350 }
                }
            },
            colors: ['#2badee'], // Primary color
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 100]
                }
            },
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            xaxis: {
                categories: labels,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: {
                        colors: textColor,
                        fontSize: '10px',
                        fontWeight: 600,
                        cssClass: 'uppercase'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND', maximumFractionDigits: 0 }).format(value);
                    },
                    style: {
                        colors: textColor,
                        fontSize: '11px',
                        fontWeight: 600
                    }
                }
            },
            grid: {
                borderColor: gridColor,
                strokeDashArray: 4,
                yaxis: { lines: { show: true } },
                xaxis: { lines: { show: false } },
                padding: { top: 0, right: 0, bottom: 0, left: 10 }
            },
            tooltip: {
                theme: isDarkMode ? 'dark' : 'light',
                y: {
                    formatter: function (val) {
                        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND', maximumFractionDigits: 0 }).format(val);
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#dashboardRevenueChart"), options);
        chart.render();
    });
</script>
@endpush
