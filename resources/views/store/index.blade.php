@extends('layouts.app')

@php
    $activeCategory = null;
    if (request()->has('categories') && is_array(request('categories')) && count(request('categories')) === 1) {
        $activeCategoryId = request('categories')[0];
        $activeCategory = $categories->firstWhere('id', $activeCategoryId);
    }
@endphp

@section('title', $activeCategory ? $activeCategory->name : 'Cửa hàng')

@section('content')
<main class="max-w-[1600px] mx-auto w-full px-4 md:px-0 py-8">
<!-- Breadcrumbs & Title -->
<div class="mb-8">
<nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
    <a class="hover:text-primary" href="{{ route('home') }}">Trang chủ</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    @if($activeCategory)
        <a class="hover:text-primary" href="{{ route('store.index') }}">Cửa hàng</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-slate-900 dark:text-slate-200 font-medium">{{ $activeCategory->name }}</span>
    @else
        <span class="text-slate-900 dark:text-slate-200 font-medium">Cửa hàng</span>
    @endif
</nav>
<h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $activeCategory ? $activeCategory->name : 'Danh mục sản phẩm' }}</h1>
<p class="text-slate-500 dark:text-slate-400 mt-2">Khám phá vũ trụ linh kiện và phụ kiện xây dựng không gian Gaming.</p>
</div>

<div class="flex flex-row gap-[12px] items-start">
<!-- Sidebar Filters: 260px -->
<aside class="w-[260px] shrink-0">
<form action="{{ route('store.index') }}" method="GET" id="filterForm">
    <!-- Preserve search term if it exists -->
    @if(request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif
    <!-- Preserve active categories -->
    @if(request('categories'))
        @foreach(request('categories') as $catId)
            <input type="hidden" name="categories[]" value="{{ $catId }}">
        @endforeach
    @endif
    <!-- Hidden inputs for price range -->
    <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price') }}">
    <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price') }}">
    <!-- Sort preservation -->
    <input type="hidden" name="sort" value="{{ request('sort', 'latest') }}">

    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        <!-- Title Header -->
        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 border-b border-slate-200 dark:border-slate-800 text-center">
            <h3 class="font-black text-slate-900 dark:text-white text-sm uppercase tracking-widest">Lọc sản phẩm</h3>
        </div>

        <div class="p-5 space-y-8">
            <!-- Categories section -->
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-4 text-sm">Gaming Gear</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('store.index') }}" 
                           class="flex items-center gap-2 text-[13px] {{ !request('categories') ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-primary' }} transition-colors">
                            <span class="text-[10px] opacity-40">»</span>
                            Tất cả sản phẩm
                        </a>
                    </li>
                    @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('store.index', ['categories' => [$cat->id]]) }}" 
                           class="flex items-center gap-2 text-[13px] {{ in_array($cat->id, request('categories', [])) ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-primary' }} transition-colors">
                            <span class="text-[10px] opacity-40">»</span>
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Price range section -->
            <div class="border-t border-slate-100 dark:border-slate-800 pt-6">
                <h4 class="font-bold text-slate-900 dark:text-white mb-4 text-sm uppercase tracking-tight">Khoảng giá</h4>
                <div class="space-y-3">
                    @php
                        $priceRanges = [
                            ['label' => 'Dưới 500 ngàn', 'min' => 0, 'max' => 500000, 'key' => '0-500000'],
                            ['label' => '500 ngàn - 1 triệu', 'min' => 500000, 'max' => 1000000, 'key' => '500000-1000000'],
                            ['label' => '1 triệu - 2 triệu', 'min' => 1000000, 'max' => 2000000, 'key' => '1000000-2000000'],
                            ['label' => '2 triệu - 3 triệu', 'min' => 2000000, 'max' => 3000000, 'key' => '2000000-3000000'],
                            ['label' => '3 triệu - 5 triệu', 'min' => 3000000, 'max' => 5000000, 'key' => '3000000-5000000'],
                            ['label' => '5 triệu - 10 triệu', 'min' => 5000000, 'max' => 10000000, 'key' => '5000000-10000000'],
                            ['label' => 'Trên 10 triệu', 'min' => 10000000, 'max' => '', 'key' => '10000000-up'],
                        ];
                    @endphp
                    @foreach($priceRanges as $range)
                    @php $count = $priceRangeCounts[$range['key']] ?? 0; @endphp
                    <label class="flex items-center gap-3 cursor-pointer group {{ $count == 0 ? 'opacity-40' : '' }}">
                        <input type="checkbox" name="price_choice" 
                               onclick="setPriceRange(this, '{{ $range['min'] }}', '{{ $range['max'] }}')"
                               {{ (request('min_price') === (string)$range['min'] && request('max_price') === (string)$range['max']) ? 'checked' : '' }}
                               {{ $count == 0 ? 'disabled' : '' }}
                               class="w-4 h-4 border-slate-300 dark:border-slate-700 text-primary focus:ring-primary rounded-sm transition-all shadow-sm cursor-pointer"/>
                        <span class="text-[13px] text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors">
                            {{ $range['label'] }}
                            <span class="text-[11px] opacity-40 ml-1">({{ $count }})</span>
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Brands section -->
            <div class="border-t border-slate-100 dark:border-slate-800 pt-6">
                <h4 class="font-bold text-slate-900 dark:text-white mb-4 text-sm uppercase tracking-tight">Thương hiệu</h4>
                <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($brands as $brand)
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input name="brands[]" value="{{ $brand->id }}" onchange="this.form.submit()" 
                               {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }} 
                               class="w-4 h-4 border-slate-300 dark:border-slate-700 text-primary focus:ring-primary rounded-sm transition-all shadow-sm" type="checkbox"/>
                        <span class="text-[13px] text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors">
                            {{ $brand->name }}
                            <span class="text-[11px] opacity-40 ml-1">({{ $brand->products_count }})</span>
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Clear filters -->
            <div class="pt-4">
                <a href="{{ route('store.index') }}" class="block w-full text-center py-2 bg-slate-100 dark:bg-slate-800 hover:bg-primary hover:text-white transition-all text-xs font-bold rounded-lg text-slate-500 shadow-sm hover:shadow-primary/20">
                    Xóa tất cả bộ lọc
                </a>
            </div>
        </div>
    </div>
