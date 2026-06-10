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
<main class="max-w-[1600px] mx-auto w-full px-2 sm:px-6 lg:px-8 py-4 sm:py-8">
<!-- Breadcrumbs & Title -->
<div class="mb-4 sm:mb-8">
<nav class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs sm:text-sm text-slate-500 mb-2 sm:mb-4">
    <a class="hover:text-primary whitespace-nowrap" href="{{ route('home') }}">Trang chủ</a>
    <i class="fa-solid fa-chevron-right text-[10px] shrink-0"></i>
    @if($activeCategory)
        <a class="hover:text-primary whitespace-nowrap" href="{{ route('store.index') }}">Cửa hàng</a>
        <i class="fa-solid fa-chevron-right text-[10px] shrink-0"></i>
        <span class="text-slate-900 dark:text-slate-200 font-medium">{{ $activeCategory->name }}</span>
    @else
        <span class="text-slate-900 dark:text-slate-200 font-medium">Cửa hàng</span>
    @endif
</nav>
<h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $activeCategory ? $activeCategory->name : 'Danh mục sản phẩm' }}</h1>
<p class="text-slate-500 dark:text-slate-400 mt-2">Khám phá vũ trụ linh kiện và phụ kiện xây dựng không gian Gaming.</p>
</div>

<div class="flex flex-col lg:flex-row gap-3 items-start w-full">
<!-- Sidebar Filters: 280px on large screens, full-width on mobile -->
<aside class="w-full lg:w-[280px] shrink-0">
<form action="{{ request('is_seo_category') ? route('store.category', request('category_slug')) : route('store.index') }}" method="GET" id="filterForm">
    <!-- Preserve search term if it exists -->
    @if(request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif
    <!-- Preserve active categories -->
    @if(request('categories') && !request('is_seo_category'))
        @foreach(request('categories') as $catId)
            <input type="hidden" name="categories[]" value="{{ $catId }}">
        @endforeach
    @endif
    <!-- Hidden inputs for price range -->
    <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price') }}">
    <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price') }}">
    <!-- Sort preservation -->
    <input type="hidden" name="sort" id="sort_input" value="{{ request('sort', 'latest') }}">

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

    <!-- Mobile Filter Bar (Only visible on mobile, compact horizontal row matching image 2 style) -->
    <div class="lg:hidden flex flex-wrap gap-2 mb-4 w-full relative">
        <!-- Price Filter Button -->
        <div class="relative mobile-filter-dropdown-container">
            <button type="button" onclick="toggleMobileFilter(this, 'mobile-price-panel')" class="flex items-center gap-1.5 px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded text-xs font-black text-slate-800 dark:text-slate-200 focus:outline-none hover:bg-slate-50 transition-colors">
                <span>Giá</span>
                <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200"></i>
            </button>
            <div id="mobile-price-panel" class="hidden absolute left-0 mt-1.5 w-60 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl p-4 space-y-3 z-[9999]">
                @foreach($priceRanges as $range)
                @php $count = $priceRangeCounts[$range['key']] ?? 0; @endphp
                <label class="flex items-center gap-3 cursor-pointer group {{ $count == 0 ? 'opacity-40' : '' }}">
                    <input type="checkbox" name="price_choice_mobile" 
                           onclick="setMobilePriceRange(this, '{{ $range['min'] }}', '{{ $range['max'] }}')"
                           {{ (request('min_price') === (string)$range['min'] && request('max_price') === (string)$range['max']) ? 'checked' : '' }}
                           {{ $count == 0 ? 'disabled' : '' }}
                           class="w-4 h-4 border-slate-300 dark:border-slate-700 text-primary focus:ring-primary rounded-sm transition-all"/>
                    <span class="text-xs text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors">
                        {{ $range['label'] }}
                        <span class="text-[10px] opacity-40 ml-1">({{ $count }})</span>
                    </span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Brands Filter Button -->
        <div class="relative mobile-filter-dropdown-container">
            <button type="button" onclick="toggleMobileFilter(this, 'mobile-brand-panel')" class="flex items-center gap-1.5 px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded text-xs font-black text-slate-800 dark:text-slate-200 focus:outline-none hover:bg-slate-50 transition-colors">
                <span>Thương hiệu</span>
                <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200"></i>
            </button>
            <div id="mobile-brand-panel" class="hidden absolute left-0 mt-1.5 w-56 max-h-64 overflow-y-auto overscroll-contain touch-pan-y bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl p-4 space-y-3 z-[9999]" style="-webkit-overflow-scrolling: touch; touch-action: pan-y;">
                @foreach($brands as $brand)
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input name="brands[]" value="{{ $brand->id }}" onchange="document.getElementById('filterForm').submit()" 
                           {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }} 
                           class="w-4 h-4 border-slate-300 dark:border-slate-700 text-primary focus:ring-primary rounded-sm transition-all" type="checkbox"/>
                    <span class="text-xs text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors">
                        {{ $brand->name }}
                        <span class="text-[10px] opacity-40 ml-1">({{ $brand->products_count }})</span>
                    </span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Sort Filter Button -->
        <div class="relative mobile-filter-dropdown-container">
            <button type="button" onclick="toggleMobileFilter(this, 'mobile-sort-panel')" class="flex items-center gap-1.5 px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded text-xs font-black text-slate-800 dark:text-slate-200 focus:outline-none hover:bg-slate-50 transition-colors">
                <span>Sắp xếp</span>
                <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200"></i>
            </button>
            <div id="mobile-sort-panel" class="hidden absolute left-0 mt-1.5 w-48 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl p-2 z-[9999]">
                <button type="button" onclick="setMobileSort('latest')" class="w-full text-left px-3 py-2 rounded-lg text-xs {{ request('sort') == 'latest' || !request('sort') ? 'bg-primary/10 text-primary font-bold' : 'text-slate-600 dark:text-slate-400' }} hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">Mới nhất</button>
                <button type="button" onclick="setMobileSort('price_asc')" class="w-full text-left px-3 py-2 rounded-lg text-xs {{ request('sort') == 'price_asc' ? 'bg-primary/10 text-primary font-bold' : 'text-slate-600 dark:text-slate-400' }} hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">Giá: Thấp đến Cao</button>
                <button type="button" onclick="setMobileSort('price_desc')" class="w-full text-left px-3 py-2 rounded-lg text-xs {{ request('sort') == 'price_desc' ? 'bg-primary/10 text-primary font-bold' : 'text-slate-600 dark:text-slate-400' }} hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">Giá: Cao đến Thấp</button>
            </div>
        </div>

        <!-- Clear Filters (Optional Mobile reset button) -->
        @if(request('min_price') || request('max_price') || request('brands') || request('sort'))
        <a href="{{ request('is_seo_category') ? route('store.category', request('category_slug')) : route('store.index') }}" class="flex items-center gap-1.5 px-3 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-red-500 hover:text-white rounded text-xs font-bold text-slate-500 transition-colors">
            Xóa lọc
        </a>
        @endif
    </div>

    <!-- Desktop Sidebar (Hidden on mobile viewports) -->
    <div class="hidden lg:block bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
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
                        <a href="{{ route('store.category', $cat->slug) }}" 
                           class="flex items-center gap-2 text-[13px] {{ (request('is_seo_category') && request('category_slug') == $cat->slug) || in_array($cat->id, request('categories', [])) ? 'text-primary font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-primary' }} transition-colors">
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
    function toggleMobileFilter(button, panelId) {
        const panel = document.getElementById(panelId);
        const isOpen = !panel.classList.contains('hidden');
        
        // Close all other panels
        document.querySelectorAll('[id^="mobile-"][id$="-panel"]').forEach(p => {
            if (p.id !== panelId) {
                p.classList.add('hidden');
                const btn = p.previousElementSibling;
                if (btn) {
                    const icon = btn.querySelector('i');
                    if (icon) icon.classList.remove('rotate-180');
                }
            }
        });
        
        if (isOpen) {
            panel.classList.add('hidden');
            const icon = button.querySelector('i');
            if (icon) icon.classList.remove('rotate-180');
        } else {
            panel.classList.remove('hidden');
            const icon = button.querySelector('i');
            if (icon) icon.classList.add('rotate-180');
        }
    }

    function setMobilePriceRange(element, min, max) {
        const minField = document.getElementById('min_price');
        const maxField = document.getElementById('max_price');
        if (!element.checked) {
            minField.value = '';
            maxField.value = '';
        } else {
            document.querySelectorAll('input[name="price_choice_mobile"]').forEach(cb => {
                if (cb !== element) cb.checked = false;
            });
            minField.value = min;
            maxField.value = max;
        }
        document.getElementById('filterForm').submit();
    }

    function setMobileSort(value) {
        document.getElementById('sort_input').value = value;
        document.getElementById('filterForm').submit();
    }

    // Close dropdowns on clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.mobile-filter-dropdown-container')) {
            document.querySelectorAll('[id^="mobile-"][id$="-panel"]').forEach(p => {
                p.classList.add('hidden');
                const btn = p.previousElementSibling;
                if (btn) {
                    const icon = btn.querySelector('i');
                    if (icon) icon.classList.remove('rotate-180');
                }
            });
        }
    });

    // Prevent mobile touch scrolling from propagating to background body
    document.querySelectorAll('#mobile-brand-panel, #mobile-price-panel, #mobile-sort-panel').forEach(panel => {
        const preventBubble = (e) => {
            e.stopPropagation();
        };
        panel.addEventListener('touchstart', preventBubble, { passive: true });
        panel.addEventListener('touchmove', preventBubble, { passive: true });
    });

    function setPriceRange(element, min, max) {
        const minField = document.getElementById('min_price');
        const maxField = document.getElementById('max_price');

        if (!element.checked) {
            minField.value = '';
            maxField.value = '';
        } else {
            document.querySelectorAll('input[name="price_choice"]').forEach(cb => {
                if (cb !== element) cb.checked = false;
            });
            minField.value = min;
            maxField.value = max;
        }
        
        document.getElementById('filterForm').submit();
    }
