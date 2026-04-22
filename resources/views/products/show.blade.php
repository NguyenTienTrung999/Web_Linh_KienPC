@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<main class="flex-1 px-4 md:px-20 py-8 max-w-[1600px] mx-auto w-full">
<!-- Product Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
<!-- Gallery Column -->
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .active-thumb { border-color: #2badee !important; transform: scale(0.95); opacity: 0.8; }
    #thumb-scroll { cursor: grab; user-select: none; -webkit-user-drag: none; }
    #thumb-scroll.dragging { cursor: grabbing; scroll-behavior: auto !important; }
    #thumb-scroll .thumb-item { -webkit-user-drag: none; }
</style>

<!-- Gallery Column -->
<div class="flex flex-col gap-4 overflow-hidden">
    <!-- Main Image Container -->
    <div class="relative group aspect-square bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm">
        <div id="main-image" class="w-full h-full bg-center bg-no-repeat bg-cover transition-all duration-500" 
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
        <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-slate-900/10 hover:bg-slate-900/40 text-white/50 hover:text-white transition-all backdrop-blur-sm opacity-0 group-hover:opacity-100 flex items-center justify-center z-10 border border-white/10">
            <i class="fa-solid fa-chevron-left text-lg"></i>
        </button>
        <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-slate-900/10 hover:bg-slate-900/40 text-white/50 hover:text-white transition-all backdrop-blur-sm opacity-0 group-hover:opacity-100 flex items-center justify-center z-10 border border-white/10">
            <i class="fa-solid fa-chevron-right text-lg"></i>
        </button>
        @endif
    </div>

    <!-- Thumbnails Scrollable -->
    <div class="relative">
        <div id="thumb-scroll" class="flex gap-4 overflow-x-auto no-scrollbar snap-x snap-mandatory scroll-smooth pb-2 pt-1">
            @foreach($allImages as $index => $imageUrl)
            <div data-index="{{ $index }}" 
                 class="thumb-item flex-shrink-0 w-[calc(25%-12px)] aspect-square rounded-lg border-2 {{ $index === 0 ? 'active-thumb' : 'border-transparent' }} overflow-hidden cursor-pointer transition-all snap-start shadow-sm hover:shadow-md" 
                 onclick="changeImage({{ $index }})">
                <div class="w-full h-full bg-center bg-no-repeat bg-cover hover:scale-110 transition-transform duration-300" 
                     style='background-image: url("{{ $imageUrl }}");'></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Info Column -->
<div class="flex flex-col justify-start gap-6">
<div>
<div class="flex items-center gap-2 mb-2">
@if($product->is_featured)
<span class="px-2 py-0.5 bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider rounded">Sản phẩm nổi bật</span>
@elseif(now()->diffInDays($product->created_at) <= 7)
<span class="px-2 py-0.5 bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider rounded">Mới</span>
@endif
@if($product->brand)
<span class="px-2 py-0.5 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 text-xs font-bold uppercase tracking-wider rounded">{{ $product->brand }}</span>
@endif
</div>
<h1 class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-tight mb-2">{{ $product->name }}</h1>
<div class="flex items-center gap-4">
@if($product->sale_price)
    <div class="flex flex-col">
        <div class="flex items-center gap-3">
            <p class="text-[16px] font-bold text-primary">{{ number_format($product->sale_price, 0, ',', '.') }}đ</p>
            <span class="px-2 py-1 bg-red-500 text-white text-[10px] font-black rounded shadow-sm group-hover:scale-110 transition-transform tracking-wider">-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
        </div>
        <p class="text-slate-400 line-through text-base font-medium">Giá niêm yết: {{ number_format($product->price, 0, ',', '.') }}đ</p>
    </div>
@else
    <p class="text-[16px] font-bold text-primary">{{ number_format($product->price, 0, ',', '.') }}₫</p>
@endif
<span class="flex items-center gap-1 {{ $product->stock_quantity > 0 ? 'text-emerald-600' : 'text-red-500' }} font-medium text-sm">
    <i class="fa-solid fa-circle-check text-[14px]"></i> 
    {{ $product->stock_quantity > 0 ? 'Còn hàng (' . $product->stock_quantity . ')' : 'Hết hàng' }}
</span>
</div>
</div>
<p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">{{ $product->description ?? 'Đang cập nhật mô tả...' }}</p>
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
<div class="flex gap-4">
<button type="button" onclick="addToCart({{ $product->id }})" class="flex-1 flex h-14 cursor-pointer items-center justify-center rounded-xl bg-primary text-white gap-2 text-base font-bold transition-all hover:bg-primary/90"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</button>
<button class="flex h-14 px-6 cursor-pointer items-center justify-center rounded-xl border-2 border-primary text-primary bg-transparent font-bold transition-all hover:bg-primary/5">
<i class="fa-solid fa-heart"></i>
</button>
</div>
<button type="button" onclick="addToCart({{ $product->id }}, 1, true)" class="w-full flex h-14 cursor-pointer items-center justify-center rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-base font-bold transition-all hover:opacity-90">Mua ngay</button>
</div>
<div class="flex items-center gap-6 mt-2 text-slate-500 text-sm">
<div class="flex items-center gap-2">
<i class="fa-solid fa-truck text-[16px]"></i>
<span>Giao hàng miễn phí</span>
</div>
<div class="flex items-center gap-2">
<i class="fa-solid fa-user-check text-[16px]"></i>
<span>Bảo hành 2 năm</span>
</div>
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
<div>
<div class="flex items-center justify-between mb-8">
<h3 class="text-2xl font-bold flex items-center gap-3"><span class="w-2 h-8 bg-primary rounded-full"></span> Sản phẩm liên quan</h3>
<a class="text-primary font-semibold hover:underline flex items-center gap-1" href="#">Xem tất cả <i class="fa-solid fa-chevron-right text-[12px]"></i></a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
@forelse($relatedProducts as $related)
<a href="{{ route('products.show', $related) }}" class="group cursor-pointer block">
<div class="aspect-square rounded-xl overflow-hidden mb-4 bg-slate-200">
<div class="w-full h-full bg-center bg-no-repeat bg-cover group-hover:scale-105 transition-transform duration-300" data-alt="{{ $related->name }}" style='background-image: url("{{ $related->image ? asset('storage/' . $related->image) : 'https://placehold.co/400x400?text=No+Image' }}");'></div>
</div>
<h4 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">{{ $related->name }}</h4>
@if($related->sale_price)
    <div class="flex items-center gap-2">
        <p class="text-primary font-bold text-[16px]">{{ number_format($related->sale_price, 0, ',', '.') }}đ</p>
        <p class="text-slate-400 line-through text-[11px]">{{ number_format($related->price, 0, ',', '.') }}đ</p>
    </div>
@else
    <p class="text-primary font-bold text-[16px]">{{ number_format($related->price, 0, ',', '.') }}₫</p>
@endif
</a>
@empty
<div class="col-span-full text-slate-500">
    Không có sản phẩm liên quan.
</div>
@endforelse
</div>
</div>
</main>
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
</script>
@endsection
@endsection