</form>
</aside>

<script>
    function setPriceRange(element, min, max) {
        const minField = document.getElementById('min_price');
        const maxField = document.getElementById('max_price');

        if (!element.checked) {
            // If unchecked, clear values
            minField.value = '';
            maxField.value = '';
        } else {
            // Uncheck all other price checkboxes
            document.querySelectorAll('input[name="price_choice"]').forEach(cb => {
                if (cb !== element) cb.checked = false;
            });
            minField.value = min;
            maxField.value = max;
        }
        
        document.getElementById('filterForm').submit();
    }
</script>

<!-- Product Display Area: 1328px (incl border) -->
<div class="w-[1328px] border border-slate-300 dark:border-slate-700 p-[12px] bg-white dark:bg-slate-900 rounded-xl flex flex-col">
    <!-- Sort & Controls -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <p class="text-slate-500 dark:text-slate-400 text-sm">Hiển thị từ <span class="font-bold text-slate-900 dark:text-white">{{ $products->firstItem() ?? 0 }}</span> đến <span class="font-bold text-slate-900 dark:text-white">{{ $products->lastItem() ?? 0 }}</span> trong tổng số <span class="font-bold text-slate-900 dark:text-white">{{ $products->total() }}</span> sản phẩm</p>
    <div class="flex items-center gap-3">
    <span class="text-sm text-slate-500">Sắp xếp theo:</span>
    <form action="{{ route('store.index') }}" method="GET" id="sortForm">
        <!-- Repopulate current filters silently for sort -->
        @foreach(request()->except(['sort', 'page']) as $k => $v)
            @if(is_array($v))
                @foreach($v as $val)
                    <input type="hidden" name="{{ $k }}[]" value="{{ $val }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endif
        @endforeach
        <select name="sort" onchange="document.getElementById('sortForm').submit()" class="bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-700 rounded-lg text-sm pl-3 pr-10 py-2 focus:ring-primary focus:border-primary">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
        </select>
    </form>
    </div>
    </div>

    <div class="grid grid-cols-5 gap-[12px] justify-items-center">
        @forelse($products as $index => $product)
            <!-- Product Card (Same as before) -->
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-300 dark:border-slate-700 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col w-[250px] h-[400px] relative product-card">
                <!-- ... existing product card code ... -->
                <!-- Copying the full card content to ensure it's not lost -->
                <!-- Product Preview Popover -->
                <div class="product-popover fixed left-0 top-0 w-[350px] bg-white dark:bg-slate-900 rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-slate-200 dark:border-slate-700 z-[9999] hidden flex-col overflow-hidden pointer-events-none transition-opacity duration-200 opacity-0">
                    <div class="bg-primary p-3">
                        <h4 class="text-white font-bold text-sm leading-tight uppercase line-clamp-2">{{ $product->name }}</h4>
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-900 dark:text-slate-100 text-sm">Giá bán:</span>
                            <span class="text-primary font-black text-lg">{{ number_format($product->sale_price ?: $product->price, 0, ',', '.') }} VNĐ</span>
                        </div>
                        @if($product->warranty_period)
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-900 dark:text-slate-100 text-sm">Bảo hành:</span>
                            <span class="text-slate-600 dark:text-slate-400 text-sm font-medium">{{ $product->warranty_period }}</span>
                        </div>
                        @endif
                        @php
                            $filteredSpecs = [];
                            if($product->specs && is_array($product->specs)) {
                                $filteredSpecs = array_filter(array_slice($product->specs, 0, 6), function($spec) {
                                    if (is_array($spec)) {
                                        return !empty(array_filter($spec));
                                    }
                                    return !empty(trim($spec));
                                });
                            }
                        @endphp
                        @if(count($filteredSpecs) > 0)
                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                            <span class="inline-block bg-primary text-white px-2 py-0.5 rounded text-[10px] font-black mb-3 uppercase tracking-wider">Mô tả tóm tắt:</span>
                            <ul class="space-y-2">
                                @foreach($filteredSpecs as $spec)
                                    <li class="flex items-start gap-2 text-[12px] leading-tight text-slate-700 dark:text-slate-300">
                                        <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 shrink-0"></i>
                                        <span>
                                            @if(is_array($spec))
                                                @php
                                                    $specParts = array_filter($spec);
                                                @endphp
                                                {{ implode(': ', $specParts) }}
                                            @else
                                                {{ $spec }}
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Image Area -->
                <div class="h-[240px] bg-white relative overflow-hidden shrink-0 rounded-t-xl product-trigger">
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-full">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700 p-6" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x300?text=No+Image' }}"/>
                    </a>
                </div>

                <!-- Info Area -->
                <div class="p-4 flex flex-col gap-[6px] border-t border-slate-50 dark:border-slate-800 flex-grow">
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-[40px] max-h-[40px]">
                        <h3 class="text-slate-900 dark:text-white font-bold text-[16px] leading-[20px] group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $product->name }}</h3>
                    </a>
                    <div class="flex items-center justify-between h-[46px] max-h-[46px]">
                        <div class="flex flex-col justify-center h-full">
                            @if($product->sale_price)
                                <span class="text-primary !font-bold text-[18px] leading-[24px]">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                                <span class="text-[12px] text-slate-400 font-bold line-through leading-[18px]">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                            @else
                                <span class="text-primary !font-bold text-[18px] leading-[24px]">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                            @endif
                        </div>
                        @if($product->sale_price)
                            <div class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded shadow-sm whitespace-nowrap shrink-0">
                                -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center justify-between h-[26px] max-h-[26px]">
                        <button type="button" onclick="handleAddToCart({{ $product->id }}, {{ json_encode($product->colors) }}, '{{ addslashes($product->name) }}', {{ $product->sale_price ?: $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}')" class="relative flex items-center h-[26px] rounded-full overflow-hidden group/btn pr-3 pl-0 transition-all bg-slate-100 dark:bg-slate-700/50 hover:shadow-md">
                            <div class="absolute left-0 top-0 w-[26px] h-[26px] bg-primary rounded-full transition-all duration-300 ease-in-out group-hover/btn:w-full z-0"></div>
                            <div class="relative z-10 flex items-center gap-1.5 h-full">
                                <div class="w-[26px] h-[26px] flex items-center justify-center text-white shrink-0">
                                    <i class="fa-solid fa-cart-shopping text-[12px]"></i>
                                </div>
                                <span class="!font-bold text-[12px] uppercase tracking-wider text-slate-800 dark:text-slate-200 transition-colors duration-300 group-hover/btn:text-white">Thêm vào giỏ</span>
                            </div>
                        </button>
                        <div class="bg-emerald-50 text-emerald-500 border border-emerald-200 text-[10px] font-bold px-2 h-[22px] flex items-center rounded whitespace-nowrap shrink-0 ml-1">Còn hàng</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white dark:bg-slate-900 p-12 text-center rounded-xl border border-slate-300 dark:border-slate-700">
                <i class="fa-solid fa-magnifying-glass text-6xl text-slate-300 mb-4 opacity-30"></i>
                <h3 class="font-bold text-xl mb-2 text-slate-900 dark:text-white">Không tìm thấy sản phẩm!</h3>
                <p class="text-slate-500">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm của bạn.</p>
                <a href="{{ route('store.index') }}" class="mt-6 inline-block bg-primary text-white font-medium px-6 py-2 rounded-lg hover:bg-primary/90">Xóa tất cả bộ lọc</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination Section -->
    @if($products->hasPages())
    <div class="mt-12 flex justify-center pagination-container">
        {{ $products->appends(request()->query())->links('pagination::tailwind') }}
    </div>
    @endif
