@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
@section('content')
@php
    $categoryIcons = [
        'chuột' => 'fa-mouse',
        'bàn phím' => 'fa-keyboard',
        'tai nghe' => 'fa-headset',
        'loa' => 'fa-volume-high',
        'màn hình' => 'fa-desktop',
        'vga' => 'fa-microchip',
        'card' => 'fa-microchip',
        'mainboard' => 'fa-circuit-board',
        'ram' => 'fa-memory',
        'ssd' => 'fa-hard-drive',
        'hdd' => 'fa-hard-drive',
        'nguồn' => 'fa-plug',
        'case' => 'fa-box-open',
        'tản nhiệt' => 'fa-fan',
        'laptop' => 'fa-laptop',
        'camera' => 'fa-camera',
        'ghế' => 'fa-chair',
        'bàn' => 'fa-table',
        'phần mềm' => 'fa-compact-disc',
        'tay cầm' => 'fa-gamepad',
        'linh kiện' => 'fa-microchip'
    ];
@endphp
<style>
<style>
    /* 1. Typography & Text Effects */
    @keyframes gradient-text {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .gradient-tech-text {
        background: linear-gradient(90deg, #2badee, #a855f7, #2badee);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradient-text 3s linear infinite;
    }

    @keyframes glitch {
        0% { transform: translate(0); }
        20% { transform: translate(-2px, 2px); }
        40% { transform: translate(-2px, -2px); }
        60% { transform: translate(2px, 2px); }
        80% { transform: translate(2px, -2px); }
        100% { transform: translate(0); }
    }
    .glitch-hover:hover {
        animation: glitch 0.3s cubic-bezier(.25,.46,.45,.94) both infinite;
        text-shadow: 2px 0 #ff00c1, -2px 0 #00fff9;
    }

    /* 2. Background & Overlays */
    .blueprint-grid {
        background-image: 
            linear-gradient(rgba(43, 173, 238, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(43, 173, 238, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    @keyframes float-code {
        0% { transform: translateY(100%); opacity: 0; }
        50% { opacity: 0.5; }
        100% { transform: translateY(-100%); opacity: 0; }
    }
    .coding-string {
        position: absolute;
        font-family: monospace;
        font-size: 10px;
        color: rgba(43, 173, 238, 0.3);
        white-space: nowrap;
        pointer-events: none;
        animation: float-code 10s linear infinite;
    }

    /* 3. Interactive Buttons */
    .neon-glow-btn {
        position: relative;
        box-shadow: 0 0 15px rgba(43, 173, 238, 0.3);
        border: 1px solid rgba(43, 173, 238, 0.5);
        transition: all 0.3s ease;
    }
    .neon-glow-btn:hover {
        box-shadow: 0 0 30px rgba(43, 173, 238, 0.6);
        background: #2badee;
        border-color: #fff;
    }

    .glass-btn {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    .glass-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
    }

    /* Floating Flame Particles behind Hot Sale glass glassmorphism */
    @keyframes float-particle {
        0% {
            transform: translateY(110%) translateX(0) scale(0.5);
            opacity: 0;
        }
        20% {
            opacity: 0.6;
        }
        80% {
            opacity: 0.6;
        }
        100% {
            transform: translateY(-20%) translateX(var(--move-x, 20px)) scale(var(--scale, 1));
            opacity: 0;
        }
    }
    .flame-particle {
        position: absolute;
        bottom: 0;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(239, 68, 68, 0.35) 0%, rgba(249, 115, 22, 0.1) 50%, transparent 80%);
        pointer-events: none;
        animation: float-particle var(--duration, 8s) ease-in infinite;
        filter: blur(4px);
    }
</style>

<!-- Hero Banner Nâng Cấp -->
<section id="hero-parallax" class="relative h-[700px] lg:h-[800px] flex items-center overflow-hidden bg-slate-950 group">
    <!-- Nền ảnh với hiệu ứng Parallax -->
    <div id="hero-bg" class="absolute inset-0 z-0 transition-transform duration-300 ease-out">
        <img alt="Gaming Setup" class="w-full h-full object-cover opacity-50" src="{{ asset('images/hero-gaming.png') }}"/>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/60 to-transparent"></div>
        <div class="absolute inset-0 blueprint-grid"></div>
    </div>

    <!-- Hiệu ứng Coding Strings lơ lửng -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-10 opacity-20">
        <div class="coding-string" style="left: 10%; animation-delay: 0s;">01011010101101010101</div>
        <div class="coding-string" style="left: 20%; animation-delay: 3s;">SELECT * FROM gaming_gear</div>
        <div class="coding-string" style="left: 80%; animation-delay: 1s;">System.out.println("TechFlow");</div>
        <div class="coding-string" style="left: 90%; animation-delay: 5s;">connect_to_server(192.168.1.1)</div>
    </div>

    <!-- Nội dung trung tâm -->
    <div class="relative max-w-[1600px] mx-auto px-6 w-full z-20">
        <div id="hero-content" class="max-w-2xl transition-transform duration-500 ease-out">
            <div class="flex items-center gap-3 mb-8 animate-slide-up">
                <span class="w-12 h-[2px] bg-primary animate-pulse"></span>
                <span class="text-primary font-black uppercase tracking-[0.4em] text-xs">Phòng Game Của Bạn</span>
            </div>
            
            <h1 class="text-white text-6xl lg:text-8xl font-black uppercase tracking-tighter mb-8 leading-[0.9] animate-slide-up glitch-hover">
                Nâng Tầm <br/> Trải Nghiệm <br/> <span class="gradient-tech-text">Công Nghệ</span>
            </h1>
            
            <p class="text-slate-400 text-lg mb-12 max-w-lg leading-relaxed animate-slide-up" style="animation-delay: 0.1s">
                Khám phá hệ sinh thái linh kiện Gaming tối tân. Trải nghiệm hiệu suất vượt giới hạn với những công nghệ hàng đầu thế giới.
            </p>
            
            <div class="flex flex-wrap gap-6 animate-slide-up" style="animation-delay: 0.2s">
                <a href="{{ route('store.index') }}" class="neon-glow-btn px-10 py-5 bg-primary/20 text-white font-black uppercase text-sm tracking-widest rounded-xl overflow-hidden group">
                    <span class="relative z-10 flex items-center gap-2">
                        Mua Ngay <i class="fa-solid fa-bolt text-amber-400"></i>
                    </span>
                </a>
                <a href="#featured" class="glass-btn px-10 py-5 text-white font-black uppercase text-sm tracking-widest rounded-xl">
                    Tìm Hiểu Thêm
                </a>
            </div>
        </div>
    </div>

    <!-- HUD Info góc dưới -->
    <div class="absolute bottom-10 left-10 z-30 hidden md:flex items-center gap-12 animate-fade-in opacity-60 hover:opacity-100 transition-opacity" style="animation-delay: 0.5s">
        <div class="flex flex-col gap-1 border-l-2 border-primary pl-4">
            <span class="text-[9px] text-slate-500 font-black uppercase tracking-widest">Trạng thái hệ thống</span>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-ping"></div>
                <span class="text-white font-mono text-[11px]">ACTIVE_ENCRYPTED</span>
            </div>
        </div>
        <div class="flex flex-col gap-1 border-l-2 border-slate-700 pl-4">
            <span class="text-[9px] text-slate-500 font-black uppercase tracking-widest">Dữ liệu truyền tải</span>
            <span class="text-white font-mono text-[11px]">10.4 Gbps</span>
        </div>
    </div>
</section>

<script>
    // Mouse Parallax Effect
    document.addEventListener('mousemove', (e) => {
        const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
        const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
        
        const bg = document.getElementById('hero-bg');
        const content = document.getElementById('hero-content');
        
        if (bg) {
            bg.style.transform = `translate(${moveX * -1}px, ${moveY * -1}px) scale(1.05)`;
        }
        if (content) {
            content.style.transform = `translate(${moveX}px, ${moveY}px)`;
        }
    });
</script>



<!-- Deal Hot Every Day -->
@if($flashSales->count() > 0)
<section class="py-12 bg-gradient-to-b from-[#0c4a6e] via-[#2badee] to-white transition-all duration-700 reveal-on-scroll px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1600px] mx-auto bg-white/40 dark:bg-slate-950/40 backdrop-blur-xl border border-white/20 dark:border-slate-800/30 rounded-2xl shadow-[0_20px_50px_rgba(239,68,68,0.15)] mb-[22px] relative overflow-hidden">
        <!-- Ambient 3D Neon Glow Spots -->
        <div class="absolute -left-20 -top-20 w-80 h-80 bg-red-500/20 dark:bg-red-500/10 rounded-full blur-3xl pointer-events-none z-0"></div>
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-orange-500/20 dark:bg-orange-500/10 rounded-full blur-3xl pointer-events-none z-0"></div>

        <!-- Floating Flame Particles -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
            <div class="flame-particle" style="left: 10%; --duration: 6s; --move-x: 30px; --scale: 0.6; animation-delay: 0s; width: 32px; height: 32px;"></div>
            <div class="flame-particle" style="left: 25%; --duration: 8s; --move-x: -40px; --scale: 0.5; animation-delay: 1s; width: 48px; height: 48px;"></div>
            <div class="flame-particle" style="left: 40%; --duration: 5s; --move-x: 20px; --scale: 0.8; animation-delay: 3s; width: 24px; height: 24px;"></div>
            <div class="flame-particle" style="left: 55%; --duration: 9s; --move-x: -30px; --scale: 0.4; animation-delay: 2s; width: 40px; height: 40px;"></div>
            <div class="flame-particle" style="left: 70%; --duration: 7s; --move-x: 40px; --scale: 0.6; animation-delay: 4s; width: 56px; height: 56px;"></div>
            <div class="flame-particle" style="left: 85%; --duration: 6s; --move-x: -20px; --scale: 0.7; animation-delay: 0.5s; width: 32px; height: 32px;"></div>
            <div class="flame-particle" style="left: 15%; --duration: 9s; --move-x: 50px; --scale: 0.5; animation-delay: 5s; width: 48px; height: 48px;"></div>
            <div class="flame-particle" style="left: 65%; --duration: 7.5s; --move-x: -35px; --scale: 0.7; animation-delay: 1.5s; width: 40px; height: 40px;"></div>
            <div class="flame-particle" style="left: 92%; --duration: 6.5s; --move-x: 25px; --scale: 0.6; animation-delay: 3.5s; width: 32px; height: 32px;"></div>
        </div>

        <!-- Section Header -->
        <div class="flex items-center justify-between pr-6 bg-transparent border-none outline-none relative z-10">
            <div class="flex">
                <h2 class="relative flex items-center h-14 bg-gradient-to-r from-red-500 to-red-600 pr-12 pl-6 text-white font-bold uppercase text-lg tracking-wider" style="clip-path: polygon(0 0, 100% 0, calc(100% - 20px) 100%, 0 100%);">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-fire-flame-curved text-lg animate-pulse"></i>
                        <span class="tracking-widest font-black text-xl">HOT SALE</span>
                    </div>
                </h2>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Navigation -->
                <div class="hidden md:flex gap-1.5">
                    <button onclick="document.getElementById('deal-hot-slider').scrollBy({left: -320, behavior: 'smooth'})" class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-all shadow-sm">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    <button onclick="document.getElementById('deal-hot-slider').scrollBy({left: 320, behavior: 'smooth'})" class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-all shadow-sm">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="p-6 relative z-10">
            <div id="deal-hot-slider" class="flex gap-3 overflow-x-auto snap-x snap-mandatory pb-2 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                @foreach($flashSales as $product)
                <div class="shrink-0 snap-start w-[260px] sm:w-[calc((100%-12px)/2)] md:w-[calc((100%-24px)/3)] lg:w-[calc((100%-36px)/4)] xl:w-[calc((100%-48px)/5)] 2xl:w-[calc((100%-60px)/6)] bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-800 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col h-[400px] relative product-card">
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

                    <!-- Image Area: 240px -->
                    <div class="h-[240px] bg-white relative overflow-hidden shrink-0 rounded-t-xl product-trigger">
                        <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-full">
                            <img loading="lazy" alt="{{ $product->name }}" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-700" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                        </a>
                    </div>

                    <!-- Info Area -->
                    <div class="product-card-body border-t border-slate-50 dark:border-slate-800">
                        <!-- Block 1: Name (max 40px) -->
                        <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block product-card-title">
                            <h3 class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $product->name }}</h3>
                        </a>
                        
                        <!-- Block 2: Price (max 46px) -->
                        <div class="product-card-price-row">
                            <div class="flex flex-col justify-center h-full">
                                @if($product->sale_price)
                                    <span class="text-primary !font-bold product-card-sale-price">{{ number_format($product->sale_price, 0, ',', '.') }} VNĐ</span>
                                    <span class="product-card-original-price text-slate-400 font-bold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @else
                                    <span class="text-primary !font-bold product-card-sale-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </div>
                            @if($product->sale_price)
                                <div class="bg-red-500 text-white product-card-discount-badge whitespace-nowrap shrink-0">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </div>
                            @endif
                        </div>

                        <!-- Block 3: Action (max 26px) - Synchronized with standard cards -->
                        <div class="product-card-action-row">
                            <button type="button" onclick="handleAddToCart({{ $product->id }}, {{ json_encode($product->colors) }}, '{{ addslashes($product->name) }}', {{ $product->sale_price ?: $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}')" class="product-card-btn dark:bg-slate-700/50 hover:shadow-md">
                                <div class="absolute left-0 top-0 w-[1.85em] h-[1.85em] bg-primary rounded-full transition-all duration-300 ease-in-out z-0"></div>
                                <div class="relative z-10 flex items-center gap-[0.28em] h-full">
                                    <div class="product-card-btn-icon-wrapper text-white">
                                        <i class="fa-solid fa-cart-shopping text-[0.857em]"></i>
                                    </div>
                                    <span class="product-card-btn-text text-slate-800 dark:text-slate-200 transition-colors duration-300">Thêm vào giỏ</span>
                                </div>
                            </button>
                            <div class="product-card-stock-badge bg-emerald-50 text-emerald-500 border border-emerald-200 dark:bg-emerald-950/20 dark:border-emerald-800">
                                Còn hàng
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- See All Deal Hot Button -->
            <div class="flex justify-center mt-6 relative z-10">
                <a href="{{ route('hot-sale') }}" class="group relative flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-red-400 to-red-600 text-white !font-bold text-sm rounded-full shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 overflow-hidden">
                    <!-- Shine Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>
                    <span class="relative z-10">Xem tất cả</span>
                    <i class="fa-solid fa-angles-right relative z-10 text-[10px] group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Featured Products -->
<section id="featured" class="pb-4 pt-16 reveal-on-scroll px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1600px] mx-auto bg-white dark:bg-slate-900 rounded-2xl shadow-sm mb-[22px] relative overflow-hidden">
        <!-- Section Header -->
        <div class="flex items-center justify-between pr-6 bg-white dark:bg-slate-900 border-none outline-none">
            <div class="flex">
                <h2 class="relative flex items-center h-14 bg-gradient-to-r from-sky-400 to-blue-700 pr-12 pl-6 text-white font-bold uppercase text-lg tracking-wider" style="clip-path: polygon(0 0, 100% 0, calc(100% - 20px) 100%, 0 100%);">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-star text-lg animate-pulse"></i>
                        <span class="tracking-widest font-black text-xl">SẢN PHẨM NỔI BẬT</span>
                    </div>
                </h2>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Navigation -->
                <div class="hidden md:flex gap-1.5">
                    <button onclick="document.getElementById('featured-slider').scrollBy({left: -320, behavior: 'smooth'})" class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-all shadow-sm">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    <button onclick="document.getElementById('featured-slider').scrollBy({left: 320, behavior: 'smooth'})" class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary transition-all shadow-sm">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div id="featured-slider" class="flex gap-3 overflow-x-auto snap-x snap-mandatory pb-2 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                @forelse($featuredProducts as $product)
                <div class="shrink-0 snap-start w-[260px] sm:w-[calc((100%-12px)/2)] md:w-[calc((100%-24px)/3)] lg:w-[calc((100%-36px)/4)] xl:w-[calc((100%-48px)/5)] 2xl:w-[calc((100%-60px)/6)] bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-800 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col h-[400px] relative product-card">
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
                            <img loading="lazy" alt="{{ $product->name }}" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-700" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                        </a>
                    </div>

                    <!-- Info Area -->
                    <div class="product-card-body border-t border-slate-50 dark:border-slate-800">
                        <!-- Block 1: Name (max 40px) -->
                        <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block product-card-title">
                            <h3 class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $product->name }}</h3>
                        </a>
                        
                        <!-- Block 2: Price (max 46px) -->
                        <div class="product-card-price-row">
                            <div class="flex flex-col justify-center h-full">
                                @if($product->sale_price)
                                    <span class="text-primary !font-bold product-card-sale-price">{{ number_format($product->sale_price, 0, ',', '.') }} VNĐ</span>
                                    <span class="product-card-original-price text-slate-400 font-bold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @else
                                    <span class="text-primary !font-bold product-card-sale-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </div>
                            @if($product->sale_price)
                                <div class="bg-red-500 text-white product-card-discount-badge whitespace-nowrap shrink-0">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </div>
                            @endif
                        </div>

                        <!-- Block 3: Action (max 26px) -->
                        <div class="product-card-action-row">
                            <button type="button" onclick="handleAddToCart({{ $product->id }}, {{ json_encode($product->colors) }}, '{{ addslashes($product->name) }}', {{ $product->sale_price ?: $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}')" class="product-card-btn dark:bg-slate-700/50 hover:shadow-md">
                                <div class="absolute left-0 top-0 w-[1.85em] h-[1.85em] bg-primary rounded-full transition-all duration-300 ease-in-out z-0"></div>
                                <div class="relative z-10 flex items-center gap-[0.28em] h-full">
                                    <div class="product-card-btn-icon-wrapper text-white">
                                        <i class="fa-solid fa-cart-shopping text-[0.857em]"></i>
                                    </div>
                                    <span class="product-card-btn-text text-slate-800 dark:text-slate-200 transition-colors duration-300">Thêm vào giỏ</span>
                                </div>
                            </button>
                            <div class="product-card-stock-badge bg-emerald-50 text-emerald-500 border border-emerald-200 dark:bg-emerald-950/20 dark:border-emerald-800">
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
            
            <!-- See All Featured Products Button -->
            <div class="flex justify-center mt-6 relative z-10">
                <a href="{{ route('featured.products') }}" class="group relative flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-sky-400 to-blue-700 text-white !font-bold text-sm rounded-full shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 overflow-hidden">
                    <!-- Shine Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>
                    <span class="relative z-10">Xem tất cả</span>
                    <i class="fa-solid fa-angles-right relative z-10 text-[10px] group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Dynamic Category Sections -->
@foreach($categoryProducts as $catData)
@php $catSection = $catData['category']; $catProducts = $catData['products']; @endphp
<section class="py-4 reveal-on-scroll px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1600px] mx-auto bg-white dark:bg-slate-900 rounded-2xl shadow-sm mb-[22px] relative overflow-hidden">
        <!-- Section Header -->
        <div class="flex items-center justify-between pr-6 bg-white dark:bg-slate-900 border-none outline-none">
            <div class="flex">
                @php
                    $iconClass = 'fa-microchip';
                    foreach($categoryIcons as $keyword => $icon) {
                        if (str_contains(mb_strtolower($catSection->name), $keyword)) {
                            $iconClass = $icon;
                            break;
                        }
                    }
                @endphp
                <h2 class="relative flex items-center h-14 bg-gradient-to-r from-sky-400 to-blue-700 pr-12 pl-6 text-white font-bold uppercase text-lg tracking-wider" style="clip-path: polygon(0 0, 100% 0, calc(100% - 20px) 100%, 0 100%);">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid {{ $iconClass }} text-lg animate-pulse"></i>
                        <span class="tracking-widest font-black text-xl">{{ $catSection->name }}</span>
                    </div>
                </h2>
            </div>
            <div class="flex items-center pr-2">
                <a href="{{ route('store.category', $catSection->slug) }}" class="group relative flex items-center gap-2 px-5 py-1.5 bg-gradient-to-r from-sky-400 to-blue-700 text-white !font-bold text-xs rounded-full shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 overflow-hidden">
                    <!-- Shine Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>
                    <span class="relative z-10">Xem tất cả</span>
                    <i class="fa-solid fa-angles-right text-[10px] relative z-10"></i>
                </a>
            </div>
        </div>
        
        <div class="p-6">
            <div class="flex gap-3 overflow-x-auto snap-x snap-mandatory pb-2 scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                @foreach($catProducts as $product)
                <div class="shrink-0 snap-start w-[260px] sm:w-[calc((100%-12px)/2)] md:w-[calc((100%-24px)/3)] lg:w-[calc((100%-36px)/4)] xl:w-[calc((100%-48px)/5)] 2xl:w-[calc((100%-60px)/6)] bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-800 hover:z-[50] group hover:shadow-2xl transition-all duration-300 flex flex-col h-[400px] relative product-card">
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
                            <img loading="lazy" alt="{{ $product->name }}" class="w-full h-full object-contain p-6 group-hover:scale-110 transition-transform duration-700" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}" onerror="this.onerror=null; this.src='https://placehold.co/400x400?text=No+Image';"/>
                        </a>
                    </div>
                    <div class="product-card-body border-t border-slate-50 dark:border-slate-800">
                        <!-- Block 1: Name (max 40px) -->
                        <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block product-card-title">
                            <h3 class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-primary transition-colors line-clamp-2 overflow-hidden">{{ $product->name }}</h3>
                        </a>
                        
                        <!-- Block 2: Price (max 46px) -->
                        <div class="product-card-price-row">
                            <div class="flex flex-col justify-center h-full">
                                @if($product->sale_price)
                                    <span class="text-primary !font-bold product-card-sale-price">{{ number_format($product->sale_price, 0, ',', '.') }} VNĐ</span>
                                    <span class="product-card-original-price text-slate-400 font-bold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @else
                                    <span class="text-primary !font-bold product-card-sale-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </div>
                            @if($product->sale_price)
                                <div class="bg-red-500 text-white product-card-discount-badge whitespace-nowrap shrink-0">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </div>
                            @endif
                        </div>

                        <!-- Block 3: Action (max 26px) -->
                        <div class="product-card-action-row">
                            <button type="button" onclick="handleAddToCart({{ $product->id }}, {{ json_encode($product->colors) }}, '{{ addslashes($product->name) }}', {{ $product->sale_price ?: $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400?text=No+Image' }}')" class="product-card-btn dark:bg-slate-700/50 hover:shadow-md">
                                <div class="absolute left-0 top-0 w-[1.85em] h-[1.85em] bg-primary rounded-full transition-all duration-300 ease-in-out z-0"></div>
                                <div class="relative z-10 flex items-center gap-[0.28em] h-full">
                                    <div class="product-card-btn-icon-wrapper text-white">
                                        <i class="fa-solid fa-cart-shopping text-[0.857em]"></i>
                                    </div>
                                    <span class="product-card-btn-text text-slate-800 dark:text-slate-200 transition-colors duration-300">Thêm vào giỏ</span>
                                </div>
                            </button>
                            <div class="product-card-stock-badge bg-emerald-50 text-emerald-500 border border-emerald-200 dark:bg-emerald-950/20 dark:border-emerald-800">
                                Còn hàng
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endforeach


