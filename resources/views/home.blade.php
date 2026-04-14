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
    <div class="relative max-w-[1400px] mx-auto px-4 w-full">
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

<!-- Categories -->
<section class="py-16 bg-surface">
    <div class="max-w-[1400px] mx-auto px-4">
        <h2 class="slash-header text-2xl font-black uppercase tracking-tighter mb-10 text-on-surface">Danh mục sản phẩm</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories->take(6) as $category)
                @php
                    $iconMap = ['Bàn phím' => 'fa-keyboard', 'Chuột' => 'fa-mouse', 'Màn hình' => 'fa-desktop', 'Tai nghe' => 'fa-headphones', 'Linh kiện' => 'fa-microchip', 'Phụ kiện' => 'fa-plug', 'Loa' => 'fa-volume-high'];
                    $icon = 'fa-tag'; 
                    foreach ($iconMap as $key => $val) { if(str_contains(strtolower($category->name), strtolower($key))) { $icon = $val; break; } }
                @endphp
                <a class="group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-md transition-all text-center border border-transparent hover:border-slate-200 dark:hover:border-slate-700" href="{{ route('store.index', ['categories[]' => $category->id]) }}">
                    <div class="w-12 h-12 bg-primary-container text-primary rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid {{ $icon }} text-xl"></i>
                    </div>
                    <span class="text-[11px] font-black uppercase tracking-widest text-slate-700 dark:text-slate-300 leading-snug">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Deal Hot Every Day -->
