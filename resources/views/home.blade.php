@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-white dark:bg-slate-900 py-16 lg:py-24">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid lg:grid-cols-2 gap-12 items-center">
<div class="order-2 lg:order-1">
<h2 class="text-primary font-bold tracking-wider uppercase text-sm mb-4" style="">Hàng Mới Về</h2>
<h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white leading-tight mb-6" style="">Nâng Tầm Không Gian <br/><span class="text-primary">Gaming</span></h1>
<p class="text-lg text-slate-600 dark:text-slate-400 mb-8 max-w-lg" style="">Trải nghiệm độ chính xác tối thượng và phản hồi xúc giác tuyệt vời với bàn phím cơ TechFlow Zenith mới. Thiết kế cho chuyên gia, dành cho tất cả mọi người.</p>
<div class="flex flex-wrap gap-4">
<a href="{{ route('store.index') }}" class="px-8 py-4 bg-primary text-white font-bold rounded-lg shadow-lg shadow-primary/30 hover:bg-primary/90 transition-all inline-block text-center" style="">Mua Ngay</a>
<a href="{{ route('store.index') }}" class="px-8 py-4 border-2 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-all inline-block text-center" style="">Tìm Hiểu Thêm</a>
</div>
</div>
<div class="order-1 lg:order-2">
<div class="relative">
<div class="absolute -inset-4 bg-primary/10 rounded-full blur-3xl"></div>
<img alt="High-end mechanical keyboard on a minimalist desk" class="relative rounded-xl shadow-2xl w-full object-cover aspect-[4/3]" data-alt="Modern mechanical keyboard with glowing RGB lights" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBiZlfMfMMturKJ7fH6xTvix3bwg1ESinmBn0gvM0tdpOcW9XRuU2g_Z4_Y-DNnwGcBu4EevUh4tVR3WCYkwffGpuCVrR49hM7QVuoZz-r3F6Mzr2BJ254JxcasJxGyP9eoZcSYet4WX77Zj_YuFS4_-mDRnkrbjZpW-254CmLqIR_lta77XF-Ya2uvo-ja2PZlG4ypTug4eSULLX9JcEcZ8BFRgfY_3B-qfWeRRekQDdGaPPLkIuAcmZGw2mQNZ6pkdaD_NMQYQ-M" style=""/>
</div>
</div>
</div>
</div>
</section>
<!-- Categories Section -->
<section class="py-16 bg-background-light dark:bg-background-dark">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-end justify-between mb-10">
<div>
<h2 class="text-2xl font-bold text-slate-900 dark:text-white" style="">Khám Phá Danh Mục</h2>
<p class="text-slate-500 mt-1" style="">Tìm linh kiện hoàn hảo cho dàn máy của bạn</p>
</div>
<a class="text-primary font-semibold hover:underline flex items-center gap-1" href="{{ route('store.index') }}" style="">Xem Tất Cả <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
@foreach($categories as $category)
@php
    // Basic icon map for TechFlow categories
    $iconMap = [
        'Bàn phím' => 'keyboard',
        'Chuột' => 'mouse',
        'Màn hình' => 'monitor',
        'Tai nghe' => 'headphones',
        'Linh kiện PC' => 'memory',
        'PC' => 'computer',
        'Laptop' => 'laptop_mac'
    ];
    // Find matching icon or fallback to list
    $icon = 'category'; 
    foreach ($iconMap as $key => $val) {
        if(str_contains(strtolower($category->name), strtolower($key))) {
            $icon = $val;
            break;
        }
    }