<!-- USP Section -->
<section class="pt-0 pb-8 bg-slate-50/50 dark:bg-slate-900/50 overflow-hidden">
    <div class="max-w-[1500px] mx-auto px-10">
        <div class="bg-white dark:bg-slate-800 shadow-[0_15px_50px_-15px_rgba(0,0,0,0.1)] py-8 px-8 md:px-20 -skew-x-6 border border-slate-100 dark:border-slate-700 relative group transition-all duration-700 hover:shadow-primary/5">
            <div class="skew-x-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
                <!-- Giao hàng -->
                <div class="flex flex-col items-center text-center group/item">
                    <div class="w-16 h-16 flex items-center justify-center mb-4 transition-transform duration-500 group-hover/item:-translate-y-2">
                        <i class="fa-solid fa-truck-fast text-4xl text-primary drop-shadow-[0_5px_10px_rgba(239,68,68,0.2)]"></i>
                    </div>
                    <div class="text-[13px] font-black uppercase tracking-tighter text-slate-900 dark:text-slate-100 leading-tight mb-2">Giao hàng toàn quốc</div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Giao hàng trước, trả tiền sau COD</div>
                </div>

                <!-- Đổi trả -->
                <div class="flex flex-col items-center text-center group/item">
                    <div class="w-16 h-16 flex items-center justify-center mb-4 transition-transform duration-500 group-hover/item:-translate-y-2">
                        <i class="fa-solid fa-box-open text-4xl text-primary drop-shadow-[0_5px_10px_rgba(239,68,68,0.2)]"></i>
                    </div>
                    <div class="text-[13px] font-black uppercase tracking-tighter text-slate-900 dark:text-slate-100 leading-tight mb-2">Đổi trả dễ dàng</div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Đổi mới trong 30 ngày đầu</div>
                </div>

                <!-- Thanh toán -->
                <div class="flex flex-col items-center text-center group/item">
                    <div class="w-16 h-16 flex items-center justify-center mb-4 transition-transform duration-500 group-hover/item:-translate-y-2">
                        <i class="fa-solid fa-credit-card text-4xl text-primary drop-shadow-[0_5px_10px_rgba(239,68,68,0.2)]"></i>
                    </div>
                    <div class="text-[13px] font-black uppercase tracking-tighter text-slate-900 dark:text-slate-100 leading-tight mb-2">Thanh toán tiện lợi</div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Trả tiền mặt, chuyển khoản, trả góp 0%</div>
                </div>

                <!-- Hỗ trợ -->
                <div class="flex flex-col items-center text-center group/item">
                    <div class="w-16 h-16 flex items-center justify-center mb-4 transition-transform duration-500 group-hover/item:-translate-y-2">
                        <i class="fa-solid fa-headset text-4xl text-primary drop-shadow-[0_5px_10px_rgba(239,68,68,0.2)]"></i>
                    </div>
                    <div class="text-[13px] font-black uppercase tracking-tighter text-slate-900 dark:text-slate-100 leading-tight mb-2">Hỗ trợ nhiệt tình</div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Tư vấn tổng đài miễn phí 24/7</div>
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