@if($flashSales->count() > 0)
<section class="py-16 bg-slate-900 text-white relative overflow-hidden blueprint-grid">
    <div class="max-w-[1400px] mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
            <div>
                <h2 class="slash-header text-3xl font-black uppercase tracking-tighter mb-2">Deal Hot Mỗi Ngày</h2>
                <p class="text-slate-400">Ưu đãi cực khủng, kết thúc sau:</p>
            </div>
            <div class="flex gap-4">
                <div class="bg-primary text-white p-3 rounded-lg min-w-[60px] text-center shadow-lg shadow-primary/20">
                    <div class="text-2xl font-black">00</div>
                    <div class="text-[10px] uppercase font-bold opacity-70">Ngày</div>
                </div>
                <div class="bg-primary text-white p-3 rounded-lg min-w-[60px] text-center shadow-lg shadow-primary/20">
                    <div class="text-2xl font-black">12</div>
                    <div class="text-[10px] uppercase font-bold opacity-70">Giờ</div>
                </div>
                <div class="bg-primary text-white p-3 rounded-lg min-w-[60px] text-center shadow-lg shadow-primary/20">
                    <div class="text-2xl font-black">45</div>
                    <div class="text-[10px] uppercase font-bold opacity-70">Phút</div>
                </div>
                <div class="bg-primary text-white p-3 rounded-lg min-w-[60px] text-center shadow-lg shadow-primary/20">
                    <div class="text-2xl font-black">30</div>
                    <div class="text-[10px] uppercase font-bold opacity-70">Giây</div>
                </div>
            </div>
        </div>
        <div id="deal-hot-slider" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            @foreach($flashSales as $product)
            <div class="shrink-0 snap-start w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] bg-white/5 backdrop-blur-sm border border-white/10 rounded-lg p-4 group flex flex-col hover:bg-white/10 transition-colors">
                <div class="relative aspect-square mb-4 overflow-hidden rounded bg-white">
                    <span class="absolute top-2 left-2 z-10 bg-error text-white text-[10px] font-black px-2 py-1 rounded shadow-lg">GIẢM {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold text-lg mb-1 truncate group-hover:text-primary transition-colors text-white">{{ $product->name }}</h3>
                </a>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-primary font-black text-xl">{{ number_format($product->sale_price, 0, ',', '.') }}đ</span>
                    <span class="text-slate-500 line-through text-sm">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                </div>
                <div class="w-full bg-slate-700 h-2 rounded-full overflow-hidden mb-4 mt-auto">
                    <div class="bg-primary h-full rounded-full" style="width: {{ rand(40, 90) }}%"></div>
                </div>
                <div class="text-xs text-slate-400 font-bold uppercase mb-4">Đã bán {{ rand(10, 50) }}/60 sản phẩm</div>
                <a href="{{ route('products.show', $product) }}" class="w-full bg-primary hover:bg-primary/90 text-white font-black uppercase text-[10px] py-3 tracking-widest rounded transition-colors block text-center mt-auto shadow-lg shadow-primary/20">Mua Ngay</a>
            </div>
            @endforeach
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-center gap-4 mt-10">
            <button onclick="document.getElementById('deal-hot-slider').scrollBy({left: -350, behavior: 'smooth'})" class="w-12 h-12 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white hover:bg-primary hover:border-primary transition-all shadow-lg hover:shadow-primary/40 group">
                <i class="fa-solid fa-chevron-left text-sm transition-transform group-hover:-translate-x-1"></i>
            </button>
            <button onclick="document.getElementById('deal-hot-slider').scrollBy({left: 350, behavior: 'smooth'})" class="w-12 h-12 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white hover:bg-primary hover:border-primary transition-all shadow-lg hover:shadow-primary/40 group">
                <i class="fa-solid fa-chevron-right text-sm transition-transform group-hover:translate-x-1"></i>
            </button>
        </div>
    </div>
</section>
@endif

<!-- Featured Products -->
<section id="featured" class="py-16">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="flex items-center justify-between mb-10">
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
        <div id="featured-slider" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            @forelse($featuredProducts as $product)
            <div class="shrink-0 snap-start w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] bg-surface-container-lowest rounded-lg p-4 group hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-800 flex flex-col hover:border-primary">
                <div class="relative aspect-square bg-surface-container-low rounded mb-4 overflow-hidden border border-slate-50 dark:border-slate-800 bg-white">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>
                    <a href="{{ route('cart.index') }}" class="absolute bottom-4 left-4 right-4 bg-on-surface text-white font-bold text-xs py-3 rounded opacity-0 group-hover:opacity-100 transition-opacity uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-slate-800 text-center">
                        <i class="fa-solid fa-cart-shopping text-xs"></i> Thêm vào giỏ
                    </a>
                </div>
                <div class="flex items-center gap-1 mb-2">
                    <i class="fa-solid fa-star text-secondary text-[10px]"></i>
                    <i class="fa-solid fa-star text-secondary text-[10px]"></i>
                    <i class="fa-solid fa-star text-secondary text-[10px]"></i>
                    <i class="fa-solid fa-star text-secondary text-[10px]"></i>
                    <i class="fa-solid fa-star text-secondary text-[10px]"></i>
                    <span class="text-[10px] text-on-surface-variant font-bold ml-1">({{ rand(50, 250) }})</span>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold text-slate-900 dark:text-slate-100 mb-1 group-hover:text-primary transition-colors line-clamp-2 min-h-[40px]">{{ $product->name }}</h3>
                </a>
                @if($product->sale_price)
                    <div class="flex items-center gap-2 mt-auto pt-2">
                        <div class="text-primary font-black">{{ number_format($product->sale_price, 0, ',', '.') }}đ</div>
                        <div class="text-slate-400 line-through text-[10px]">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                    </div>
                @else
                    <div class="text-primary font-black mt-auto pt-2">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                @endif
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

<!-- Bàn Phím Gaming Section with Tabs -->
@if($keyboards->count() > 0)
<section class="py-16 bg-surface-container-high dark:bg-slate-800/50">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10">
            <h2 class="slash-header text-2xl font-black uppercase tracking-tighter text-on-surface">Bàn Phím Gaming</h2>
            <div class="flex gap-4 mt-6 md:mt-0 overflow-x-auto pb-2">
                @php $kbCat = \App\Models\Category::where('name', 'like', '%bàn phím%')->first(); @endphp
                <a href="{{ $kbCat ? route('store.index', ['categories[]' => $kbCat->id]) : route('store.index') }}" class="whitespace-nowrap border border-primary text-primary hover:bg-primary hover:text-white px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 group shadow-sm hover:shadow-primary/20">
                    Xem tất cả 
                    <i class="fa-solid fa-chevron-right text-[8px] transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($keyboards->take(4) as $product)
            <div class="bg-surface-container-lowest rounded-lg p-4 group hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-800 flex flex-col h-full hover:border-primary">
                <div class="relative aspect-square bg-surface-container-low rounded mb-4 overflow-hidden border border-slate-50 dark:border-slate-800 bg-white">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>
                    <a href="{{ route('cart.index') }}" class="absolute bottom-4 left-4 right-4 bg-on-surface text-white font-bold text-xs py-3 rounded opacity-0 group-hover:opacity-100 transition-opacity uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-slate-800 text-center">
                        <i class="fa-solid fa-cart-shopping text-xs"></i> Thêm vào giỏ
                    </a>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold mb-1 line-clamp-2 group-hover:text-primary transition-colors text-slate-900 dark:text-slate-100 min-h-[40px]">{{ $product->name }}</h3>
                </a>
                @if($product->sale_price)
                    <div class="flex items-center gap-2 mt-auto pt-2">
                        <div class="text-primary font-black">{{ number_format($product->sale_price, 0, ',', '.') }}đ</div>
                        <div class="text-slate-400 line-through text-[10px]">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                    </div>
                @else
                    <div class="text-primary font-black pt-2 mt-auto">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Chuột Gaming & Văn Phòng -->
@if($mice->count() > 0)
<section class="py-16">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10">
            <h2 class="slash-header text-2xl font-black uppercase tracking-tighter text-on-surface">Chuột Gaming & Văn Phòng</h2>
            <div class="flex gap-4 mt-6 md:mt-0 overflow-x-auto pb-2">
                @php $miceCat = \App\Models\Category::where('name', 'like', '%chuột%')->orWhere('name', 'like', '%mouse%')->first(); @endphp
                <a href="{{ $miceCat ? route('store.index', ['categories[]' => $miceCat->id]) : route('store.index') }}" class="whitespace-nowrap border border-primary text-primary hover:bg-primary hover:text-white px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 group shadow-sm hover:shadow-primary/20">
                    Xem tất cả 
                    <i class="fa-solid fa-chevron-right text-[8px] transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($mice->take(4) as $product)
            <div class="bg-surface-container-lowest rounded-lg p-4 group hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-800 flex flex-col h-full hover:border-primary">
                <div class="relative aspect-square bg-surface-container-low rounded mb-4 overflow-hidden border border-slate-50 dark:border-slate-800 bg-white">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>
                    <a href="{{ route('cart.index') }}" class="absolute bottom-4 left-4 right-4 bg-on-surface text-white font-bold text-xs py-3 rounded opacity-0 group-hover:opacity-100 transition-opacity uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-slate-800 text-center">
                        <i class="fa-solid fa-cart-shopping text-xs"></i> Thêm vào giỏ
                    </a>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold mb-1 line-clamp-2 group-hover:text-primary transition-colors text-slate-900 dark:text-slate-100 min-h-[40px]">{{ $product->name }}</h3>
                </a>
                @if($product->sale_price)
                    <div class="flex items-center gap-2 mt-auto pt-2">
                        <div class="text-primary font-black">{{ number_format($product->sale_price, 0, ',', '.') }}đ</div>
                        <div class="text-slate-400 line-through text-[10px]">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                    </div>
                @else
                    <div class="text-primary font-black pt-2 mt-auto">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Tai Nghe Gaming Section -->
@if($headphones->count() > 0)
<section class="py-16 bg-surface-container-high dark:bg-slate-800/50">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10">
            <h2 class="slash-header text-2xl font-black uppercase tracking-tighter text-on-surface">Tai Nghe Gaming</h2>
            <div class="flex gap-4 mt-6 md:mt-0 overflow-x-auto pb-2">
                @php $hpCat = \App\Models\Category::where('name', 'like', '%tai nghe%')->orWhere('name', 'like', '%headphone%')->first(); @endphp
                <a href="{{ $hpCat ? route('store.index', ['categories[]' => $hpCat->id]) : route('store.index') }}" class="whitespace-nowrap border border-primary text-primary hover:bg-primary hover:text-white px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 group shadow-sm hover:shadow-primary/20">
                    Xem tất cả 
                    <i class="fa-solid fa-chevron-right text-[8px] transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($headphones->take(4) as $product)
            <div class="bg-surface-container-lowest rounded-lg p-4 group hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-800 flex flex-col h-full hover:border-primary">
                <div class="relative aspect-square bg-surface-container-low rounded mb-4 overflow-hidden border border-slate-50 dark:border-slate-800 bg-white">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>
                    <a href="{{ route('cart.index') }}" class="absolute bottom-4 left-4 right-4 bg-on-surface text-white font-bold text-xs py-3 rounded opacity-0 group-hover:opacity-100 transition-opacity uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-slate-800 text-center">
                        <i class="fa-solid fa-cart-shopping text-xs"></i> Thêm vào giỏ
                    </a>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold mb-1 line-clamp-2 group-hover:text-primary transition-colors text-slate-900 dark:text-slate-100 min-h-[40px]">{{ $product->name }}</h3>
                </a>
                @if($product->sale_price)
                    <div class="flex items-center gap-2 mt-auto pt-2">
                        <div class="text-primary font-black">{{ number_format($product->sale_price, 0, ',', '.') }}đ</div>
                        <div class="text-slate-400 line-through text-[10px]">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                    </div>
                @else
                    <div class="text-primary font-black pt-2 mt-auto">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Loa Máy Tính Section -->
@if($speakers->count() > 0)
<section class="py-16 bg-white dark:bg-slate-900">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10">
            <h2 class="slash-header text-2xl font-black uppercase tracking-tighter text-on-surface">Loa Máy Tính & Âm Thanh</h2>
            <div class="flex gap-4 mt-6 md:mt-0 overflow-x-auto pb-2">
                @php $spCat = \App\Models\Category::where('name', 'like', '%loa%')->orWhere('name', 'like', '%speaker%')->first(); @endphp
                <a href="{{ $spCat ? route('store.index', ['categories[]' => $spCat->id]) : route('store.index') }}" class="whitespace-nowrap border border-primary text-primary hover:bg-primary hover:text-white px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all flex items-center gap-2 group shadow-sm hover:shadow-primary/20">
                    Xem tất cả 
                    <i class="fa-solid fa-chevron-right text-[8px] transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($speakers->take(4) as $product)
            <div class="bg-surface-container-lowest rounded-lg p-4 group hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-800 flex flex-col h-full hover:border-primary">
                <div class="relative aspect-square bg-surface-container-low rounded mb-4 overflow-hidden border border-slate-50 dark:border-slate-800 bg-white">
                    <a href="{{ route('products.show', $product) }}">
                        <img alt="{{ $product->name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                    </a>
                    <a href="{{ route('cart.index') }}" class="absolute bottom-4 left-4 right-4 bg-on-surface text-white font-bold text-xs py-3 rounded opacity-0 group-hover:opacity-100 transition-opacity uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-slate-800 text-center">
                        <i class="fa-solid fa-cart-shopping text-xs"></i> Thêm vào giỏ
                    </a>
                </div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="font-bold mb-1 line-clamp-2 group-hover:text-primary transition-colors text-slate-900 dark:text-slate-100 min-h-[40px]">{{ $product->name }}</h3>
                </a>
                @if($product->sale_price)
                    <div class="flex items-center gap-2 mt-auto pt-2">
                        <div class="text-primary font-black">{{ number_format($product->sale_price, 0, ',', '.') }}đ</div>
                        <div class="text-slate-400 line-through text-[10px]">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                    </div>
                @else
                    <div class="text-primary font-black pt-2 mt-auto">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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

<!-- Tech News -->
<section class="py-16">
    <div class="max-w-[1400px] mx-auto px-4">
        <h2 class="slash-header text-2xl font-black uppercase tracking-tighter mb-10 text-on-surface">Tin Tức Công Nghệ</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <article class="group">
                <div class="aspect-video overflow-hidden rounded-lg mb-4 shadow-sm">
                    <img alt="News 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7E5JM836vzFCQscGpcA5bTHV1VBYeKB2OJ7njDw5UvNjW-nXfpOWomMntCV0P9YNAWfvF-BwrvG65dHgda61HKtS6893OnLpCMLBSZDTRrwYK-y_J_tYvc5T-9Gl8jjPqtNVUV2TvJvWSwe7ynsp3lxhfOwBREY3tZAHuGlZsDftVV_qgvftyfDW-97rVT0-0LGJxy8_NKrZp3CmY1wDL4FSRt5FGNtyuA6vTH8R6qNNhqPb_WMq3QM1x1N1vmnhpr-TU071_blg"/>
                </div>
                <div class="text-[10px] text-primary font-black uppercase tracking-widest mb-2">Đánh giá linh kiện</div>
                <h3 class="font-bold text-xl mb-3 leading-tight group-hover:text-primary transition-colors text-slate-900 dark:text-slate-100">Đánh giá RTX 4090: Sức mạnh hủy diệt mọi tựa game AAA</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 line-clamp-2">Chúng tôi đã thử nghiệm chiếc card đồ họa mạnh nhất hiện nay trong các điều kiện khắc nghiệt nhất...</p>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400">12 THÁNG 5, 2024</span>
                    <a class="text-[11px] font-black uppercase tracking-widest text-primary flex items-center gap-1 hover:gap-2 transition-all" href="#">Đọc thêm <i class="fa-solid fa-arrow-right text-xs"></i></a>
                </div>
            </article>
            <article class="group">
                <div class="aspect-video overflow-hidden rounded-lg mb-4 shadow-sm">
                    <img alt="News 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAzkEurHkV3zaNDwD2t9cS7Nb4AtmeyIgwcVw84cfRB1qqNwISDb7KR1pte9eIXDv_fYGad3sHZx56XQuXC8hu9wTxhQdCeK_Cdsc3AxlGzw9_CPIcXMTREToLz6Mhanu7FWuNlNcpFzScUROCRL--V8kkHgo5ALlnnwUEI0Af_6tDZ7WbknCcIqA08zXB_NFNrB8s6IKuooSAf_SdFGqrlTccinOnDIXSunMfipr16F_f8EsTarjm82P11rRlz9mbxHYNgWtUm0uo"/>
                </div>
                <div class="text-[10px] text-primary font-black uppercase tracking-widest mb-2">Hướng dẫn build PC</div>
                <h3 class="font-bold text-xl mb-3 leading-tight group-hover:text-primary transition-colors text-slate-900 dark:text-slate-100">Hướng dẫn lắp tản nhiệt nước Custom cho người mới bắt đầu</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 line-clamp-2">Lắp đặt tản nhiệt nước không còn là nỗi ám ảnh nếu bạn nắm vững các nguyên tắc cơ bản sau đây...</p>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400">08 THÁNG 5, 2024</span>
                    <a class="text-[11px] font-black uppercase tracking-widest text-primary flex items-center gap-1 hover:gap-2 transition-all" href="#">Đọc thêm <i class="fa-solid fa-arrow-right text-xs"></i></a>
                </div>
            </article>
            <article class="group">
                <div class="aspect-video overflow-hidden rounded-lg mb-4 shadow-sm">
                    <img alt="News 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDZ5Xm4c6FxR_697opk1nzDVdXryoWW422hX_qbu9U8nI-pfmDzA6yCaw9i4nYfScaSKlyc71n1qyxieqc3gOAW1lUc1nPOp91qKCVUPMBAwq3rw9YOvDc1vZSRQR0XHwb0JJeAv8PvrGGHNW5rXA3lO7N3fhSOg5HmwNKJ1MG1Nr9LqievKmUMKTtXvoww1uqdDIzAaFw0RZq0W1pXfsJUe6Gp3aubJG2tfwGo9SUZ9HyA43hkWST7VRx2R63fIPKAZBefT-YRfgA"/>
                </div>
                <div class="text-[10px] text-primary font-black uppercase tracking-widest mb-2">Thị trường Gear</div>
                <h3 class="font-bold text-xl mb-3 leading-tight group-hover:text-primary transition-colors text-slate-900 dark:text-slate-100">Xu hướng bàn phím cơ 2024: Low profile và Magnetic Switch</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 line-clamp-2">Thị trường bàn phím cơ đang chứng kiến sự trỗi dậy mạnh mẽ của các dòng switch thế hệ mới...</p>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400">02 THÁNG 5, 2024</span>
                    <a class="text-[11px] font-black uppercase tracking-widest text-primary flex items-center gap-1 hover:gap-2 transition-all" href="#">Đọc thêm <i class="fa-solid fa-arrow-right text-xs"></i></a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="py-20 bg-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="blueprint-grid w-full h-full"></div>
    </div>
    <div class="max-w-[1400px] mx-auto px-4 relative z-10">
        <div class="flex flex-col items-center text-center max-w-2xl mx-auto">
            <h2 class="text-white text-4xl font-black uppercase tracking-tighter mb-4">Đừng Bỏ Lỡ Ưu Đãi</h2>
            <p class="text-white mb-8">Đăng ký nhận tin để cập nhật những sản phẩm mới nhất và các chương trình khuyến mãi độc quyền từ TechFlow.</p>
            <form class="w-full flex flex-col sm:flex-row gap-3">
                <input class="flex-grow bg-white/20 border-white/30 text-white placeholder-white/80 rounded-lg py-4 px-6 focus:ring-2 focus:ring-white outline-none" placeholder="Địa chỉ email của bạn" type="email"/>
                <button type="button" class="bg-white text-primary font-black uppercase text-xs tracking-widest py-4 px-10 rounded-lg hover:bg-slate-100 transition-colors">Đăng Ký Ngay</button>
            </form>
        </div>
    </div>
</section>
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
