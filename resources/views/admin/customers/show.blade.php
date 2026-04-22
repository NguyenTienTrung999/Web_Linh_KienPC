@extends('layouts.admin')

@section('title', 'Hồ sơ khách hàng: ' . $user->name . ' - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.customers.index') }}" class="w-10 h-10 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl flex items-center justify-center text-slate-500 hover:text-indigo-500 transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Hồ sơ khách hàng</h2>
                <p class="text-slate-500 text-sm font-medium">Chi tiết thông tin và lịch sử hoạt động</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            @if($user->email_verified_at)
            <span class="px-4 py-2 bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i> Đã xác minh
            </span>
            @else
            <span class="px-4 py-2 bg-amber-500/10 text-amber-600 border border-amber-500/20 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i> Chờ xác minh
            </span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar: Profile Card -->
        <div class="space-y-8">
            <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 opacity-5 group-hover:rotate-12 transition-transform duration-700">
                    <i class="fa-solid fa-id-card text-9xl text-indigo-500"></i>
                </div>
                
                <div class="relative z-10 flex flex-col items-center text-center">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-3xl object-cover border-4 border-white dark:border-slate-800 shadow-xl mb-6">
                    @else
                        <div class="w-32 h-32 rounded-3xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center text-3xl font-black uppercase border border-indigo-500/20 shadow-lg mb-6">
                            {{ substr($user->name, 0, 2) }}
                        </div>
                    @endif
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-1 uppercase tracking-tighter">{{ $user->name }}</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-8">{{ '@' . ($user->username ?? 'customer') }}</p>
                    
                    <div class="grid grid-cols-2 w-full gap-4">
                        <div class="p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Tổng đơn</p>
                            <p class="text-lg font-black text-slate-900 dark:text-white font-mono">{{ number_format($ordersCount) }}</p>
                        </div>
                        <div class="p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-800">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Chi tiêu</p>
                            <p class="text-lg font-black text-emerald-500 font-mono">{{ number_format($totalSpent, 0, ',', '.') }}₫</p>
                        </div>
                    </div>
                </div>

                <div class="pt-8 mt-8 border-t border-slate-50 dark:border-slate-800 space-y-5">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-500 flex items-center justify-center">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Email</span>
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $user->email }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Số điện thoại</span>
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $user->phone ?? 'Chưa cập nhật' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-500 flex items-center justify-center">
                            <i class="fa-solid fa-cake-candles text-xs"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Ngày sinh</span>
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : 'Chưa cập nhật' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-lg bg-rose-50 dark:bg-rose-500/10 text-rose-500 flex items-center justify-center">
                            <i class="fa-solid fa-venus-mars text-xs"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Giới tính</span>
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">
                                {{ $user->gender === 'male' ? 'Nam' : ($user->gender === 'female' ? 'Nữ' : 'Khác') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm">
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg mb-6">Địa chỉ mặc định</h3>
                @php $defaultAddr = $user->addresses()->where('is_default', true)->first(); @endphp
                @if($defaultAddr)
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-800 italic text-sm text-slate-600 dark:text-slate-400">
                    <p class="font-bold text-slate-800 dark:text-white not-italic mb-1">{{ $defaultAddr->receiver_name }} - {{ $defaultAddr->receiver_phone }}</p>
                    "{{ $defaultAddr->address }}"
                </div>
                @else
                <p class="text-sm text-slate-400 italic">Chưa có thông tin địa chỉ.</p>
                @endif
            </div>
        </div>

        <!-- Main Content: Order History -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-xl">Lịch sử đơn hàng</h3>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Danh sách đơn hàng của khách hàng</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                                <th class="px-8 py-5">Mã đơn</th>
                                <th class="px-8 py-5">Ngày đặt</th>
                                <th class="px-8 py-5 text-right">Tổng tiền</th>
                                <th class="px-8 py-5 text-center">Trạng thái</th>
                                <th class="px-8 py-5 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($user->orders as $order)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-indigo-500/5 transition-colors">
                                <td class="px-8 py-5">
                                    <span class="text-xs font-black text-indigo-500 font-mono bg-indigo-500/5 px-2 py-1 rounded">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
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
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-400 hover:text-indigo-500 hover:border-indigo-500 items-center justify-center transition-all shadow-sm">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-10 text-center text-slate-400 text-sm italic font-medium">Khách hàng chưa có đơn hàng nào.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 opacity-5 group-hover:rotate-12 transition-transform duration-700">
                    <i class="fa-solid fa-shield-halved text-9xl text-rose-500"></i>
                </div>
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-tighter text-lg mb-4">Vùng nguy hiểm</h3>
                <p class="text-sm text-slate-500 mb-6">Xóa tài khoản khách hàng sẽ xóa toàn bộ thông tin cá nhân. Hãy chắc chắn về quyết định này.</p>
                <form action="{{ route('admin.customers.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này? Thao tác này không thể hoàn tác.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all hover:scale-105 active:scale-95 shadow-lg shadow-rose-500/20">
                        Xóa tài khoản khách hàng
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
