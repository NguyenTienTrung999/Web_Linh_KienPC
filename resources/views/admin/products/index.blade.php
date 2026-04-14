@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm - TechFlow Admin')

@section('content')
<!-- Title & Action -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-3xl font-bold tracking-tight">Danh sách sản phẩm</h2>
        <p class="text-slate-500 mt-1">Quản lý kho hàng và thông tin sản phẩm của bạn.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="bg-primary text-white px-6 py-2.5 rounded-xl font-semibold flex items-center gap-2 hover:bg-primary/90 transition-shadow shadow-lg shadow-primary/20">
        <i class="fa-solid fa-plus text-sm"></i>
        Thêm sản phẩm
    </a>
</div>

<!-- Filters & Table Container -->
<div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
    <!-- Filters Bar -->
    <div class="p-4 border-b border-slate-100 dark:border-slate-800 space-y-4">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-[300px] relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-primary focus:border-primary" placeholder="Tìm theo tên sản phẩm..." type="text"/>
            </div>
            
            <div class="w-48">
                <select name="category" class="w-full border border-slate-200 dark:border-slate-700 dark:bg-slate-800 rounded-xl py-2.5 focus:ring-primary focus:border-primary" onchange="this.form.submit()">
                    <option value="">Tất cả danh mục</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="flex items-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                <i class="fa-solid fa-magnifying-glass text-slate-500 text-sm"></i>
                <span>Tìm</span>
            </button>
        </form>

        <!-- Tabs -->
        <div class="flex border-b border-slate-100 dark:border-slate-800">
            <button class="px-6 py-3 text-sm font-semibold border-b-2 border-primary text-primary">Tất cả sản phẩm</button>
            <button class="px-6 py-3 text-sm font-medium text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 border-b-2 border-transparent">Đang kinh doanh</button>
            <button class="px-6 py-3 text-sm font-medium text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 border-b-2 border-transparent">Hết hàng</button>
            <button class="px-6 py-3 text-sm font-medium text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 border-b-2 border-transparent">Ngừng kinh doanh</button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                <tr>
                    <th class="px-6 py-4">Sản phẩm</th>
                    <th class="px-6 py-4">Danh mục</th>
                    <th class="px-6 py-4">Giá bán</th>
                    <th class="px-6 py-4">Tồn kho</th>
                    <th class="px-6 py-4">Trạng thái</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($products as $product)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-slate-100 dark:bg-slate-800 overflow-hidden shrink-0 border border-slate-100 dark:border-slate-700">
                                    <img class="w-full h-full object-cover" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/100x100?text=No+Image' }}" alt="{{ $product->name }}"/>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-slate-100">{{ $product->name }}</p>
                                    <p class="text-xs text-slate-500">ID: {{ $product->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded">
                                {{ $product->category ? $product->category->name : 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($product->sale_price)
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-900 dark:text-white">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                                    <span class="text-[10px] text-slate-400 line-through">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                </div>
                            @else
                                <span class="font-semibold text-slate-900 dark:text-slate-100">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm {{ $product->stock_quantity <= 0 ? 'text-red-500 font-medium' : '' }}">
                            {{ $product->stock_quantity }}
                        </td>
                        <td class="px-6 py-4">
                            @if($product->stock_quantity > 0)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Kinh doanh
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Hết hàng
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                        <i class="fa-solid fa-trash-can text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                            Không có sản phẩm nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(method_exists($products, 'links'))
        <div class="p-4 border-t border-slate-100 dark:border-slate-800">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
