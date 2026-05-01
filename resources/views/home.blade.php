@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<style>
    .blueprint-grid {
        background-image: radial-gradient(circle, #e2e8f0 1px, transparent 1px);
        background-size: 32px 32px;
    }
</style>

<!-- Hero Banner -->
<section class="relative h-[600px] flex items-center overflow-hidden">
    <div class="absolute inset-0 bg-slate-900">
        <img alt="Banner" class="w-full h-full object-cover opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAe6mCDytPoH82BvHYSmB8cts4eFfa4a8dCX9YRzjLf6hUvTVaKq8v9sM0cPJHyeb_ivV-GOmH0aY2RM9W02r8xHdubr8EGKJcz_t93i_r3AItZle0VheR3F23jD0qubCOjrf8jGsrrKbLmAZLrV6WQJvDEbAbbBbm2Ey3s7n_bZi3KtaWX83GCAvQMEVb5uQZ_u52x4rLa8R4D66jH6nHR3vieDajx_hlpMZTA7Jow1tpgETk5apykSbMg-1qgi760vyZluZ0DNfg"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
    </div>
    <div class="relative max-w-[1600px] mx-auto px-4 w-full">
        <div class="max-w-2xl">
            <h1 class="text-white text-5xl lg:text-7xl font-black uppercase tracking-tighter mb-6 leading-none animate-slide-up">
                Nâng Tầm Trải Nghiệm <br/> <span class="text-primary">Công Nghệ</span>
            </h1>
            <p class="text-slate-300 text-lg mb-8 max-w-lg mb-6 leading-relaxed animate-slide-up" style="animation-delay: 0.1s">
                Khám phá bộ sưu tập linh kiện và phụ kiện gaming được tuyển chọn kỹ lưỡng, mang đến hiệu suất tối ưu cho mọi tác vụ.
            </p>
            <div class="flex flex-wrap gap-4 animate-slide-up" style="animation-delay: 0.2s">
                <a href="{{ route('store.index') }}" class="bg-primary hover:bg-primary/90 text-white font-black uppercase text-xs tracking-widest py-4 px-8 rounded-lg transition-transform hover:scale-105 inline-block">
                    Mua Ngay
                </a>
                <a href="#featured" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/20 font-black uppercase text-xs tracking-widest py-4 px-8 rounded-lg transition-transform hover:scale-105 inline-block">
                    Tìm Hiểu Thêm
                </a>
            </div>
        </div>
    </div>
</section>



<!-- Deal Hot Every Day -->
@if($flashSales->count() > 0)
<section class="py-12 bg-gradient-to-b from-[#0c4a6e] via-[#2badee] to-white transition-all duration-700">
    <div class="max-w-[1600px] mx-auto border border-slate-300 dark:border-slate-700 rounded-2xl p-8 bg-white/40 dark:bg-slate-900/40 backdrop-blur-md shadow-sm mb-[22px] relative overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6 relative z-10">
            <div>
                <h2 class="slash-header text-3xl font-black uppercase tracking-tighter mb-2 text-slate-900 dark:text-white">Deal Hot Mỗi Ngày</h2>
                <p class="text-slate-600 dark:text-slate-300 font-medium">Săn linh kiện giá cực hời</p>
            </div>
            
            <div class="flex items-center gap-6">
                <!-- Navigation -->
                <div class="hidden md:flex gap-2">
                    <button onclick="document.getElementById('deal-hot-slider').scrollBy({left: -320, behavior: 'smooth'})" class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-all hover:shadow-lg">
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </button>
                    <button onclick="document.getElementById('deal-hot-slider').scrollBy({left: 320, behavior: 'smooth'})" class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-all hover:shadow-lg">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="deal-hot-slider" class="flex gap-[12px] overflow-x-auto snap-x snap-mandatory pb-4 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            @foreach($flashSales as $product)
            <div class="shrink-0 snap-start w-[calc((100%-60px)/6)] bg-white dark:bg-slate-800 rounded-xl border border-slate-300 dark:border-slate-700 overflow-hidden group hover:shadow-2xl transition-all duration-500 flex flex-col h-[400px]">
                <!-- Image Area: 240px -->
                <div class="h-[240px] bg-white relative overflow-hidden shrink-0">
                    <span class="absolute top-3 left-3 z-20 bg-red-500 text-white text-[11px] font-black px-2.5 py-1.5 rounded-lg shadow-lg animate-pulse">
                        -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                    </span>
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-full">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-700" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>

                    <!-- Hover-only Add to Cart -->
                    <button type="button" onclick="addToCart({{ $product->id }})" class="absolute bottom-4 left-4 right-4 bg-slate-900 text-white font-black text-[10px] py-3.5 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0 uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-primary z-20 shadow-xl">
                        <i class="fa-solid fa-cart-shopping text-xs"></i> Mua Ngay
                    </button>
                </div>

                <!-- Info Area -->
                <div class="p-4 flex flex-col gap-[6px] border-t border-slate-50 dark:border-slate-800 relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm flex-grow">
                    <!-- Block 1: Name (max 40px) -->
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-[40px] max-h-[40px]">
                        <h3 class="font-bold text-slate-900 dark:text-slate-100 text-[16px] leading-[20px] group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $product->name }}</h3>
                    </a>
                    
                    <!-- Block 2: Price (max 46px) -->
                    <div class="flex flex-col justify-center h-[46px] max-h-[46px]">
                        <span class="text-primary !font-bold text-[18px] leading-[24px]">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                        <span class="text-[12px] text-slate-400 font-bold line-through leading-[18px]">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                    </div>
                    
                    <!-- Block 3: Progress & Status (max 26px) -->
                    <div class="flex flex-col justify-center h-[26px] max-h-[26px] gap-1">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span class="text-[9px] text-slate-500 dark:text-slate-400 font-black uppercase tracking-wider">Đã bán {{ rand(15, 45) }}/50</span>
                                <span class="text-[9px] text-primary font-bold">Sắp hết</span>
                            </div>
                            <div class="bg-emerald-50 text-emerald-500 border border-emerald-200 text-[9px] font-bold px-1.5 h-[16px] flex items-center rounded whitespace-nowrap">
                                Còn hàng
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 dark:bg-slate-700 h-1.5 rounded-full overflow-hidden shrink-0">
                            <div class="bg-gradient-to-r from-primary to-blue-600 h-full rounded-full transition-all duration-1000" style="width: {{ rand(40, 90) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Featured Products -->
<section id="featured" class="pb-4 pt-16">
    <div class="max-w-[1600px] mx-auto border border-slate-300 dark:border-slate-700 rounded-2xl p-8 bg-white dark:bg-slate-900 shadow-sm mb-[22px]">
        <div class="flex items-center justify-between mb-8">
            <h2 class="slash-header text-2xl font-black uppercase tracking-tighter text-on-surface">Sản phẩm nổi bật</h2>
            <div class="flex gap-2">
                <button onclick="document.getElementById('featured-slider').scrollBy({left: -320, behavior: 'smooth'})" class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-colors hover:shadow-lg">
                    <i class="fa-solid fa-chevron-left text-sm"></i>
                </button>
                <button onclick="document.getElementById('featured-slider').scrollBy({left: 320, behavior: 'smooth'})" class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-colors hover:shadow-lg">
                    <i class="fa-solid fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>
        <div id="featured-slider" class="flex gap-[12px] overflow-x-auto snap-x snap-mandatory pb-4 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            @forelse($featuredProducts as $product)
            <div class="shrink-0 snap-start w-[calc((100%-60px)/6)] bg-white dark:bg-slate-800 rounded-xl border border-slate-300 dark:border-slate-700 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col h-[400px] relative product-card">
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
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-900 dark:text-slate-100 text-sm">Bảo hành:</span>
                            <span class="text-slate-600 dark:text-slate-400 text-sm font-medium">{{ $product->warranty_period }}</span>
                        </div>
                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                            <span class="inline-block bg-primary text-white px-2 py-0.5 rounded text-[10px] font-black mb-3 uppercase tracking-wider">Mô tả tóm tắt:</span>
                            <ul class="space-y-2">
                                @if($product->specs && is_array($product->specs))
                                    @foreach(array_slice($product->specs, 0, 6) as $spec)
                                        <li class="flex items-start gap-2 text-[12px] leading-tight text-slate-700 dark:text-slate-300">
                                            <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 shrink-0"></i>
                                            <span>
                                                @if(is_array($spec))
                                                    {{ implode(': ', $spec) }}
                                                @else
                                                    {{ $spec }}
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Image Area: 240px -->
                <div class="h-[240px] bg-white relative overflow-hidden shrink-0 rounded-t-xl product-trigger">
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-full">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-700" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>
                </div>
                <!-- Info Area -->
                <div class="p-4 flex flex-col gap-[6px] border-t border-slate-50 dark:border-slate-800 flex-grow">
                    <!-- Block 1: Name (max 40px) -->
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-[40px] max-h-[40px]">
                        <h3 class="font-bold text-slate-900 dark:text-slate-100 text-[16px] leading-[20px] group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $product->name }}</h3>
                    </a>
                    
                    <!-- Block 2: Price (max 46px) -->
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

                    <!-- Block 3: Action (max 26px) -->
                    <div class="flex items-center justify-between h-[26px] max-h-[26px]">
                        <button type="button" onclick="addToCart({{ $product->id }})" class="relative flex items-center h-[26px] rounded-full overflow-hidden group/btn pr-3 pl-0 transition-all bg-slate-100 dark:bg-slate-700/50 hover:shadow-md">
                            <div class="absolute left-0 top-0 w-[26px] h-[26px] bg-primary rounded-full transition-all duration-300 ease-in-out group-hover/btn:w-full z-0"></div>
                            <div class="relative z-10 flex items-center gap-1.5 h-full">
                                <div class="w-[26px] h-[26px] flex items-center justify-center text-white shrink-0">
                                    <i class="fa-solid fa-cart-shopping text-[12px]"></i>
                                </div>
                                <span class="!font-bold text-[12px] uppercase tracking-wider text-slate-800 dark:text-slate-200 transition-colors duration-300 group-hover/btn:text-white">Thêm vào giỏ</span>
                            </div>
                        </button>
                        <div class="bg-emerald-50 text-emerald-500 border border-emerald-200 text-[10px] font-bold px-2 h-[22px] flex items-center rounded whitespace-nowrap shrink-0 ml-1">
                            Còn hàng
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="w-full text-center text-slate-500 py-10 opacity-70">
                    <i class="fa-solid fa-boxes-stacked text-4xl mb-2 opacity-50"></i><br>
                    Chưa có sản phẩm nổi bật nào.<br>Vui lòng đánh dấu "Sản phẩm nổi bật" trong phần quản trị.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Dynamic Category Sections -->
@foreach($categoryProducts as $catData)
@php $catSection = $catData['category']; $catProducts = $catData['products']; @endphp
<section class="py-4">
    <div class="max-w-[1600px] mx-auto border border-slate-300 dark:border-slate-700 rounded-2xl p-8 bg-white dark:bg-slate-900 shadow-sm mb-[22px]">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <h2 class="slash-header text-2xl font-black uppercase tracking-tighter text-on-surface">{{ $catSection->name }}</h2>
            <div class="flex gap-4 mt-6 md:mt-0 overflow-x-auto pb-2">
                <a href="{{ route('store.index', ['categories' => [$catSection->id]]) }}" class="whitespace-nowrap border border-primary text-primary hover:bg-primary hover:text-white px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 group shadow-sm hover:shadow-primary/20">
                    Xem tất cả 
                    <i class="fa-solid fa-chevron-right text-[8px] transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
        
        <div class="flex gap-[12px] overflow-x-auto snap-x snap-mandatory pb-4 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            @foreach($catProducts as $product)
            <div class="shrink-0 snap-start w-[calc((100%-60px)/6)] bg-white dark:bg-slate-800 rounded-xl border border-slate-300 dark:border-slate-700 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col h-[400px] relative product-card">
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
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-900 dark:text-slate-100 text-sm">Bảo hành:</span>
                            <span class="text-slate-600 dark:text-slate-400 text-sm font-medium">{{ $product->warranty_period }}</span>
                        </div>
                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                            <span class="inline-block bg-primary text-white px-2 py-0.5 rounded text-[10px] font-black mb-3 uppercase tracking-wider">Mô tả tóm tắt:</span>
                            <ul class="space-y-2">
                                @if($product->specs && is_array($product->specs))
                                    @foreach(array_slice($product->specs, 0, 6) as $spec)
                                        <li class="flex items-start gap-2 text-[12px] leading-tight text-slate-700 dark:text-slate-300">
                                            <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 shrink-0"></i>
                                            <span>
                                                @if(is_array($spec))
                                                    {{ implode(': ', $spec) }}
                                                @else
                                                    {{ $spec }}
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="h-[240px] bg-white relative overflow-hidden shrink-0 rounded-t-xl product-trigger">
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-full">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-700" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>
                </div>
                <div class="p-4 flex flex-col gap-[6px] border-t border-slate-50 dark:border-slate-800 flex-grow">
                    <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-[40px] max-h-[40px]">
                        <h3 class="font-bold text-slate-900 dark:text-slate-100 text-[16px] leading-[20px] group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $product->name }}</h3>
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
                        <button type="button" onclick="addToCart({{ $product->id }})" class="relative flex items-center h-[26px] rounded-full overflow-hidden group/btn pr-3 pl-0 transition-all bg-slate-100 dark:bg-slate-700/50 hover:shadow-md">
                            <div class="absolute left-0 top-0 w-[26px] h-[26px] bg-primary rounded-full transition-all duration-300 ease-in-out group-hover/btn:w-full z-0"></div>
                            <div class="relative z-10 flex items-center gap-1.5 h-full">
                                <div class="w-[26px] h-[26px] flex items-center justify-center text-white shrink-0">
                                    <i class="fa-solid fa-cart-shopping text-[12px]"></i>
                                </div>
                                <span class="!font-bold text-[12px] uppercase tracking-wider text-slate-800 dark:text-slate-200 transition-colors duration-300 group-hover/btn:text-white">Thêm vào giỏ</span>
                            </div>
                        </button>
                        <div class="bg-emerald-50 text-emerald-500 border border-emerald-200 text-[10px] font-bold px-2 h-[22px] flex items-center rounded whitespace-nowrap shrink-0 ml-1">
                            Còn hàng
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endforeach


<!-- USP Section -->
<section class="py-12 bg-slate-50 dark:bg-slate-900 border-y border-outline-variant dark:border-slate-800">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-primary/10 text-primary flex items-center justify-center rounded-full shrink-0">
                    <i class="fa-solid fa-truck text-lg"></i>
                </div>
                <div>
                    <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-slate-100 leading-none mb-1">Giao hàng nhanh 24h</div>
                    <div class="text-xs text-slate-500">Miễn phí cho đơn từ 2tr</div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-primary/10 text-primary flex items-center justify-center rounded-full shrink-0">
                    <i class="fa-solid fa-user-check text-lg"></i>
                </div>
                <div>
                    <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-slate-100 leading-none mb-1">Bảo hành chính hãng</div>
                    <div class="text-xs text-slate-500">Cam kết 100% hàng thật</div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-primary/10 text-primary flex items-center justify-center rounded-full shrink-0">
                    <i class="fa-solid fa-rotate-left text-lg"></i>
                </div>
                <div>
                    <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-slate-100 leading-none mb-1">Đổi trả 30 ngày</div>
                    <div class="text-xs text-slate-500">Thủ tục nhanh chóng</div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-primary/10 text-primary flex items-center justify-center rounded-full shrink-0">
                    <i class="fa-solid fa-headset text-lg"></i>
                </div>
                <div>
                    <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-slate-100 leading-none mb-1">Hỗ trợ 24/7</div>
                    <div class="text-xs text-slate-500">Luôn sẵn sàng giải đáp</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cam Kết Banner -->
<section class="py-10 bg-white dark:bg-slate-900">
    <div class="max-w-[1400px] mx-auto px-4 text-center">
        <p class="text-sm font-bold text-slate-600 dark:text-slate-400 mb-1">
            Trải nghiệm mua sắm tại <span class="text-primary font-black uppercase">TECHFLOW</span>
        </p>
        <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white">
            Cam Kết 100% <span class="text-primary">Hài Lòng</span>
        </h2>
    </div>
</section>

<!-- Newsletter (chỉ hiện cho khách chưa đăng nhập) -->
@guest
<section class="py-20 bg-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="blueprint-grid w-full h-full"></div>
    </div>
    <div class="max-w-[1400px] mx-auto px-4 relative z-10">
        <div class="flex flex-col items-center text-center max-w-2xl mx-auto">
            <h2 class="text-white text-4xl font-black uppercase tracking-tighter mb-4">Đừng Bỏ Lỡ Ưu Đãi</h2>
            <p class="text-white mb-8">Đăng ký tài khoản để cập nhật những sản phẩm mới nhất và các chương trình khuyến mãi độc quyền từ TechFlow.</p>
            <a href="{{ route('register') }}" class="bg-white text-primary font-black uppercase text-xs tracking-widest py-4 px-10 rounded-lg hover:bg-slate-100 transition-colors inline-block">Đăng Ký Ngay</a>
        </div>
    </div>
</section>
@endguest
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('deal-hot-slider');
    if (!slider) return;

    let isHovered = false;
    slider.addEventListener('mouseenter', () => isHovered = true);
    slider.addEventListener('mouseleave', () => isHovered = false);

    const autoSlide = () => {
        if (!isHovered) {
            const scrollAmount = slider.offsetWidth / 4 + 24; // Item width + gap
            const maxScroll = slider.scrollWidth - slider.clientWidth;
            
            if (slider.scrollLeft >= maxScroll - 5) {
                slider.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }
    };

    setInterval(autoSlide, 5000);
});
</script>
@endsection
