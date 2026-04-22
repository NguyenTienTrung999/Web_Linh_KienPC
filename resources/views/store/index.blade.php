@extends('layouts.app')

@section('title', 'Cửa hàng')

@section('content')
<main class="max-w-[1600px] mx-auto w-full px-4 md:px-0 py-8">
<!-- Breadcrumbs & Title -->
<div class="mb-8">
<nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
<a class="hover:text-primary" href="{{ route('home') }}">Trang chủ</a>
<i class="fa-solid fa-chevron-right text-[10px]"></i>
<span class="text-slate-900 dark:text-slate-200 font-medium">Cửa hàng</span>
</nav>
<h1 class="text-3xl font-bold text-slate-900 dark:text-white">Danh mục sản phẩm</h1>
<p class="text-slate-500 dark:text-slate-400 mt-2">Khám phá vũ trụ linh kiện và phụ kiện xây dựng không gian Gaming.</p>
</div>

<div class="flex flex-row gap-[12px] items-start">
<!-- Sidebar Filters: 260px -->
<aside class="w-[260px] shrink-0 space-y-8">
<form action="{{ route('store.index') }}" method="GET" id="filterForm">
    <!-- Preserve search term if it exists -->
    @if(request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
    @endif
    
    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-300 dark:border-slate-700">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-filter text-primary"></i> Bộ lọc</h3>
            <a href="{{ route('store.index') }}" class="text-primary text-xs font-semibold hover:underline">Xóa tất cả</a>
        </div>
        
        <!-- Category Filter -->
        <div class="mb-8">
            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Danh mục</h4>
            <div class="space-y-3">
                @foreach($categories as $cat)
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input name="categories[]" value="{{ $cat->id }}" onchange="document.getElementById('filterForm').submit()" 
                           {{ in_array($cat->id, request('categories', [])) ? 'checked' : '' }} 
                           class="rounded border-slate-300 text-primary focus:ring-primary w-4 h-4" type="checkbox"/>
                    <span class="text-sm text-slate-700 dark:text-slate-300 group-hover:text-primary">{{ $cat->name }} 
                        <span class="text-xs text-slate-400 ml-1">({{ $cat->products_count }})</span>
                    </span>
                </label>
                @endforeach
            </div>
        </div>
        
        <!-- Price Range Filter -->
        <div class="mb-8">
            <h4 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Khoảng giá</h4>
            <div class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <input name="min_price" value="{{ request('min_price') }}" class="w-[45%] bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded text-sm p-2" placeholder="Tối thiểu" type="number"/>
                    <span class="text-slate-400">-</span>
                    <input name="max_price" value="{{ request('max_price') }}" class="w-[45%] bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded text-sm p-2" placeholder="Tối đa" type="number"/>
                </div>
                <button type="submit" class="w-full text-center py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 rounded text-sm font-medium transition-colors">Áp dụng giá</button>
            </div>
        </div>
    </div>
</form>
</aside>

<!-- Product Display Area: 1328px (incl border) -->
<div class="w-[1328px] border border-slate-300 dark:border-slate-700 p-[12px] bg-white dark:bg-slate-900 rounded-xl flex flex-col">
    <!-- Sort & Controls -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <p class="text-slate-500 dark:text-slate-400 text-sm">Hiển thị <span class="text-slate-900 dark:text-white font-bold">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> trong số {{ $products->total() }} sản phẩm</p>
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
        <select name="sort" onchange="document.getElementById('sortForm').submit()" class="bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-700 rounded-lg text-sm px-3 py-2 focus:ring-primary focus:border-primary">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
        </select>
    </form>
    </div>
    </div>

    <div class="grid grid-cols-5 gap-[12px] justify-items-center">
@forelse($products as $product)
    <!-- Product Card -->
    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-300 dark:border-slate-700 overflow-hidden group hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 flex flex-col w-[250px] h-[400px]">
        <!-- Image Area: 240px Height -->
        <div class="h-[240px] bg-white relative overflow-hidden shrink-0">
            <a href="{{ route('products.show', $product) }}" class="block h-full">
                <img alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700 p-6" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x300?text=No+Image' }}"/>
            </a>
            
            @if($product->sale_price)
                <div class="absolute top-3 left-3 bg-white text-red-500 border border-red-200 text-[11px] font-bold px-2 py-1 rounded shadow-sm z-10 transition-transform group-hover:scale-110">
                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                </div>
            @endif

            @if(now()->diffInDays($product->created_at) < 14)
                <div class="absolute top-3 right-3 bg-white text-primary border border-primary/20 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider shadow-sm z-10 transition-transform group-hover:scale-110">NEW</div>
            @endif

            <button class="absolute bottom-3 right-3 bg-white/90 dark:bg-slate-900/90 p-2.5 rounded-full shadow-lg hover:text-primary opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                <i class="fa-regular fa-heart text-lg"></i>
            </button>
        </div>

        <!-- Info Area: 160px Height -->
        <div class="p-4 flex flex-col h-[160px] justify-between border-t border-slate-50 dark:border-slate-800">
            <div>
                <a href="{{ route('products.show', $product) }}">
                    <h3 class="text-slate-900 dark:text-white font-bold text-[14px] leading-tight mb-1 group-hover:text-primary transition-colors line-clamp-2 h-[34px]">{{ $product->name }}</h3>
                </a>
                <p class="text-slate-500 dark:text-slate-400 text-[11px] font-medium uppercase tracking-tight">
                    {{ $product->category ? $product->category->name : 'Linh kiện' }}
                </p>
            </div>
            
            <div class="flex flex-col gap-2 mt-auto">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                        @if($product->sale_price)
                            <span class="text-[16px] font-bold text-primary">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                            <span class="text-[11px] text-slate-400 line-through">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                        @else
                            <span class="text-[16px] font-bold text-primary">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                        @endif
                    </div>
                    
                    <button type="button" onclick="addToCart({{ $product->id }})" class="bg-primary hover:bg-primary/90 text-white w-10 h-10 rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center transition-all hover:scale-105 active:scale-95">
                        <i class="fa-solid fa-cart-plus text-lg"></i>
                    </button>
                </div>
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

<!-- Pagination -->
<div class="mt-12 flex justify-center">
    {{ $products->links() }}
</div>
</div>
</div>
</main>
@endsection
