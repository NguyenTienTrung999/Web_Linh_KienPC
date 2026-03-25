@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<main class="flex-1 px-4 md:px-20 py-8 max-w-[1440px] mx-auto w-full">
<!-- Product Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
<!-- Gallery Column -->
<div class="flex flex-col gap-4">
<div class="aspect-square bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700">
<div id="main-image" class="w-full h-full bg-center bg-no-repeat bg-cover transition-all duration-300" data-alt="{{ $product->name }}" style='background-image: url("{{ $product->image ? asset("storage/" . $product->image) : 'https://placehold.co/800x800?text=No+Image' }}");'>
</div>
</div>

@if($product->gallery && is_array($product->gallery) && count($product->gallery) > 0)
<div class="grid grid-cols-4 gap-4">
    @if($product->image)
    <div class="aspect-square rounded-lg border-2 border-transparent hover:border-primary overflow-hidden cursor-pointer transition-colors" onclick="document.getElementById('main-image').style.backgroundImage = 'url({{ asset('storage/' . $product->image) }})'">
        <div class="w-full h-full bg-center bg-no-repeat bg-cover" style='background-image: url("{{ asset('storage/' . $product->image) }}");'></div>
    </div>
    @endif
    @foreach($product->gallery as $galImage)
    <div class="aspect-square rounded-lg border-2 border-transparent hover:border-primary overflow-hidden cursor-pointer transition-colors" onclick="document.getElementById('main-image').style.backgroundImage = 'url({{ asset('storage/' . $galImage) }})'">
        <div class="w-full h-full bg-center bg-no-repeat bg-cover" style='background-image: url("{{ asset('storage/' . $galImage) }}");'></div>
    </div>
    @endforeach
</div>
@endif

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
<p class="text-3xl font-bold text-primary">{{ number_format($product->price, 0, ',', '.') }}₫</p>
<span class="flex items-center gap-1 {{ $product->stock_quantity > 0 ? 'text-emerald-600' : 'text-red-500' }} font-medium text-sm">
    <span class="material-symbols-outlined text-[18px]">check_circle</span> 
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
        <span class="material-symbols-outlined text-[18px] text-primary">label</span>
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
<a href="{{ route('cart.index') }}" class="flex-1 flex h-14 cursor-pointer items-center justify-center rounded-xl bg-primary text-white gap-2 text-base font-bold transition-all hover:bg-primary/90"><span class="material-symbols-outlined">shopping_cart</span> Thêm vào giỏ hàng</a>
<button class="flex h-14 px-6 cursor-pointer items-center justify-center rounded-xl border-2 border-primary text-primary bg-transparent font-bold transition-all hover:bg-primary/5">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<a href="{{ route('checkout.index') }}" class="w-full flex h-14 cursor-pointer items-center justify-center rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-base font-bold transition-all hover:opacity-90">Mua ngay</a>
</div>
<div class="flex items-center gap-6 mt-2 text-slate-500 text-sm">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-[20px]">local_shipping</span>
<span>Giao hàng miễn phí</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-[20px]">verified_user</span>
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
<a class="text-primary font-semibold hover:underline flex items-center gap-1" href="#">Xem tất cả <span class="material-symbols-outlined text-[18px]">chevron_right</span></a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
@forelse($relatedProducts as $related)
<a href="{{ route('products.show', $related) }}" class="group cursor-pointer block">
<div class="aspect-square rounded-xl overflow-hidden mb-4 bg-slate-200">
<div class="w-full h-full bg-center bg-no-repeat bg-cover group-hover:scale-105 transition-transform duration-300" data-alt="{{ $related->name }}" style='background-image: url("{{ $related->image ? asset('storage/' . $related->image) : 'https://placehold.co/400x400?text=No+Image' }}");'></div>
</div>
<h4 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">{{ $related->name }}</h4>
<p class="text-slate-500 text-sm">{{ number_format($related->price, 0, ',', '.') }}₫</p>
</a>
@empty
<div class="col-span-full text-slate-500">
    Không có sản phẩm liên quan.
</div>
@endforelse
</div>
</div>
</main>
@endsection
