@extends('layouts.app')

@section('title', 'HOT SALE')

@section('content')
<main class="max-w-[1600px] mx-auto w-full px-4 md:px-0 py-8">
    <!-- Breadcrumbs & Title -->
    <div class="mb-8">
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
            <a class="hover:text-primary" href="{{ route('home') }}">Trang chủ</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-red-500 font-bold uppercase tracking-wider">HOT SALE</span>
        </nav>
    </div>

    <!-- Results Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 rounded-xl shadow-sm">
        <div class="flex items-center gap-3">
            <h1 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">HOT SALE</h1>
            <div class="h-6 w-[1px] bg-slate-300 dark:bg-slate-700"></div>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Tìm thấy <span class="font-black text-red-500">{{ $totalProducts }}</span> sản phẩm</p>
        </div>
        
        <div class="flex items-center gap-3">
            <span class="text-sm text-slate-500 font-medium">Sắp xếp theo:</span>
            <form action="{{ route('hot-sale') }}" method="GET" id="sortForm">
                <select name="sort" onchange="document.getElementById('sortForm').submit()" class="bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg text-sm pl-3 pr-10 py-2 focus:ring-red-500 focus:border-red-500 font-bold text-slate-700 dark:text-slate-200 cursor-pointer outline-none">
                    <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
                    <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-[12px]">
        @forelse($products as $product)
            <!-- Standard Product Card (Synchronized with Store) -->
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-300 dark:border-slate-700 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col w-[250px] h-[400px] relative product-card">
                
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
            <div class="col-span-full bg-white dark:bg-slate-900 p-20 text-center rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                <i class="fa-solid fa-fire text-6xl text-slate-200 mb-6 opacity-30"></i>
                <h3 class="font-black text-2xl mb-2 text-slate-900 dark:text-white uppercase tracking-tight">Hiện không có sản phẩm Hot Sale nào!</h3>
                <p class="text-slate-500">Vui lòng quay lại sau để săn những ưu đãi cực lớn.</p>
                <a href="{{ route('home') }}" class="mt-8 inline-block bg-red-500 text-white font-black px-8 py-3 rounded-xl hover:bg-red-600 transition-all shadow-lg shadow-red-500/20 uppercase tracking-widest text-xs">Về trang chủ</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-12 flex justify-center pagination-container">
        {{ $products->appends(request()->query())->links('pagination::tailwind') }}
    </div>
    @endif
</main>

<style>
    /* Synchronized Pagination Styling from store/index.blade.php */
    .pagination-container nav {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        width: 100% !important;
        background: transparent !important;
    }
    .pagination-container nav p,
    .pagination-container nav > div:first-child,
    .pagination-container nav > div:last-child > div:first-child {
        display: none !important;
    }
    .pagination-container nav > div:last-child > div:last-child,
    .pagination-container .relative.z-0 {
        display: flex !important;
        gap: 8px !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }
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
    .pagination-container span[aria-current="page"] > span {
        background-color: #2badee !important;
        color: white !important;
        border-color: #2badee !important;
        font-weight: 800 !important;
        box-shadow: 0 4px 12px rgba(43, 173, 238, 0.4) !important;
    }
    .dark .pagination-container a, 
    .dark .pagination-container span[aria-disabled="true"] > span,
    .dark .pagination-container span[aria-current="page"] > span,
    .dark .pagination-container span.relative.inline-flex {
        border-color: #334155 !important;
        background-color: #1e293b !important;
        color: #94a3b8 !important;
    }
    .pagination-container a:hover {
        border-color: #2badee !important;
        color: #2badee !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
