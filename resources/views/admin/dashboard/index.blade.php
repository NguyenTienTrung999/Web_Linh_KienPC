@extends('layouts.admin')

@section('title', 'Tổng quan - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-50">Tổng quan hệ thống</h2>
            <p class="text-slate-500 text-sm">Cập nhật lúc {{ now()->format('h:i A, d/m/Y') }}</p>
        </div>
        <button class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 shadow-sm shadow-primary/20">
            <i class="fa-solid fa-download text-xs"></i>
            Xuất báo cáo
        </button>
    </div>

    <!-- Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-slate-900 p-6 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-primary/10 rounded-lg text-primary">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
                <span class="text-emerald-500 text-xs font-semibold flex items-center gap-1">+12.5% <i class="fa-solid fa-arrow-trend-up text-[10px]"></i></span>
            </div>
            <p class="text-slate-500 text-sm font-medium">Doanh thu tháng</p>
            <h3 class="text-2xl font-bold mt-1">250.000.000đ</h3>
            <div class="mt-4 w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                <div class="bg-primary h-full rounded-full" style="width: 75%"></div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-900 p-6 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg text-amber-600">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <span class="text-rose-500 text-xs font-semibold flex items-center gap-1">-2.4% <i class="fa-solid fa-arrow-trend-down text-[10px]"></i></span>
            </div>
            <p class="text-slate-500 text-sm font-medium">Đơn hàng mới</p>
            <h3 class="text-2xl font-bold mt-1">1,240</h3>
            <div class="mt-4 w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                <div class="bg-amber-500 h-full rounded-full" style="width: 45%"></div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 p-6 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg text-indigo-600">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <span class="text-emerald-500 text-xs font-semibold flex items-center gap-1">+5.1% <i class="fa-solid fa-arrow-trend-up text-[10px]"></i></span>
            </div>
            <p class="text-slate-500 text-sm font-medium">Khách hàng mới</p>
            <h3 class="text-2xl font-bold mt-1">850</h3>
            <div class="mt-4 w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                <div class="bg-indigo-500 h-full rounded-full" style="width: 60%"></div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Line Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 p-6 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-lg">Tăng trưởng doanh số</h3>
                <select class="text-xs bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg py-1 px-2">
                    <option>7 ngày qua</option>
                    <option>30 ngày qua</option>
                </select>
            </div>
            <div class="h-64 flex flex-col justify-end gap-2">
                <div class="relative flex-1">
                    <svg class="w-full h-full" preserveAspectratio="none" viewBox="0 0 100 100">
                        <path d="M0,80 Q10,75 20,40 T40,50 T60,30 T80,45 T100,20" fill="none" stroke="#2badee" stroke-width="2" vector-effect="non-scaling-stroke"></path>
                        <path d="M0,80 Q10,75 20,40 T40,50 T60,30 T80,45 T100,20 L100,100 L0,100 Z" fill="url(#chartGradient)"></path>
                        <defs>
                            <linearGradient id="chartGradient" x1="0%" x2="0%" y1="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#2badee;stop-opacity:0.2"></stop>
                                <stop offset="100%" style="stop-color:#2badee;stop-opacity:0"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <div class="flex justify-between text-[10px] font-bold text-slate-400 tracking-wider">
                    <span>THỨ 2</span>
                    <span>THỨ 3</span>
                    <span>THỨ 4</span>
                    <span>THỨ 5</span>
                    <span>THỨ 6</span>
                    <span>THỨ 7</span>
                    <span>CN</span>
                </div>
            </div>
        </div>

        <!-- Pie Chart / Best Selling -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm">
            <h3 class="font-bold text-lg mb-6">Sản phẩm bán chạy</h3>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-primary rounded-full"></div>
                    <div class="flex-1">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium">Điện thoại</span>
                            <span class="text-slate-500">45%</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full">
                            <div class="bg-primary h-full rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-indigo-500 rounded-full"></div>
                    <div class="flex-1">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium">Laptop</span>
                            <span class="text-slate-500">30%</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full">
                            <div class="bg-indigo-500 h-full rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-amber-500 rounded-full"></div>
                    <div class="flex-1">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium">Phụ kiện</span>
                            <span class="text-slate-500">15%</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full">
                            <div class="bg-amber-500 h-full rounded-full" style="width: 15%"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-slate-400 rounded-full"></div>
                    <div class="flex-1">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium">Khác</span>
                            <span class="text-slate-500">10%</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full">
                            <div class="bg-slate-400 h-full rounded-full" style="width: 10%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <button class="text-primary text-sm font-semibold hover:underline">Xem chi tiết sản phẩm</button>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-lg">Đơn hàng gần đây</h3>
            <button class="text-primary text-sm font-semibold hover:underline">Tất cả đơn hàng</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Mã đơn hàng</th>
                        <th class="px-6 py-4">Khách hàng</th>
                        <th class="px-6 py-4">Ngày đặt</th>
                        <th class="px-6 py-4">Tổng tiền</th>
                        <th class="px-6 py-4">Trạng thái</th>
                        <th class="px-6 py-4 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium">#TF-9021</td>
                        <td class="px-6 py-4 text-sm">Nguyễn Văn A</td>
                        <td class="px-6 py-4 text-sm text-slate-500">12/10/2023</td>
                        <td class="px-6 py-4 text-sm font-semibold">15.500.000đ</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 uppercase">Hoàn tất</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-1 hover:bg-slate-100 dark:hover:bg-slate-800 rounded text-slate-400">
                                <i class="fa-solid fa-eye text-lg"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium">#TF-9020</td>
                        <td class="px-6 py-4 text-sm">Trần Thị B</td>
                        <td class="px-6 py-4 text-sm text-slate-500">12/10/2023</td>
                        <td class="px-6 py-4 text-sm font-semibold">2.450.000đ</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-primary/10 text-primary uppercase">Đang giao</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-1 hover:bg-slate-100 dark:hover:bg-slate-800 rounded text-slate-400">
                                <i class="fa-solid fa-eye text-lg"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium">#TF-9019</td>
                        <td class="px-6 py-4 text-sm">Lê Minh C</td>
                        <td class="px-6 py-4 text-sm text-slate-500">11/10/2023</td>
                        <td class="px-6 py-4 text-sm font-semibold">8.900.000đ</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 uppercase">Chờ xử lý</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-1 hover:bg-slate-100 dark:hover:bg-slate-800 rounded text-slate-400">
                                <i class="fa-solid fa-eye text-lg"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
