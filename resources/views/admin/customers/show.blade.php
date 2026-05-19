@extends('layouts.admin')

@section('title', 'Chi tiết khách hàng - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8 pb-12">
    <!-- Header & Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.customers.index') }}" class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 text-slate-400 hover:text-primary flex items-center justify-center transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Chi tiết khách hàng</h2>
                <p class="text-slate-500 text-sm font-medium">Hồ sơ cá nhân và lịch sử hoạt động</p>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <form action="{{ route('admin.customers.reset-password', $customer->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn cấp lại mật khẩu cho khách hàng này? Mật khẩu mới sẽ là 123456.')">
                @csrf
                <button type="submit" class="bg-amber-500 text-white px-6 py-2.5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-amber-600 transition-all shadow-lg shadow-amber-500/20 flex items-center gap-2">
                    <i class="fa-solid fa-key"></i>
                    Cấp lại mật khẩu
                </button>
            </form>
            
            @if(auth()->id() !== $customer->id)
            <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này? Thao tác này không thể hoàn tác.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-rose-500 text-white px-6 py-2.5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-rose-600 transition-all shadow-lg shadow-rose-500/20 flex items-center gap-2">
                    <i class="fa-solid fa-trash-can"></i>
                    Xóa tài khoản
                </button>
            </form>
            @endif
        </div>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Col: Profile Info -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden p-8">
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-6">
                        @if($customer->avatar)
                            <img src="{{ asset('storage/' . $customer->avatar) }}" alt="{{ $customer->name }}" class="w-32 h-32 rounded-[2.5rem] object-cover border-4 border-slate-50 dark:border-slate-800 shadow-xl">
                        @else
                            <div class="w-32 h-32 rounded-[2.5rem] bg-indigo-500/10 text-indigo-600 flex items-center justify-center text-3xl font-black uppercase border-4 border-indigo-500/5 shadow-xl">
                                {{ substr($customer->name, 0, 2) }}
                            </div>
                        @endif
                        <div class="absolute -bottom-2 -right-2 bg-emerald-500 w-8 h-8 rounded-xl border-4 border-white dark:border-slate-900 flex items-center justify-center text-white">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $customer->name }}</h3>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">{{ '@' . ($customer->username ?? 'user_' . $customer->id) }}</p>
                    
                    <div class="w-full grid grid-cols-2 gap-4 mt-8">
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl text-center">
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">Đơn hàng</p>
                            <p class="text-lg font-black text-slate-900 dark:text-white">{{ $ordersCount }}</p>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl text-center">
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">Đã chi</p>
                            <p class="text-lg font-black text-primary">{{ number_format($totalSpent, 0, ',', '.') }}đ</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 space-y-6">
                    <div>
                        <h4 class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-address-card text-primary"></i>
                            Thông tin liên hệ
                        </h4>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-envelope text-xs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase">Email</span>
                                    <span class="text-xs font-black text-slate-700 dark:text-slate-300 truncate max-w-[180px]">{{ $customer->email }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-phone text-xs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase">Số điện thoại</span>
                                    <span class="text-xs font-black text-slate-700 dark:text-slate-300">{{ $customer->phone ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-calendar text-xs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase">Ngày tham gia</span>
                                    <span class="text-xs font-black text-slate-700 dark:text-slate-300">{{ $customer->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Address Box -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm p-8">
                <h4 class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-rose-500"></i>
                    Sổ địa chỉ
                </h4>
                
                @if($customer->addresses && $customer->addresses->count() > 0)
                    <div class="space-y-4">
                        @foreach($customer->addresses as $address)
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 relative">
                                @if($address->is_default)
                                    <span class="absolute top-2 right-2 px-2 py-0.5 bg-emerald-500 text-white rounded text-[8px] font-black uppercase">Mặc định</span>
                                @endif
                                <p class="text-xs font-black text-slate-900 dark:text-white mb-2">{{ $address->full_name }}</p>
                                <p class="text-[10px] text-slate-500 font-medium leading-relaxed italic">
                                    {{ implode(', ', array_filter([$address->address, $address->district, $address->city])) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fa-solid fa-map-location-dot text-2xl text-slate-200 mb-2 block"></i>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Chưa có địa chỉ nào</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Col: Orders -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
                    <h4 class="text-[10px] text-slate-400 font-black uppercase tracking-widest flex items-center gap-2">
                        <i class="fa-solid fa-shopping-bag text-indigo-500"></i>
                        Lịch sử đơn hàng
                    </h4>
                    <span class="text-[10px] font-black text-slate-400">{{ $ordersCount }} đơn hàng</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                                <th class="px-8 py-4">Mã đơn</th>
                                <th class="px-8 py-4">Ngày đặt</th>
                                <th class="px-8 py-4">Tổng tiền</th>
                                <th class="px-8 py-4">Trạng thái</th>
                                <th class="px-8 py-4 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($customer->orders as $order)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <span class="text-xs font-black text-slate-900 dark:text-white">#{{ $order->id }}</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="text-xs font-bold text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="text-xs font-black text-primary">{{ number_format($order->total_price, 0, ',', '.') }}đ</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400',
                                                'processing' => 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
                                                'shipping' => 'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400',
                                                'completed' => 'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                'cancelled' => 'bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400',
                                            ];
                                            $statusLabels = [
                                                'pending' => 'Chờ xử lý',
                                                'processing' => 'Đang xử lý',
                                                'shipping' => 'Đang giao',
                                                'completed' => 'Hoàn tất',
                                                'cancelled' => 'Đã hủy',
                                            ];
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase {{ $statusColors[$order->status] ?? 'bg-slate-100 text-slate-600' }}">
                                            {{ $statusLabels[$order->status] ?? $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-[10px] font-black text-primary uppercase hover:underline">
                                            Chi tiết <i class="fa-solid fa-arrow-right ml-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2 text-slate-400">
                                            <i class="fa-solid fa-box-open text-3xl"></i>
                                            <p class="text-xs font-bold uppercase">Khách hàng chưa có đơn hàng nào</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
