@extends('layouts.admin')

@section('title', 'Báo cáo & Thống kê - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Báo cáo kinh doanh</h2>
            <p class="text-slate-500 text-sm font-medium">Phân tích chuyên sâu về doanh thu và hiệu suất</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-4 py-2.5 rounded-2xl text-xs font-bold uppercase tracking-wider hover:bg-slate-50 transition-colors shadow-sm">
                <i class="fa-solid fa-download mr-2 text-primary"></i> Xuất Excel
            </button>
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
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Daily Revenue Chart (Last 14 Days) -->
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg mb-8">Doanh thu 14 ngày qua</h3>
            <div class="h-64 flex flex-col pt-4">
                <div class="relative flex-1 group">
                    <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                        @php
                            $maxDaily = max($dailyRevenue) ?: 100000;
                            $points = [];
                            foreach($dailyRevenue as $idx => $val) {
                                $x = ($idx / 13) * 100;
                                $y = 90 - (($val / $maxDaily) * 80);
                                $points[] = "$x,$y";
                            }
                            $pathStr = "M " . $points[0] . " " . implode(" ", array_map(fn($p) => "L $p", array_slice($points, 1)));
                        @endphp
                        <path d="{{ $pathStr }} L 100 100 L 0 100 Z" fill="url(#dailyGrad)"></path>
                        <path d="{{ $pathStr }}" fill="none" stroke="#2badee" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <defs>
                            <linearGradient id="dailyGrad" x1="0%" x2="0%" y1="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#2badee;stop-opacity:0.15"></stop>
                                <stop offset="100%" style="stop-color:#2badee;stop-opacity:0"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <div class="flex justify-between mt-4">
                    @foreach($dayLabels as $idx => $label)
                        @if($idx % 2 == 0)
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">{{ $label }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Monthly Revenue Chart (Last 6 Months) -->
        <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm">
            <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg mb-8">Tăng trưởng 6 tháng</h3>
            <div class="h-64 flex items-end justify-between gap-4 pt-4 px-4">
                @php $maxMonthly = max($monthlyRevenue) ?: 100000; @endphp
                @foreach($monthlyRevenue as $idx => $val)
                    <div class="flex-1 flex flex-col items-center gap-4 group">
                        <div class="relative w-full">
                            <div class="bg-indigo-500/10 dark:bg-indigo-500/5 group-hover:bg-indigo-500/20 w-full rounded-t-xl transition-all duration-700" style="height: {{ ($val / $maxMonthly) * 160 }}px"></div>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-slate-900 text-white text-[8px] font-black px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                {{ number_format($val, 0, ',', '.') }}₫
                            </div>
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">{{ $monthLabels[$idx] }}</span>
                    </div>
                @endforeach
            </div>
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
