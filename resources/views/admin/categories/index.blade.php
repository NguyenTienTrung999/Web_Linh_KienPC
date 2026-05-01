@extends('layouts.admin')

@section('title', 'Quản lý Danh mục - TechFlow Admin')

@section('content')
<!-- Title & Action -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-3xl font-bold tracking-tight">Quản lý Danh mục</h2>
        <p class="text-slate-500 mt-1">Thêm, sửa, xóa các danh mục sản phẩm.</p>
    </div>
    <button onclick="openAddModal()" class="bg-primary text-white px-6 py-2.5 rounded-xl font-semibold flex items-center gap-2 hover:bg-primary/90 transition-shadow shadow-lg shadow-primary/20">
        <i class="fa-solid fa-plus text-sm"></i>
        Thêm danh mục
    </button>
</div>

<!-- Modal Thêm Danh Mục -->
<div id="addModal" class="fixed inset-0 z-[110] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeAddModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-slate-800">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="bg-white dark:bg-slate-900 px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Thêm Danh Mục Mới</h3>
                        <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-slate-500 transition-colors">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Tên danh mục <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all dark:text-white" placeholder="VD: Bàn phím cơ, Chuột Gaming...">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Mô tả</label>
                            <textarea name="description" id="description" rows="4" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all dark:text-white" placeholder="Nhập mô tả ngắn cho danh mục này..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex flex-row-reverse gap-3">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-xl font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Lưu danh mục</button>
                    <button type="button" onclick="closeAddModal()" class="px-6 py-2 text-slate-600 dark:text-slate-400 font-bold hover:bg-slate-200 dark:hover:bg-slate-800 rounded-xl transition-all">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sửa Danh Mục -->
<div id="editModal" class="fixed inset-0 z-[110] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeEditModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-slate-800">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white dark:bg-slate-900 px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Chỉnh sửa Danh Mục</h3>
                        <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-500 transition-colors">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="edit_name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Tên danh mục <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="edit_name" required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all dark:text-white">
                        </div>
                        <div>
                            <label for="edit_description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Mô tả</label>
                            <textarea name="description" id="edit_description" rows="4" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all dark:text-white"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex flex-row-reverse gap-3">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-xl font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Cập nhật</button>
                    <button type="button" onclick="closeEditModal()" class="px-6 py-2 text-slate-600 dark:text-slate-400 font-bold hover:bg-slate-200 dark:hover:bg-slate-800 rounded-xl transition-all">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Flash Messages -->
@if(session('success'))
    <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 flex items-center gap-3">
        <i class="fa-solid fa-circle-check text-lg"></i>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 flex items-center gap-3">
        <i class="fa-solid fa-triangle-exclamation text-lg"></i>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
@endif

<!-- Table Container -->
<div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Tên danh mục</th>
                    <th class="px-6 py-4">Mô tả</th>
                    <th class="px-6 py-4">Số sản phẩm</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($categories as $index => $category)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <td class="px-6 py-4 text-slate-500 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-slate-900 dark:text-slate-100">{{ $category->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-sm max-w-[300px] truncate">
                            {{ Str::limit($category->description, 60) ?: '—' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $category->products_count > 0 ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'bg-slate-100 dark:bg-slate-800 text-slate-500' }}">
                                {{ $category->products_count }} sản phẩm
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" 
                                    onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description) }}')" 
                                    class="p-2 text-slate-400 hover:text-primary transition-colors" title="Sửa">
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục \'{{ $category->name }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors" title="Xóa">
                                        <i class="fa-solid fa-trash-can text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-slate-400">
                                <i class="fa-solid fa-folder-open text-4xl"></i>
                                <p class="font-medium">Chưa có danh mục nào.</p>
                                <button type="button" onclick="openAddModal()" class="text-primary hover:underline text-sm font-semibold">
                                    <i class="fa-solid fa-plus mr-1"></i>Thêm danh mục đầu tiên
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openAddModal() {
        const modal = document.getElementById('addModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            document.getElementById('name').focus();
        }, 100);
    }

    function closeAddModal() {
        const modal = document.getElementById('addModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openEditModal(id, name, description) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const nameInput = document.getElementById('edit_name');
        const descInput = document.getElementById('edit_description');
        
        // Cập nhật đường dẫn action cho form
        form.action = `/admin/categories/${id}`;
        
        // Đổ dữ liệu vào input
        nameInput.value = name;
        descInput.value = description || '';
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            nameInput.focus();
        }, 100);
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Đóng modal khi nhấn phím Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });
</script>
@endpush
