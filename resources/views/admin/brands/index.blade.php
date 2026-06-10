@extends('layouts.admin')

@section('title', 'Quản Lý Thương Hiệu - TechFlow Admin')

@section('content')
<div class="flex flex-col gap-4 md:flex-row md:items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <div class="text-primary">
            <i class="fa-solid fa-copyright text-3xl"></i>
        </div>
        <div>
            <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">Thương hiệu</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Quản lý danh sách các hãng sản xuất</p>
        </div>
    </div>
    
    <a href="{{ route('admin.brands.create') }}" class="w-full md:w-auto justify-center bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
        <i class="fa-solid fa-plus"></i>
        Thêm thương hiệu mới
    </a>
</div>



<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Logo</th>
                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Tên thương hiệu</th>
                    <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400 text-center">Số sản phẩm</th>
                    <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Ngày tạo</th>
                    <th class="hidden md:table-cell px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                @forelse($brands as $brand)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors group cursor-pointer md:cursor-default" onclick="handleBrandRowClick(event, {
                    id: '{{ $brand->id }}',
                    name: '{{ addslashes($brand->name) }}',
                    productsCount: '{{ $brand->products_count ?? 0 }} sản phẩm',
                    createdAt: '{{ $brand->created_at->format('d/m/Y') }}',
                    editUrl: '{{ route('admin.brands.edit', $brand) }}',
                    deleteUrl: '{{ route('admin.brands.destroy', $brand) }}'
                })">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 bg-white rounded-lg border border-slate-100 dark:border-slate-700 p-1 flex items-center justify-center overflow-hidden">
                            @if($brand->logo)
                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-image text-xs"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">{{ $brand->name }}</span>
                    </td>
                    <td class="hidden md:table-cell px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary/10 text-primary">
                            {{ $brand->products_count ?? 0 }}
                        </span>
                    </td>
                    <td class="hidden md:table-cell px-6 py-4">
                        <span class="text-xs text-slate-500 dark:text-slate-400 font-medium italic">{{ $brand->created_at->format('d/m/Y') }}</span>
                    </td>
                    <td class="hidden md:table-cell px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="p-2 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-all" title="Sửa">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')" class="inline">
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
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-copyright text-5xl text-slate-200 dark:text-slate-700 mb-4"></i>
                            <p class="text-slate-500 dark:text-slate-400 font-medium">Chưa có thương hiệu nào được tạo.</p>
                            <a href="{{ route('admin.brands.create') }}" class="mt-4 text-primary font-bold hover:underline">Tạo thương hiệu đầu tiên ngay</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Mobile Brand Detail Modal -->
<div id="brand-detail-modal" class="fixed inset-0 z-[10000] hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" onclick="if(event.target === this) closeBrandModal()">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-sm w-full overflow-hidden shadow-2xl border border-slate-100 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="brand-modal-card">
        <!-- Header -->
        <div class="p-5 pb-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-base text-slate-900 dark:text-white">Chi tiết thương hiệu</h3>
            <button onclick="closeBrandModal()" class="text-slate-400 hover:text-slate-650 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>
        <!-- Body -->
        <div class="p-5 space-y-4">
            <div>
                <h4 id="brand-modal-name" class="font-bold text-base text-slate-900 dark:text-white leading-snug"></h4>
                <p class="text-xs text-slate-500 mt-1">ID: <span id="brand-modal-id"></span></p>
            </div>
            
            <div class="divide-y divide-slate-100 dark:divide-slate-800 text-xs">
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Số sản phẩm:</span>
                    <span id="brand-modal-count" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Ngày tạo:</span>
                    <span id="brand-modal-date" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
            </div>
        </div>
        <!-- Footer / Actions -->
        <div class="p-5 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex items-center gap-3">
            <a id="brand-modal-edit-btn" href="" class="flex-1 justify-center bg-primary text-white py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors text-xs shadow-md shadow-primary/10">
                <i class="fa-solid fa-pen-to-square"></i>
                Chỉnh sửa
            </a>
            <form id="brand-modal-delete-form" action="" method="POST" class="flex-1" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full justify-center bg-red-500 hover:bg-red-650 text-white py-2.5 rounded-xl font-bold flex items-center gap-2 transition-colors text-xs shadow-md shadow-red-500/10 cursor-pointer">
                    <i class="fa-solid fa-trash-can"></i>
                    Xóa thương hiệu
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function handleBrandRowClick(event, data) {
        if (event.target.closest('button') || event.target.closest('form') || event.target.closest('a')) {
            return;
        }
        if (window.innerWidth >= 768) return;

        const modal = document.getElementById('brand-detail-modal');
        const card = document.getElementById('brand-modal-card');

        document.getElementById('brand-modal-name').textContent = data.name;
        document.getElementById('brand-modal-id').textContent = data.id;
        document.getElementById('brand-modal-count').textContent = data.productsCount;
        document.getElementById('brand-modal-date').textContent = data.createdAt;

        document.getElementById('brand-modal-edit-btn').href = data.editUrl;
        document.getElementById('brand-modal-delete-form').action = data.deleteUrl;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeBrandModal() {
        const modal = document.getElementById('brand-detail-modal');
        const card = document.getElementById('brand-modal-card');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