</div>

<style>
    /* Custom Square Pagination Styling */
    .pagination-container nav {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        width: 100% !important;
        background: transparent !important;
    }
    /* Hide the "Showing X to Y of Z results" part completely */
    .pagination-container nav p,
    .pagination-container nav > div:first-child,
    .pagination-container nav > div:last-child > div:first-child {
        display: none !important;
    }
    /* Layout Container for Buttons */
    .pagination-container nav > div:last-child > div:last-child,
    .pagination-container .relative.z-0 {
        display: flex !important;
        gap: 8px !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }
    /* Base Button Style (Links, Disabled, and Current Page wrappers) */
    .pagination-container a, 
    .pagination-container span[aria-disabled="true"] > span,
    .pagination-container span[aria-current="page"] > span,
    .pagination-container span.relative.inline-flex {
        border-radius: 8px !important;
        width: 40px !important;
        height: 40px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        font-weight: 600 !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 1px solid #e2e8f0 !important;
        background: white !important;
        color: #64748b !important;
        box-shadow: none !important;
        text-decoration: none !important;
    }
    /* Active Page Style */
    .pagination-container span[aria-current="page"] > span {
        background-color: #2badee !important;
        color: white !important;
        border-color: #2badee !important;
        font-weight: 800 !important;
        box-shadow: 0 4px 12px rgba(43, 173, 238, 0.4) !important;
    }
    /* Dark Mode */
    .dark .pagination-container a, 
    .dark .pagination-container span[aria-disabled="true"] > span,
    .dark .pagination-container span[aria-current="page"] > span,
    .dark .pagination-container span.relative.inline-flex {
        border-color: #334155 !important;
        background-color: #1e293b !important;
        color: #94a3b8 !important;
    }
    /* Hover State */
    .pagination-container a:hover {
        border-color: #2badee !important;
        color: #2badee !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1) !important;
    }
    /* Arrows Icon Size */
    .pagination-container svg {
        width: 18px !important;
        height: 18px !important;
    }
</style>

</div>
</div>
</main>
@endsection
