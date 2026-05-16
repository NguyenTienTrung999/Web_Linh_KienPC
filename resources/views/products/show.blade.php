@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="max-w-[1600px] mx-auto py-8 px-4">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Trang chủ</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <a href="{{ route('store.index') }}" class="hover:text-primary transition-colors">Cửa hàng</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        @if($product->category)
            <a href="{{ route('store.index', ['categories[]' => $product->category->id]) }}" class="hover:text-primary transition-colors">{{ $product->category->name }}</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
        @endif
        <span class="text-slate-900 dark:text-slate-200 font-medium line-clamp-1 max-w-[200px] sm:max-w-md lg:max-w-none">{{ $product->name }}</span>
    </nav>
    <!-- Product Section -->
    <div class="flex flex-col lg:flex-row gap-12 mb-16 items-start justify-between">
        <!-- Gallery Column -->
        <div class="w-full lg:w-[780px] shrink-0 flex flex-col gap-[12px] overflow-hidden order-1">
            <style>
                .no-scrollbar::-webkit-scrollbar { display: none; }
                .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
                .active-thumb { border-color: #2badee !important; transform: scale(0.95); opacity: 0.8; }
                #thumb-scroll { cursor: grab; user-select: none; -webkit-user-drag: none; }
                #thumb-scroll.dragging { cursor: grabbing; scroll-behavior: auto !important; }
                #thumb-scroll .thumb-item { -webkit-user-drag: none; }
            </style>

            <!-- Main Image Container -->
            <div class="relative group w-full lg:w-[780px] h-auto lg:h-[523px] aspect-[780/523] bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm mx-auto">
                <div id="main-image" class="w-full h-full bg-center bg-no-repeat bg-contain transition-all duration-500" 
                     style='background-image: url("{{ $product->image ? asset("storage/" . $product->image) : 'https://placehold.co/800x800?text=No+Image' }}");'>
                </div>
                
                <!-- Navigation Buttons -->
                @php 
                    $allImages = [];
                    if($product->image) $allImages[] = asset('storage/' . $product->image);
                    if($product->gallery && is_array($product->gallery)) {
                        foreach($product->gallery as $gal) $allImages[] = asset('storage/' . $gal);
                    }
                @endphp

                @if(count($allImages) > 1)
                    <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-900/10 hover:bg-slate-900/40 text-white/50 hover:text-white transition-all backdrop-blur-sm opacity-0 group-hover:opacity-100 flex items-center justify-center z-10 border border-white/10">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-900/10 hover:bg-slate-900/40 text-white/50 hover:text-white transition-all backdrop-blur-sm opacity-0 group-hover:opacity-100 flex items-center justify-center z-10 border border-white/10">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                @endif
            </div>

            <!-- Thumbnails Container -->
            <div class="w-full lg:w-[780px] mx-auto">
                <div id="thumb-scroll" class="flex flex-nowrap gap-[12px] overflow-x-auto no-scrollbar scroll-smooth snap-x snap-mandatory pb-2">
                    @foreach($allImages as $index => $imageUrl)
                        <div data-index="{{ $index }}" 
                             class="thumb-item shrink-0 w-[calc((100%-36px)/4)] sm:w-[calc((100%-48px)/5)] lg:w-[146.4px] h-[77px] rounded-lg border-2 {{ $index === 0 ? 'active-thumb' : 'border-transparent' }} overflow-hidden cursor-pointer transition-all shadow-sm hover:shadow-md snap-start" 
                             onclick="changeImage({{ $index }})">
                            <div class="w-full h-full bg-center bg-no-repeat bg-contain bg-white dark:bg-slate-700 hover:scale-110 transition-transform duration-300" 
                                 style='background-image: url("{{ $imageUrl }}");'></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Info Column -->
        <div class="flex-1 flex flex-col justify-start gap-6 order-2">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    @if($product->is_featured)
                        <span class="px-2 py-0.5 bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider rounded">Sản phẩm nổi bật</span>
                    @elseif(now()->diffInDays($product->created_at) <= 7)
                        <span class="px-2 py-0.5 bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider rounded">Mới</span>
                    @endif
                    @if($product->brand)
                        <span class="px-2 py-0.5 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 text-xs font-bold uppercase tracking-wider rounded">{{ $product->brand->name }}</span>
                    @endif
                </div>
                <h1 class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-tight mb-2 break-words max-w-[740px]">{{ $product->name }}</h1>
                <div class="flex items-center gap-4">
                    @if($product->sale_price)
                        <div class="flex flex-col">
                            <div class="flex items-center gap-3">
                                <p class="text-[24px] font-bold text-primary">{{ number_format($product->sale_price, 0, ',', '.') }}đ</p>
                                <span class="px-2 py-1 bg-red-500 text-white text-[12px] font-black rounded shadow-sm group-hover:scale-110 transition-transform tracking-wider">-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
                            </div>
                            <p class="text-slate-400 line-through text-base font-medium">Giá niêm yết: {{ number_format($product->price, 0, ',', '.') }}đ</p>
                        </div>
                    @else
                        <p class="text-[24px] font-bold text-primary">{{ number_format($product->price, 0, ',', '.') }}₫</p>
                    @endif
                    <span class="flex items-center gap-1 {{ $product->stock_quantity > 0 ? 'text-emerald-600' : 'text-red-500' }} font-medium text-sm">
                        <i class="fa-solid fa-circle-check text-[14px]"></i> 
                        {{ $product->stock_quantity > 0 ? 'Còn hàng (' . $product->stock_quantity . ')' : 'Hết hàng' }}
                    </span>
                </div>
                @if($product->warranty_period)
                    <div class="mt-2 text-primary text-[15px] font-bold flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Bảo hành: {{ $product->warranty_period }}</span>
                    </div>
                @endif

                @if($product->colors && is_array($product->colors) && count($product->colors) > 0)
                    <div class="mt-6">
                        <p class="text-sm font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-palette text-primary"></i>
                            Chọn màu sắc:
                        </p>
                        <div class="flex flex-wrap gap-3">
                            @foreach($product->colors as $color)
                                <button type="button" 
                                        onclick="selectColor('{{ $color }}', this)"
                                        class="color-option px-4 py-2 rounded-lg border-2 border-slate-200 dark:border-slate-700 text-sm font-medium transition-all hover:border-primary dark:hover:border-primary text-slate-700 dark:text-slate-300">
                                    {{ $color }}
                                </button>
                            @endforeach
                        </div>
                        <input type="hidden" id="selected-color" value="">
                    </div>
                @endif
            </div>
            
            <div class="prose dark:prose-invert max-w-none">
                <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">{!! nl2br(e(str_replace(';', '', $product->description ?? 'Đang cập nhật mô tả...'))) !!}</p>
            </div>

            <!-- Features -->
            @if($product->tags)
                <div class="flex gap-3 flex-wrap">
                    @foreach(explode(',', $product->tags) as $tag)
                        @php $tag = trim($tag); @endphp
                        @if($tag)
                            <div class="flex h-10 items-center justify-center gap-2 rounded bg-slate-100 dark:bg-slate-800 px-4">
                                <i class="fa-solid fa-tag text-primary text-[14px]"></i>
                                <p class="text-slate-700 dark:text-slate-300 text-sm font-medium">{{ $tag }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            <hr class="border-slate-200 dark:border-slate-800 my-2"/>

            <!-- Actions -->
            <div class="flex flex-col gap-4">
                <button type="button" 
                        onclick="const color = document.getElementById('selected-color')?.value; if(document.querySelectorAll('.color-option').length > 0 && !color) { showToast('Vui lòng chọn màu sắc sản phẩm!', 'warning'); return; } addToCart({{ $product->id }}, 1, false, color)" 
                        class="w-full flex h-14 cursor-pointer items-center justify-center rounded-xl bg-primary text-white gap-2 text-base font-bold transition-all hover:bg-primary/90">
                    <i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng
                </button>
                <button type="button" 
                        onclick="const color = document.getElementById('selected-color')?.value; if(document.querySelectorAll('.color-option').length > 0 && !color) { showToast('Vui lòng chọn màu sắc sản phẩm!', 'warning'); return; } addToCart({{ $product->id }}, 1, true, color)" 
                        class="w-full flex h-14 cursor-pointer items-center justify-center rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-base font-bold transition-all hover:opacity-90">
                    Mua ngay
                </button>
            </div>
        </div>
    </div>
<!-- Specs Table -->
<div class="mb-20">
<h3 class="text-2xl font-bold mb-8 flex items-center gap-3"><span class="w-2 h-8 bg-primary rounded-full"></span> Thông số kỹ thuật</h3>
<div class="overflow-hidden rounded-xl border border-slate-200 dark:border-slate-800">
@if($product->specs && is_array($product->specs) && count($product->specs) > 0)
<table class="w-full text-left border-collapse">
<tbody class="divide-y divide-slate-200 dark:divide-slate-800">
    @foreach($product->specs as $index => $spec)
    @if(!empty($spec['key']) || !empty($spec['value']))
    <tr class="{{ $index % 2 == 0 ? 'bg-white dark:bg-background-dark' : 'bg-slate-50/50 dark:bg-slate-800/20' }}">
    <td class="py-4 px-6 font-semibold text-slate-500 w-1/3">{{ $spec['key'] ?? '' }}</td>
    <td class="py-4 px-6">{{ $spec['value'] ?? '' }}</td>
    </tr>
    @endif
    @endforeach
</tbody>
</table>
@else
<div class="py-8 text-center text-slate-500">
    Đang cập nhật thông số kỹ thuật cho sản phẩm này.
</div>
@endif
</div>
</div>
<!-- Related Products -->
<div class="mt-16 border border-slate-300 dark:border-slate-700 rounded-2xl p-8 bg-white dark:bg-slate-900 shadow-sm mb-8">
    <div class="flex items-center justify-between mb-8">
        <h2 class="slash-header text-2xl font-black uppercase tracking-tighter text-on-surface">Sản phẩm liên quan</h2>
        <div class="flex gap-2">
            <button onclick="document.getElementById('related-slider').scrollBy({left: -320, behavior: 'smooth'})" class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-colors hover:shadow-lg">
                <i class="fa-solid fa-chevron-left text-sm"></i>
            </button>
            <button onclick="document.getElementById('related-slider').scrollBy({left: 320, behavior: 'smooth'})" class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-colors hover:shadow-lg">
                <i class="fa-solid fa-chevron-right text-sm"></i>
            </button>
        </div>
    </div>
    <div id="related-slider" class="flex gap-[12px] overflow-x-auto snap-x snap-mandatory pb-4 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        @forelse($relatedProducts as $related)
        <!-- Standard Product Card (Synchronized with Featured/Store) -->
        <div class="shrink-0 snap-start w-full sm:w-[calc((100%-12px)/2)] lg:w-[calc((100%-36px)/4)] xl:w-[calc((100%-60px)/6)] bg-white dark:bg-slate-800 rounded-xl border border-slate-300 dark:border-slate-700 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col h-[400px] relative product-card">
            
            <!-- Product Preview Popover -->
            <div class="product-popover fixed left-0 top-0 w-[350px] bg-white dark:bg-slate-900 rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-slate-200 dark:border-slate-700 z-[9999] hidden flex-col overflow-hidden pointer-events-none transition-opacity duration-200 opacity-0">
                <div class="bg-primary p-3">
                    <h4 class="text-white font-bold text-sm leading-tight uppercase line-clamp-2">{{ $related->name }}</h4>
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-slate-900 dark:text-slate-100 text-sm">Giá bán:</span>
                        <span class="text-primary font-black text-lg">{{ number_format($related->sale_price ?: $related->price, 0, ',', '.') }} VNĐ</span>
                    </div>
                    @if($related->warranty_period)
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-slate-900 dark:text-slate-100 text-sm">Bảo hành:</span>
                        <span class="text-slate-600 dark:text-slate-400 text-sm font-medium">{{ $related->warranty_period }}</span>
                    </div>
                    @endif
                    @php
                        $filteredSpecs = [];
                        if($related->specs && is_array($related->specs)) {
                            $filteredSpecs = array_filter(array_slice($related->specs, 0, 6), function($spec) {
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

            <!-- Image Area: 240px -->
            <div class="h-[240px] bg-white relative overflow-hidden shrink-0 rounded-t-xl product-trigger">
                <a href="{{ route('products.show', $related->slug ?? $related->id) }}" class="block h-full">
                    <img alt="{{ $related->name }}" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-700" src="{{ $related->image ? asset('storage/' . $related->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                </a>
            </div>

            <!-- Info Area -->
            <div class="p-4 flex flex-col gap-[6px] border-t border-slate-50 dark:border-slate-800 flex-grow">
                <!-- Block 1: Name (max 40px) -->
                <a href="{{ route('products.show', $related->slug ?? $related->id) }}" class="block h-[40px] max-h-[40px]">
                    <h3 class="font-bold text-slate-900 dark:text-slate-100 text-[16px] leading-[20px] group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $related->name }}</h3>
                </a>
                
                <!-- Block 2: Price (max 46px) -->
                <div class="flex items-center justify-between h-[46px] max-h-[46px]">
                    <div class="flex flex-col justify-center h-full">
                        @if($related->sale_price)
                            <span class="text-primary !font-bold text-[18px] leading-[24px]">{{ number_format($related->sale_price, 0, ',', '.') }}₫</span>
                            <span class="text-[12px] text-slate-400 font-bold line-through leading-[18px]">{{ number_format($related->price, 0, ',', '.') }}₫</span>
                        @else
                            <span class="text-primary !font-bold text-[18px] leading-[24px]">{{ number_format($related->price, 0, ',', '.') }}₫</span>
                        @endif
                    </div>
                    @if($related->sale_price)
                        <div class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded shadow-sm whitespace-nowrap shrink-0">
                            -{{ round((($related->price - $related->sale_price) / $related->price) * 100) }}%
                        </div>
                    @endif
                </div>

                <!-- Block 3: Action (max 26px) -->
                <div class="flex items-center justify-between h-[26px] max-h-[26px]">
                    <button type="button" onclick="handleAddToCart({{ $related->id }}, {{ json_encode($related->colors) }}, '{{ addslashes($related->name) }}', {{ $related->sale_price ?: $related->price }}, '{{ $related->image ? asset('storage/' . $related->image) : 'https://placehold.co/400x400?text=No+Image' }}')" class="relative flex items-center h-[26px] rounded-full overflow-hidden group/btn pr-3 pl-0 transition-all bg-slate-100 dark:bg-slate-700/50 hover:shadow-md">
                        <div class="absolute left-0 top-0 w-[26px] h-[26px] bg-primary rounded-full transition-all duration-300 ease-in-out group-hover/btn:w-full z-0"></div>
                        <div class="relative z-10 flex items-center gap-1.5 h-full">
                            <div class="w-[26px] h-[26px] flex items-center justify-center text-white shrink-0">
                                <i class="fa-solid fa-cart-shopping text-[12px]"></i>
                            </div>
                            <span class="!font-bold text-[12px] uppercase tracking-wider text-slate-800 dark:text-slate-200 transition-colors duration-300 group-hover/btn:text-white whitespace-nowrap">Thêm vào giỏ</span>
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
                Không có sản phẩm liên quan.
            </div>
        @endforelse
    </div>
</div>
    </div>
@section('scripts')
<script>
    const images = @json($allImages);
    let currentIndex = 0;

    function changeImage(index) {
        currentIndex = index;
        const mainImage = document.getElementById('main-image');
        const thumbnails = document.querySelectorAll('.thumb-item');
        
        // Update Main Image
        mainImage.style.opacity = '0.5';
        setTimeout(() => {
            mainImage.style.backgroundImage = `url('${images[currentIndex]}')`;
            mainImage.style.opacity = '1';
        }, 150);

        // Update Active Thumbnail
        thumbnails.forEach((thumb, i) => {
            if (i === currentIndex) {
                thumb.classList.add('active-thumb');
                // Scroll thumbnail into view
                thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } else {
                thumb.classList.remove('active-thumb');
            }
        });
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        changeImage(currentIndex);
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        changeImage(currentIndex);
    }

    function selectColor(color, element) {
        // Remove active class from all options
        document.querySelectorAll('.color-option').forEach(opt => {
            opt.classList.remove('border-primary', 'bg-primary/5', 'text-primary');
            opt.classList.add('border-slate-200', 'dark:border-slate-700', 'text-slate-700', 'dark:text-slate-300');
        });

        // Add active class to selected option
        element.classList.remove('border-slate-200', 'dark:border-slate-700', 'text-slate-700', 'dark:text-slate-300');
        element.classList.add('border-primary', 'bg-primary/5', 'text-primary');

        // Update hidden input
        document.getElementById('selected-color').value = color;
    }
    
    // Mouse drag scroll for thumbnails
    const scrollContainer = document.getElementById('thumb-scroll');
    if (scrollContainer) {
        let isDown = false;
        let startX;
        let scrollLeft;
        let hasMoved = false;

        scrollContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            hasMoved = false;
            scrollContainer.classList.add('dragging');
            startX = e.pageX - scrollContainer.offsetLeft;
            scrollLeft = scrollContainer.scrollLeft;
        });

        scrollContainer.addEventListener('mouseleave', () => {
            isDown = false;
            scrollContainer.classList.remove('dragging');
        });

        scrollContainer.addEventListener('mouseup', () => {
            isDown = false;
            scrollContainer.classList.remove('dragging');
        });

        scrollContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - scrollContainer.offsetLeft;
            const walk = (x - startX);
            if (Math.abs(walk) > 5) {
                hasMoved = true;
                scrollContainer.scrollLeft = scrollLeft - walk;
            }
        });

        // Prevent clicking a thumbnail if we were dragging
        scrollContainer.querySelectorAll('.thumb-item').forEach(item => {
            item.addEventListener('click', (e) => {
                if (hasMoved) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }
            }, true);
        });
    }
    // Color selection logic
    function selectColor(color, element) {
        document.getElementById('selected-color').value = color;
        
        // Update UI
        document.querySelectorAll('.color-option').forEach(btn => {
            btn.classList.remove('border-primary', 'bg-primary/5', 'text-primary');
            btn.classList.add('border-slate-200', 'dark:border-slate-700', 'text-slate-700', 'dark:text-slate-300');
        });
        
        element.classList.remove('border-slate-200', 'dark:border-slate-700', 'text-slate-700', 'dark:text-slate-300');
        element.classList.add('border-primary', 'bg-primary/5', 'text-primary');
    }
</script>
@endsection
@endsection
