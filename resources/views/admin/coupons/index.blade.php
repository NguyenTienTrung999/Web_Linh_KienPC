@extends('layouts.admin')

@section('title', 'Quản Lý Khuyến Mãi - TechFlow Admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <div class="text-primary">
            <i class="fa-solid fa-ticket text-3xl"></i>
        </div>
        <div>
            <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">Khuyến mãi</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Quản lý danh sách các mã giảm giá</p>
        </div>
    </div>
    
    <a href="{{ route('admin.coupons.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
        <i class="fa-solid fa-plus"></i>
        Thêm mã mới
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-600 p-4 rounded-lg mb-6 text-sm font-semibold flex items-center gap-2">
    <i class="fa-solid fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Mã giảm giá</th>
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Mức giảm</th>
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Đơn tối thiểu</th>
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Thời hạn</th>
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Đã dùng</th>
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Trạng thái</th>
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                @forelse($coupons as $coupon)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors group">
                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-slate-900 dark:text-white uppercase">{{ $coupon->code }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($coupon->discount_type === 'percent')
                            <span class="text-sm font-bold text-red-500">-{{ $coupon->discount_value }}%</span>
                        @else
                            <span class="text-sm font-bold text-red-500">-{{ number_format($coupon->discount_value, 0, ',', '.') }}₫</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-slate-600 dark:text-slate-300">{{ number_format($coupon->min_order_value, 0, ',', '.') }}₫</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs text-slate-500 dark:text-slate-400 flex flex-col gap-1">
                            @if($coupon->valid_from)
                                <span><i class="fa-solid fa-play w-4 text-slate-300"></i> {{ $coupon->valid_from->format('d/m/Y H:i') }}</span>
                            @endif
                            @if($coupon->valid_to)
                                <span><i class="fa-solid fa-stop w-4 text-slate-300"></i> {{ $coupon->valid_to->format('d/m/Y H:i') }}</span>
                            @endif
                            @if(!$coupon->valid_from && !$coupon->valid_to)
                                <span>Vô thời hạn</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-slate-600 dark:text-slate-300">
                            {{ $coupon->used_count }} / {{ $coupon->usage_limit ?: '∞' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if(!$coupon->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                Đã khóa
                            </span>
                        @elseif($coupon->isExpired())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                Hết hạn
                            </span>
                        @elseif($coupon->isFull())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400">
                                Hết lượt
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                Đang hoạt động
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-all" title="Sửa">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all" title="Xóa">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-ticket text-5xl text-slate-200 dark:text-slate-700 mb-4"></i>
                            <p class="text-slate-500 dark:text-slate-400 font-medium">Chưa có mã giảm giá nào được tạo.</p>
                            <a href="{{ route('admin.coupons.create') }}" class="mt-4 text-primary font-bold hover:underline">Tạo mã giảm giá đầu tiên ngay</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-slate-200 dark:border-slate-800">
        {{ $coupons->links() }}
    </div>
</div>
@endsection