@endphp
<a href="{{ route('store.index', ['categories[]' => $category->id]) }}" class="group cursor-pointer bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 hover:border-primary transition-all text-center block">
<div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white">
<span class="material-symbols-outlined text-3xl" style="">{{ $icon }}</span>
</div>
<h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors" style="">{{ $category->name }}</h3>
<p class="text-sm text-slate-500 mt-1" style="">{{ $category->products()->count() ?? 0 }} Sản phẩm</p>
</a>
@endforeach
</div>
</div>
</section>
<!-- Featured Products -->
<section class="py-16 bg-white dark:bg-slate-900">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32">
    <!-- Keyboards Section -->
    @if($keyboards->count() > 0)
    <div style="margin-bottom: 6rem;">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Bàn phím nổi bật</h2>
            @php $kbCat = \App\Models\Category::where('name', 'like', '%bàn phím%')->first(); @endphp
            <a class="text-primary font-medium hover:underline" href="{{ $kbCat ? route('store.index', ['categories[]' => $kbCat->id]) : route('store.index') }}">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($keyboards as $product)
            <div class="group flex flex-col">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800 mb-4">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}"/>
                    </a>
                    @if($loop->first)
                    <div class="absolute top-3 left-3 bg-primary text-white text-[10px] font-bold px-2 py-1 rounded">MỚI</div>
                    @endif
                    <button class="absolute bottom-3 right-3 p-2 bg-white dark:bg-slate-900 shadow-md rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-primary">add_shopping_cart</span>
                    </button>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors cursor-pointer leading-tight">{{ $product->name }}</h3>
                </a>
                <p class="text-slate-500 text-sm mt-1">{{ $product->category ? $product->category->name : 'Bàn phím' }}</p>
                <div class="mt-2 text-lg font-black text-slate-900 dark:text-white">{{ number_format($product->price, 0, ',', '.') }}₫</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Mice Section -->
    @if($mice->count() > 0)
    <div style="margin-bottom: 6rem;">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Chuột nổi bật</h2>
            @php $mcCat = \App\Models\Category::where('name', 'like', '%chuột%')->first(); @endphp
            <a class="text-primary font-medium hover:underline" href="{{ $mcCat ? route('store.index', ['categories[]' => $mcCat->id]) : route('store.index') }}">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($mice as $product)
            <div class="group flex flex-col">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800 mb-4">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}"/>
                    </a>
                    <button class="absolute bottom-3 right-3 p-2 bg-white dark:bg-slate-900 shadow-md rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-primary">add_shopping_cart</span>
                    </button>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors cursor-pointer leading-tight">{{ $product->name }}</h3>
                </a>
                <p class="text-slate-500 text-sm mt-1">{{ $product->category ? $product->category->name : 'Chuột' }}</p>
                <div class="mt-2 text-lg font-black text-slate-900 dark:text-white">{{ number_format($product->price, 0, ',', '.') }}₫</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Monitors Section -->
    @if($monitors->count() > 0)
    <div style="margin-bottom: 6rem;">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Màn hình nổi bật</h2>
            @php $mnCat = \App\Models\Category::where('name', 'like', '%màn hình%')->first(); @endphp
            <a class="text-primary font-medium hover:underline" href="{{ $mnCat ? route('store.index', ['categories[]' => $mnCat->id]) : route('store.index') }}">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($monitors as $product)
            <div class="group flex flex-col">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800 mb-4">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}"/>
                    </a>
                    <button class="absolute bottom-3 right-3 p-2 bg-white dark:bg-slate-900 shadow-md rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-primary">add_shopping_cart</span>
                    </button>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors cursor-pointer leading-tight">{{ $product->name }}</h3>
                </a>
                <p class="text-slate-500 text-sm mt-1">{{ $product->category ? $product->category->name : 'Màn hình' }}</p>
                <div class="mt-2 text-lg font-black text-slate-900 dark:text-white">{{ number_format($product->price, 0, ',', '.') }}₫</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Headphones Section -->
    @if($headphones->count() > 0)
    <div style="margin-bottom: 6rem;">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Tai nghe nổi bật</h2>
            @php $hpCat = \App\Models\Category::where('name', 'like', '%tai nghe%')->first(); @endphp
            <a class="text-primary font-medium hover:underline" href="{{ $hpCat ? route('store.index', ['categories[]' => $hpCat->id]) : route('store.index') }}">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($headphones as $product)
            <div class="group flex flex-col">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800 mb-4">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}"/>
                    </a>
                    <button class="absolute bottom-3 right-3 p-2 bg-white dark:bg-slate-900 shadow-md rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-primary">add_shopping_cart</span>
                    </button>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors cursor-pointer leading-tight">{{ $product->name }}</h3>
                </a>
                <p class="text-slate-500 text-sm mt-1">{{ $product->category ? $product->category->name : 'Tai nghe' }}</p>
                <div class="mt-2 text-lg font-black text-slate-900 dark:text-white">{{ number_format($product->price, 0, ',', '.') }}₫</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Speakers Section -->
    @if($speakers->count() > 0)
    <div class="mb-24">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Loa nổi bật</h2>
            @php $spCat = \App\Models\Category::where('name', 'like', '%loa%')->first(); @endphp
            <a class="text-primary font-medium hover:underline" href="{{ $spCat ? route('store.index', ['categories[]' => $spCat->id]) : route('store.index') }}">Xem tất cả</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($speakers as $product)
            <div class="group flex flex-col">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800 mb-4">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}"/>
                    </a>
                    <button class="absolute bottom-3 right-3 p-2 bg-white dark:bg-slate-900 shadow-md rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-primary">add_shopping_cart</span>
                    </button>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors cursor-pointer leading-tight">{{ $product->name }}</h3>
                </a>
                <p class="text-slate-500 text-sm mt-1">{{ $product->category ? $product->category->name : 'Loa' }}</p>
                <div class="mt-2 text-lg font-black text-slate-900 dark:text-white">{{ number_format($product->price, 0, ',', '.') }}₫</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Fallback if no specific products found yet -->
    @if($keyboards->isEmpty() && $mice->isEmpty() && $monitors->isEmpty() && $headphones->isEmpty() && $speakers->isEmpty())
    <div class="py-12 text-center">
        <p class="text-slate-500 mb-4">Chưa có sản phẩm nào trong các danh mục nổi bật.</p>
        <a href="{{ route('store.index') }}" class="text-primary font-semibold hover:underline">Xem toàn bộ cửa hàng</a>
    </div>
    @endif
</div>
</section>
<!-- Promotion Banner -->
<section class="py-12 px-4">
<div class="max-w-7xl mx-auto rounded-2xl overflow-hidden bg-primary relative">
<div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent"></div>
<div class="relative px-8 py-12 md:px-16 md:py-20 flex flex-col md:flex-row md:items-center justify-between gap-8">
<div class="max-w-xl">
<h2 class="text-3xl md:text-4xl font-black text-white mb-4 leading-tight" style="">Xây dựng PC mới? Giảm ngay 15% cho combo đầu tiên.</h2>
<p class="text-white/80 text-lg" style="">Sử dụng mã FLOWBUILD15 khi thanh toán. Ưu đãi có hạn.</p>
</div>
<div class="shrink-0">
<a href="{{ route('store.index') }}" class="px-10 py-4 bg-white text-primary font-bold rounded-lg hover:bg-slate-50 transition-colors shadow-xl inline-block" style="">Nhận Ưu Đãi</a>
</div>
</div>
</div>
</section>
@endsection
