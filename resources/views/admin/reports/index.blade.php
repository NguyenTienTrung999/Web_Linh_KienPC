@extends('layouts.admin')

@section('title', 'Báo cáo & Thống kê - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Báo cáo kinh doanh</h2>
            <p class="text-slate-500 text-sm font-medium">
                @if($period == 'today')
                    Dữ liệu ngày hôm nay
                @elseif($period == 'week')
                    Dữ liệu trong tuần này
                @elseif($period == 'month')
                    Dữ liệu tháng hiện tại
                @elseif($period == 'quarter')
                    Dữ liệu quý hiện tại
                @elseif($period == 'year')
                    Dữ liệu năm hiện tại
                @elseif($period == 'custom')
                    Dữ liệu từ {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} đến {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
                @endif
            </p>
        </div>
        <div class="flex items-center gap-2" x-data="{ period: '{{ $period ?? 'month' }}' }">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="flex items-center gap-2">
                <div x-show="period === 'custom'" class="flex items-center gap-2" x-cloak>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-4 py-2.5 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary shadow-sm hover:border-slate-300 dark:hover:border-slate-600 transition-all cursor-pointer">
                    <span class="text-slate-400 text-xs font-bold">-</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-4 py-2.5 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary shadow-sm hover:border-slate-300 dark:hover:border-slate-600 transition-all cursor-pointer">
                </div>
                <select name="period" x-model="period" @change="if(period !== 'custom') $el.form.submit()" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 pl-5 pr-10 py-2.5 rounded-2xl text-xs font-bold uppercase tracking-wider outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary shadow-sm hover:border-slate-300 dark:hover:border-slate-600 transition-all cursor-pointer">
                    <option value="today">Hôm nay</option>
                    <option value="week">Tuần này</option>
                    <option value="month">Tháng hiện tại</option>
                    <option value="quarter">Quý hiện tại</option>
                    <option value="year">Năm hiện tại</option>
                    <option value="custom">Tùy chỉnh ngày...</option>
                </select>
                <button x-show="period === 'custom'" type="submit" class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-2xl text-xs font-bold uppercase tracking-widest shadow-lg shadow-primary/30 transition-all hover:-translate-y-0.5 active:translate-y-0" x-cloak>
                    Lọc
                </button>
            </form>
            <a href="{{ route('admin.reports.export', request()->query()) }}" class="inline-block bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-5 py-2.5 rounded-2xl text-xs font-bold uppercase tracking-wider hover:bg-slate-50 dark:hover:bg-slate-700 transition-all hover:-translate-y-0.5 active:translate-y-0 shadow-sm ml-2 group">
                <i class="fa-solid fa-download mr-2 text-primary group-hover:scale-110 transition-transform"></i> Xuất Excel
            </a>
        </div>
    </div>

    <!-- Summary Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -top-6 -right-6 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-coins text-8xl text-emerald-500"></i>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2 relative z-10">TỔNG DOANH THU (HOÀN TẤT)</p>
            <h3 class="text-3xl font-black text-slate-900 dark:text-white relative z-10 font-mono">{{ number_format($totalRevenue, 0, ',', '.') }}₫</h3>
            <div class="mt-4 flex items-center gap-2 text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-1 rounded-full w-fit relative z-10">
                <i class="fa-solid fa-arrow-up"></i> +15% so với tháng trước
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -top-6 -right-6 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-file-invoice-dollar text-8xl text-primary"></i>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2 relative z-10">GIÁ TRỊ ĐƠN TRUNG BÌNH</p>
            <h3 class="text-3xl font-black text-slate-900 dark:text-white relative z-10 font-mono">{{ number_format($averageOrderValue, 0, ',', '.') }}₫</h3>
            <div class="mt-4 flex items-center gap-2 text-[10px] font-bold text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-full w-fit relative z-10">
                Dựa trên {{ number_format($totalOrders) }} đơn hàng
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -top-6 -right-6 opacity-5 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-chart-pie text-8xl text-amber-500"></i>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-2 relative z-10">TỶ LỆ CHUYỂN ĐỔI</p>
            @php $convRate = $totalOrders > 0 ? ($statusCounts->where('status', 'completed')->first()->count ?? 0) / $totalOrders * 100 : 0; @endphp
            <h3 class="text-3xl font-black text-slate-900 dark:text-white relative z-10 font-mono">{{ round($convRate, 1) }}%</h3>
            <div class="mt-4 flex items-center gap-2 text-[10px] font-bold text-amber-600 bg-amber-500/10 px-2 py-1 rounded-full w-fit relative z-10">
                Đơn hàng thành công
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden mb-8 relative z-0">
        <div class="p-6 md:p-8 border-b border-slate-50 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-xl">Phân tích Doanh Thu</h3>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Biểu đồ đường cong xu hướng</p>
            </div>
            
        </div>
        <div class="p-2 md:p-6 w-full overflow-hidden">
            <div id="revenueChart" style="min-height: 380px;"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Top Products Table -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 dark:border-slate-800">
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-xl">Sản phẩm bán chạy nhất</h3>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Xếp hạng theo số lượng bán ra</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                            <th class="px-8 py-4">Sản phẩm</th>
                            <th class="px-8 py-4 text-center">Đã bán</th>
                            <th class="px-8 py-4 text-right">Doanh thu</th>
                            <th class="px-8 py-4 text-right">Tỷ trọng</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($topProducts as $item)
                        <tr class="group hover:bg-slate-50/50 dark:hover:bg-emerald-500/5 transition-colors">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $item->product->image }}" class="w-10 h-10 rounded-xl object-cover bg-slate-50">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300 truncate max-w-[200px]">{{ $item->product->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-center">
                                <span class="text-xs font-black text-slate-900 dark:text-white">{{ number_format($item->total_qty) }}</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <span class="text-sm font-black text-emerald-500 font-mono">{{ number_format($item->total_revenue, 0, ',', '.') }}₫</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                @php $pct = $totalRevenue > 0 ? ($item->total_revenue / $totalRevenue) * 100 : 0; @endphp
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ round($pct, 1) }}%</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Category Breakdown -->
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-xl mb-8">Doanh thu danh mục</h3>
            <div class="space-y-6">
                @foreach($categoryRevenue->take(5) as $cat)
                @php $catPct = $totalRevenue > 0 ? ($cat->revenue / $totalRevenue) * 100 : 0; @endphp
                <div class="group">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide">{{ $cat->name }}</span>
                        <span class="text-[10px] font-black text-slate-400 font-mono">{{ number_format($cat->revenue, 0, ',', '.') }}₫</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                        @php
                            $colors = ['bg-primary', 'bg-indigo-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500'];
                            $color = $colors[$loop->index % 5];
                        @endphp
                        <div class="{{ $color }} h-full rounded-full transition-all duration-1000" style="width: {{ $catPct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-12 bg-slate-50 dark:bg-slate-800/50 p-6 rounded-3xl border border-slate-100 dark:border-slate-800">
                <h4 class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4">Trạng thái đơn hàng</h4>
                <div class="space-y-3">
                    @foreach($statusCounts as $sc)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-500',
                                    'processing' => 'bg-primary',
                                    'completed' => 'bg-emerald-500',
                                    'cancelled' => 'bg-red-500',
                                ];
                                $color = $statusColors[$sc->status] ?? 'bg-slate-500';
                            @endphp
                            <span class="w-1.5 h-1.5 rounded-full {{ $color }}"></span>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $sc->status }}</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-700 dark:text-slate-300">{{ $sc->count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($chartData);
        const chartLabels = @json($chartLabels);
        
        const isDarkMode = document.documentElement.classList.contains('dark');
        const textColor = isDarkMode ? '#94a3b8' : '#64748b';
        const gridColor = isDarkMode ? '#334155' : '#f1f5f9';

        const options = {
            series: [{
                name: 'Doanh thu',
                data: chartData
            }],
            chart: {
                type: 'area',
                height: 380,
                fontFamily: "'Be Vietnam Pro', sans-serif",
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }
            },
            colors: ['#8b5cf6'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            xaxis: {
                categories: chartLabels,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: textColor,
                        fontSize: '11px',
                        fontWeight: 600
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
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 10
                }
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

        const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
        chart.render();
    });
</script>
@endpush
