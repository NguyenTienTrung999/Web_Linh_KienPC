@extends('layouts.admin')

@section('title', 'Quản Lý Khuyến Mãi - TechFlow Admin')

@section('content')
<div class="flex flex-col gap-4 md:flex-row md:items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <div class="text-primary">
            <i class="fa-solid fa-ticket text-3xl"></i>
        </div>
        <div>
            <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">Khuyến mãi</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Quản lý danh sách các mã giảm giá</p>
        </div>
    </div>
    
    <a href="{{ route('admin.coupons.create') }}" class="w-full md:w-auto justify-center bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
        <i class="fa-solid fa-plus"></i>
        Thêm mã mới
    </a>
</div>



<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Mã giảm giá</th>
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Mức giảm</th>
                    <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Đơn tối thiểu</th>
                    <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Thời hạn</th>
                    <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Đã dùng</th>
                    <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Trạng thái</th>
                    <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                @forelse($coupons as $coupon)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors group cursor-pointer md:cursor-default" onclick="handleCouponRowClick(event, {
                    id: '{{ $coupon->id }}',
                    code: '{{ addslashes($coupon->code) }}',
                    discount: '@if($coupon->discount_type === "percent")-{{ $coupon->discount_value }}%@else -{{ number_format($coupon->discount_value, 0, ',', '.') }}₫@endif',
                    minOrder: '{{ number_format($coupon->min_order_value, 0, ',', '.') }}₫',
                    validFrom: '{{ $coupon->valid_from ? $coupon->valid_from->format('d/m/Y H:i') : 'Vô thời hạn' }}',
                    validTo: '{{ $coupon->valid_to ? $coupon->valid_to->format('d/m/Y H:i') : 'Vô thời hạn' }}',
                    used: '{{ $coupon->used_count }} / {{ $coupon->usage_limit ?: '∞' }}',
                    status: '@if(!$coupon->is_active) Đã khóa @elseif($coupon->isExpired()) Hết hạn @elseif($coupon->isFull()) Hết lượt @else Đang hoạt động @endif',
                    statusClass: '@if(!$coupon->is_active) bg-slate-100 text-slate-705 dark:bg-slate-800 dark:text-slate-400 @elseif($coupon->isExpired()) bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 @elseif($coupon->isFull()) bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400 @else bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 @endif',
                    editUrl: '{{ route('admin.coupons.edit', $coupon) }}',
                    deleteUrl: '{{ route('admin.coupons.destroy', $coupon) }}'
                })">
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
                    <td class="hidden md:table-cell px-6 py-4">
                        <span class="text-sm text-slate-600 dark:text-slate-300">{{ number_format($coupon->min_order_value, 0, ',', '.') }}₫</span>
                    </td>
                    <td class="hidden md:table-cell px-6 py-4">
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
                    <td class="hidden md:table-cell px-6 py-4">
                        <span class="text-sm text-slate-600 dark:text-slate-300">
                            {{ $coupon->used_count }} / {{ $coupon->usage_limit ?: '∞' }}
                        </span>
                    </td>
                    <td class="hidden md:table-cell px-6 py-4">
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
                    <td class="hidden md:table-cell px-6 py-4 text-right">
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

<!-- Mobile Coupon Detail Modal -->
<div id="coupon-detail-modal" class="fixed inset-0 z-[10000] hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" onclick="if(event.target === this) closeCouponModal()">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-sm w-full overflow-hidden shadow-2xl border border-slate-100 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="coupon-modal-card">
        <!-- Header -->
        <div class="p-5 pb-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-base text-slate-900 dark:text-white">Chi tiết mã giảm giá</h3>
            <button onclick="closeCouponModal()" class="text-slate-400 hover:text-slate-650 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>
        <!-- Body -->
        <div class="p-5 space-y-4">
            <div>
                <h4 id="coupon-modal-code" class="font-bold text-base text-slate-900 dark:text-white uppercase leading-snug"></h4>
                <p class="text-xs text-slate-500 mt-1">ID: <span id="coupon-modal-id"></span></p>
            </div>
            
            <div class="divide-y divide-slate-100 dark:divide-slate-800 text-xs">
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Mức giảm:</span>
                    <span id="coupon-modal-discount" class="font-semibold text-red-500"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Đơn tối thiểu:</span>
                    <span id="coupon-modal-min-order" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Bắt đầu:</span>
                    <span id="coupon-modal-from" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Kết thúc:</span>
                    <span id="coupon-modal-to" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Đã dùng:</span>
                    <span id="coupon-modal-used" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between items-center">
                    <span class="text-slate-500">Trạng thái:</span>
                    <span id="coupon-modal-status" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold"></span>
                </div>
            </div>
        </div>
        <!-- Footer / Actions -->
        <div class="p-5 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex items-center gap-3">
            <a id="coupon-modal-edit-btn" href="" class="flex-1 justify-center bg-primary text-white py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors text-xs shadow-md shadow-primary/10">
                <i class="fa-solid fa-pen-to-square"></i>
                Chỉnh sửa
            </a>
            <form id="coupon-modal-delete-form" action="" method="POST" class="flex-1" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full justify-center bg-red-500 hover:bg-red-650 text-white py-2.5 rounded-xl font-bold flex items-center gap-2 transition-colors text-xs shadow-md shadow-red-500/10 cursor-pointer">
                    <i class="fa-solid fa-trash-can"></i>
                    Xóa mã
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function handleCouponRowClick(event, data) {
        if (event.target.closest('button') || event.target.closest('form') || event.target.closest('a')) {
            return;
        }
        if (window.innerWidth >= 768) return;

        const modal = document.getElementById('coupon-detail-modal');
        const card = document.getElementById('coupon-modal-card');

        document.getElementById('coupon-modal-code').textContent = data.code;
        document.getElementById('coupon-modal-id').textContent = data.id;
        document.getElementById('coupon-modal-discount').textContent = data.discount;
        document.getElementById('coupon-modal-min-order').textContent = data.minOrder;
        document.getElementById('coupon-modal-from').textContent = data.validFrom;
        document.getElementById('coupon-modal-to').textContent = data.validTo;
        document.getElementById('coupon-modal-used').textContent = data.used;
        
        const statusEl = document.getElementById('coupon-modal-status');
        statusEl.textContent = data.status;
        statusEl.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold ' + data.statusClass;

        document.getElementById('coupon-modal-edit-btn').href = data.editUrl;
        document.getElementById('coupon-modal-delete-form').action = data.deleteUrl;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeCouponModal() {
        const modal = document.getElementById('coupon-detail-modal');
        const card = document.getElementById('coupon-modal-card');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