</script>

<!-- Product Display Area: Responsive flex container -->
<div class="flex-1 w-full border-0 sm:border border-transparent sm:border-slate-200 sm:dark:border-slate-800/80 p-0 sm:p-[12px] bg-transparent sm:bg-white sm:dark:bg-slate-900 rounded-none sm:rounded-xl flex flex-col">
    <!-- Sort & Controls -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <p class="text-slate-500 dark:text-slate-400 text-sm">Hiển thị từ <span class="font-bold text-slate-900 dark:text-white">{{ $products->firstItem() ?? 0 }}</span> đến <span class="font-bold text-slate-900 dark:text-white">{{ $products->lastItem() ?? 0 }}</span> trong tổng số <span class="font-bold text-slate-900 dark:text-white">{{ $products->total() }}</span> sản phẩm</p>
    <div class="hidden lg:flex items-center gap-3">
    <span class="text-sm text-slate-500">Sắp xếp theo:</span>
    <form action="{{ request('is_seo_category') ? route('store.category', request('category_slug')) : route('store.index') }}" method="GET" id="sortForm">
        <!-- Repopulate current filters silently for sort -->
        @php
            $exceptParams = ['sort', 'page', 'is_seo_category', 'category_slug'];
            if(request('is_seo_category')) {
                $exceptParams[] = 'categories';
            }
        @endphp
        @foreach(request()->except($exceptParams) as $k => $v)
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

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-2 sm:gap-3 justify-items-center w-full">
        @forelse($products as $index => $product)
            <!-- Product Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-800 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col w-full max-w-[250px] h-[290px] sm:h-[350px] md:h-[400px] relative product-card reveal-on-scroll">
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
                <div class="h-[140px] sm:h-[180px] md:h-[240px] bg-white relative overflow-hidden shrink-0 rounded-t-xl product-trigger">
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-full">
                        <img loading="lazy" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700 p-6" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x300?text=No+Image' }}"/>
                    </a>
                </div>

                <!-- Info Area -->
                <div class="product-card-body border-t border-slate-50 dark:border-slate-800">
                    <!-- Stock Badge (Relocated to top) -->
                    <div class="mb-1 lg:hidden">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400">
                            Còn hàng
                        </span>
                    </div>

                    <!-- Block 1: Name (max 40px) -->
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block product-card-title">
                        <h3 class="text-slate-900 dark:text-white font-bold group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $product->name }}</h3>
                    </a>
                    
                    <!-- Block 2: Price (max 46px) -->
                    <div class="product-card-price-row">
                        <div class="flex flex-col justify-center h-full">
                            @if($product->sale_price)
                                <span class="text-primary !font-bold product-card-sale-price">{{ number_format($product->sale_price, 0, ',', '.') }}<span class="lg:hidden"><u>đ</u></span><span class="hidden lg:inline"> VNĐ</span></span>
                                <span class="product-card-original-price text-slate-400 font-bold">{{ number_format($product->price, 0, ',', '.') }}<span class="lg:hidden"><u>đ</u></span><span class="hidden lg:inline"> VNĐ</span></span>
                            @else
                                <span class="text-primary !font-bold product-card-sale-price">{{ number_format($product->price, 0, ',', '.') }}<span class="lg:hidden"><u>đ</u></span><span class="hidden lg:inline"> VNĐ</span></span>
                            @endif
                        </div>
                        @if($product->sale_price)
                            <div class="bg-red-500 text-white product-card-discount-badge whitespace-nowrap shrink-0">
                                -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                            </div>
                        @endif
                    </div>

                    <!-- Block 3: Action -->
                    <div class="product-card-action-row justify-start lg:justify-between">
                        <button type="button" onclick="handleAddToCart({{ $product->id }}, {{ json_encode($product->colors) }}, '{{ addslashes($product->name) }}', {{ $product->sale_price ?: $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}')" class="product-card-btn dark:bg-slate-700/50 hover:shadow-md">
                            <div class="absolute left-0 top-0 w-[1.85em] h-[1.85em] bg-primary rounded-full transition-all duration-300 ease-in-out z-0"></div>
                            <div class="relative z-10 flex items-center gap-[0.28em] h-full">
                                <div class="product-card-btn-icon-wrapper text-white">
                                    <i class="fa-solid fa-cart-shopping text-[0.857em]"></i>
                                </div>
                                <span class="product-card-btn-text text-slate-800 dark:text-slate-200 transition-colors duration-300">Thêm vào giỏ</span>
                            </div>
                        </button>
                        <div class="product-card-stock-badge hidden lg:inline-flex bg-emerald-50 text-emerald-500 border border-emerald-200 dark:bg-emerald-950/20 dark:border-emerald-800">
                            Còn hàng
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white dark:bg-slate-900 p-12 text-center rounded-xl border border-slate-200 dark:border-slate-800">
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
    /* Force page number container to show on mobile */
    .pagination-container nav > div:last-child {
        display: flex !important;
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
