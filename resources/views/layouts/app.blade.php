<!DOCTYPE html>
<html lang="vi" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang chủ') - TechFlow</title>

    <!-- Favicon / Brand Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-weblinhkien-nho.png') }}">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Stitch Tailwind Configuration -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-container": "#fef3c7", "outline-variant": "#e2e8f0", "on-surface": "#0f172a",
                        "on-error-container": "#991b1b", "tertiary-fixed": "#fecaca", "tertiary-container": "#fee2e2",
                        "inverse-surface": "#1e293b", "secondary-fixed": "#fde68a", "on-secondary-fixed": "#78350f",
                        "secondary": "#f39c12", "on-tertiary-fixed": "#7f1d1d", "on-secondary": "#ffffff",
                        "on-primary-fixed": "#0c4a6e", "tertiary": "#ef4444", "surface-variant": "#f1f5f9",
                        "on-surface-variant": "#475569", "outline": "#cbd5e1", "surface-dim": "#d6dae0",
                        "surface-container-highest": "#e2e8f0", "surface-bright": "#ffffff", "on-tertiary-fixed-variant": "#b91c1c",
                        "surface-container-lowest": "#ffffff", "on-secondary-container": "#b45309", "primary-fixed-dim": "#7dd3fc",
                        "primary": "#2badee", "on-primary-container": "#0369a1", "on-error": "#ffffff",
                        "on-secondary-fixed-variant": "#b45309", "background": "#f6f7f8", "on-tertiary": "#ffffff",
                        "error": "#dc2626", "surface-container-low": "#f6f7f8", "on-primary-fixed-variant": "#0369a1",
                        "surface-tint": "#2badee", "surface-container-high": "#f1f5f9", "inverse-on-surface": "#f8fafc",
                        "surface": "#f6f7f8", "primary-fixed": "#bae6fd", "secondary-fixed-dim": "#fbbf24",
                        "error-container": "#fef2f2", "on-primary": "#ffffff", "primary-container": "#e0f2fe",
                        "surface-container": "#ffffff", "on-background": "#0f172a", "tertiary-fixed-dim": "#f87171",
                        "on-tertiary-container": "#991b1b", "inverse-primary": "#7dd3fc"
                    },
                    fontFamily: {
                        "sans": ["'Be Vietnam Pro'", "sans-serif"],
                        "display": ["'Be Vietnam Pro'", "sans-serif"],
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                },
            },
        }
    </script>


    <!-- Tailwind CSS (Vite via App) and configuration fallback -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body,
        a,
        p,
        span,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        li,
        button,
        input,
        select,
        textarea,
        label {
            font-family: 'Be Vietnam Pro', sans-serif !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700 !important;
        }

        button,
        .btn,
        [type="button"],
        [type="submit"] {
            font-weight: 600 !important;
        }

        body,
        a,
        p,
        span,
        li,
        input,
        select,
        textarea,
        label {
            font-weight: 400 !important;
        }

        .slash-header::before {
            content: "";
            display: inline-block;
            width: 4px;
            height: 24px;
            background-color: #2badee;
            transform: skewX(-20deg);
            margin-right: 12px;
            vertical-align: middle;
        }

        .blueprint-grid {
            background-image: radial-gradient(circle, #e2e8f0 1px, transparent 1px);
            background-size: 32px 32px;
        }

        @keyframes slide-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up {
            animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }

        @keyframes bounce-subtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-bounce-subtle {
            animation: bounce-subtle 2s infinite ease-in-out;
        }

        /* Compact Header Styles */
        header {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .header-compact #top-row {
            height: 0;
            opacity: 0;
            overflow: hidden;
            border-bottom-width: 0;
        }

        .header-compact #bottom-row {
            height: 80px;
            overflow: visible !important;
        }

        .header-compact #compact-content {
            display: flex;
            overflow: visible !important;
        }

        .header-compact #normal-bottom-content {
            display: none;
        }
    </style>
</head>

<body class="bg-background dark:bg-slate-900 text-on-surface dark:text-slate-100 antialiased font-sans">

    <!-- Color Selection Modal -->
    <div id="colorSelectionModal" class="fixed inset-0 z-[10000] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeColorModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md px-4">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-800 animate-in fade-in zoom-in duration-300">
                <!-- Header -->
                <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/50">
                    <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-tight">Chọn màu sắc</h3>
                    <button onclick="closeColorModal()" class="h-8 w-8 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                <!-- Body -->
                <div class="p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-2xl p-2 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                            <img id="modalProductImage" src="" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h4 id="modalProductName" class="font-bold text-slate-900 dark:text-white line-clamp-2 leading-tight">...</h4>
                            <p id="modalProductPrice" class="text-primary font-black mt-1">...</p>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Màu sắc khả dụng</label>
                        <div id="modalColorOptions" class="flex flex-wrap gap-3">
                            <!-- Options injected here -->
                        </div>
                    </div>
                    
                    <button id="confirmColorBtn" class="w-full py-4 bg-primary hover:bg-primary/90 text-white font-black rounded-2xl transition-all shadow-lg shadow-primary/20 uppercase tracking-widest text-xs">
                        <i class="fa-solid fa-cart-shopping mr-2"></i> Xác nhận & Thêm vào giỏ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Top NavBar from Stitch -->
    <!-- Header Section -->
    <header id="main-header"
        class="fixed top-0 w-full z-[1000] bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 shadow-sm antialiased">
        <!-- Top Row -->
        <div id="top-row" class="h-[90px] border-b border-slate-100 dark:border-slate-800 transition-all duration-300">
            <div class="max-w-[1600px] mx-auto h-full px-4 flex items-center justify-between gap-8">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="shrink-0 flex items-center">
                    <img src="{{ asset('images/logo-weblinhkien-Photoroom.png') }}" alt="TechFlow Logo"
                        class="w-[200px] h-[71px] object-contain">
                </a>

                <!-- Search Bar: 720px -->
                <div class="hidden lg:flex flex-1 max-w-[720px] relative items-center">
                    <form action="{{ route('store.index') }}" method="GET" class="w-full relative" id="search-form">
                        <input name="search" id="search-input" value="{{ request('search') }}" autocomplete="off"
                            class="w-full bg-slate-100 dark:bg-slate-800 border-none rounded-full py-3.5 pl-6 pr-14 focus:ring-2 focus:ring-primary text-sm outline-none dark:text-white shadow-inner"
                            placeholder="Bạn cần tìm linh kiện gì?" type="text" />
                        <button type="submit"
                            class="absolute right-1 top-1/2 -translate-y-1/2 w-11 h-11 bg-primary text-white rounded-full flex items-center justify-center hover:bg-primary/90 transition-colors">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </button>
                    </form>

                    <!-- Search Suggestions Dropdown -->
                    <div id="search-suggestions" class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden hidden z-[1100]">
                        <div class="max-h-[480px] overflow-y-auto" id="suggestion-results">
                            <!-- Results injected here -->
                        </div>
                        <div id="view-all-container" class="p-3 bg-slate-50 dark:bg-slate-800 border-t border-slate-100 dark:border-slate-700 text-center hidden">
                            <a href="#" id="view-all-link" class="text-sm font-bold text-primary hover:underline">
                                Xem tất cả kết quả cho "<span id="search-query-display"></span>"
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Actions Side -->
                <div class="flex items-center gap-6">
                    <!-- Phone Contact -->
                    <a href="tel:0329346849" class="hidden xl:flex items-center gap-3 group">
                        <div
                            class="w-11 h-11 bg-primary/10 text-primary rounded-full flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-phone text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[11px] font-bold text-slate-400 uppercase leading-none mb-1">Liên hệ
                                ngay</span>
                            <span class="text-sm font-black text-slate-900 dark:text-white">0329346849</span>
                        </div>
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}"
                        class="relative w-11 h-11 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-cart-shopping text-sm"></i>
                        <span id="cart-count"
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white dark:border-slate-900">{{ count(session('cart', [])) }}</span>
                    </a>

                    <!-- User Account -->
                    @guest
                        <a href="{{ route('custom.login') }}"
                            class="flex items-center gap-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors group">
                            <div
                                class="w-11 h-11 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <div class="hidden sm:flex flex-col">
                                <span class="text-[10px] font-bold text-slate-400 uppercase leading-none">Tài khoản</span>
                                <span class="text-xs font-bold text-slate-900 dark:text-white">Đăng nhập</span>
                            </div>
                        </a>
                    @else
                        <div class="relative group">
                            <button
                                class="flex items-center gap-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors focus:outline-none">
                                <div
                                    class="w-11 h-11 bg-primary/10 text-primary rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-user text-sm"></i>
                                </div>
                                <div class="hidden sm:flex flex-col items-start">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase leading-none">Xin
                                        chào</span>
                                    <span
                                        class="text-xs font-bold text-slate-900 dark:text-white line-clamp-1 max-w-[100px]">{{ Auth::user()->name }}</span>
                                </div>
                            </button>
                            <div
                                class="absolute right-0 top-full mt-2 w-56 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 overflow-hidden transform translate-y-2 group-hover:translate-y-0">
                                <div
                                    class="px-5 py-4 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-600">
                                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">Quản lý tài khoản</p>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white truncate">
                                        {{ Auth::user()->email }}</p>
                                </div>
                                <div class="p-2">
                                    <a href="{{ route('profile.index') }}"
                                        class="flex items-center gap-3 px-3 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-primary hover:text-white rounded-lg transition-colors group">
                                        <i class="fa-solid fa-id-card text-slate-400 group-hover:text-white"></i> Hồ sơ của
                                        tôi
                                    </a>
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="flex items-center gap-3 px-3 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-primary hover:text-white rounded-lg transition-colors group">
                                            <i class="fa-solid fa-gauge text-slate-400 group-hover:text-white"></i> Trang quản
                                            trị
                                        </a>
                                    @endif
                                    <a href="{{ route('order.tracking') }}"
                                        class="flex items-center gap-3 px-3 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-primary hover:text-white rounded-lg transition-colors group">
                                        <i class="fa-solid fa-box text-slate-400 group-hover:text-white"></i> Đơn hàng của
                                        tôi
                                    </a>
                                </div>
                                <form method="POST" action="{{ route('logout') }}"
                                    class="m-0 border-t border-slate-100 dark:border-slate-700 p-2">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg font-bold transition-colors">
                                        <i class="fa-solid fa-right-from-bracket text-red-400"></i> Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>

        @php
            $categoryIcons = [
                'bàn phím' => 'fa-keyboard',
                'chuột' => 'fa-mouse',
                'loa' => 'fa-volume-high',
                'tai nghe' => 'fa-headphones',
                'màn hình' => 'fa-desktop',
                'webcam' => 'fa-video',
                'microphone' => 'fa-microphone',
            ];
        @endphp

        <!-- Bottom Row -->
        <div id="bottom-row"
            class="h-[60px] bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 hidden md:block transition-all duration-300">
            <div class="max-w-[1600px] mx-auto h-full px-4 flex items-center">
                
                <!-- Compact Content (Matches Full Design Styling) -->
                <div id="compact-content" class="hidden w-full items-center justify-between gap-4">
                    <!-- Compact Category -->
                    <div class="relative group">
                        <a href="{{ route('store.index') }}"
                            class="h-[48px] flex items-center gap-3 px-6 bg-primary text-white font-semibold uppercase text-[14px] tracking-widest hover:bg-primary/90 transition-all rounded-xl focus:outline-none" style="font-size:14px !important; font-weight:600 !important">
                            <i class="fa-solid fa-bars text-sm group-hover:rotate-90 transition-transform"></i>
                            <span class="whitespace-nowrap">Danh mục sản phẩm</span>
                        </a>
                        
                        <!-- Dropdown Menu (Full Version with Flyouts) -->
                        <div
                            class="absolute top-full left-0 w-72 bg-white dark:bg-slate-900 shadow-2xl rounded-xl border border-slate-200 dark:border-slate-800 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[2000] transform translate-y-2 group-hover:translate-y-0">
                            @foreach($globalCategories as $cat)
                                <div class="relative group/sub">
                                    <a href="{{ route('store.category', $cat->slug) }}"
                                        class="flex items-center justify-between px-5 py-3.5 text-[13px] font-bold text-slate-700 dark:text-slate-300 group-hover/sub:bg-primary group-hover/sub:text-white transition-all">
                                        <span class="flex items-center gap-3">
                                            @php
                                                $iconClass = 'fa-cube';
                                                foreach($categoryIcons as $keyword => $icon) {
                                                    if (str_contains(mb_strtolower($cat->name), $keyword)) {
                                                        $iconClass = $icon;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            <i class="fa-solid {{ $iconClass }} w-5 text-center text-slate-400 group-hover/sub:text-white"></i>
                                            {{ $cat->name }}
                                        </span>
                                        <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
                                    </a>

                                    <!-- Flyout Menu (Level 2 - Matches Full Header) -->
                                    <div
                                        class="absolute top-0 left-full ml-2 w-[550px] bg-white dark:bg-slate-900 shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl border border-slate-200 dark:border-slate-800 p-8 opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-300 z-[2001] flex gap-12 transform -translate-x-4 group-hover/sub:translate-x-0">
                                        <!-- Brands Section -->
                                        <div class="flex-1">
                                            <div class="mb-6 flex">
                                                <h4 class="relative bg-primary text-white text-[11px] font-black uppercase tracking-wider px-5 py-2.5 rounded-l-lg flex items-center gap-2 shadow-lg shadow-primary/20 after:content-[''] after:absolute after:left-full after:top-0 after:h-full after:w-4 after:bg-primary after:[clip-path:polygon(0_0,0_100%,100%_100%)]">
                                                    <i class="fa-solid fa-layer-group text-[10px] opacity-80"></i>
                                                    {{ $cat->name }} theo hãng
                                                </h4>
                                            </div>
                                            <div class="grid grid-cols-2 gap-x-6 gap-y-3">
                                                @php
                                                    $brandIds = $brandCategoryMap[$cat->id] ?? collect();
                                                    $catBrands = $globalBrands->whereIn('id', $brandIds);
                                                @endphp

                                                @forelse($catBrands as $brand)
                                                    <a href="{{ route('store.category', [$cat->slug, 'brands' => [$brand->id]]) }}"
                                                        class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-3 group/item">
                                                        <div
                                                            class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover/item:bg-primary transition-colors">
                                                        </div>
                                                        {{ $brand->name }}
                                                    </a>
                                                @empty
                                                    <div class="text-xs text-slate-400 italic py-2">Chưa có hãng nào</div>
                                                @endforelse
                                            </div>
                                        </div>

                                        <!-- Price Section -->
                                        <div class="w-56">
                                            <div class="mb-6 flex">
                                                <h4 class="relative bg-slate-800 dark:bg-slate-700 text-white text-[11px] font-black uppercase tracking-wider px-5 py-2.5 rounded-l-lg flex items-center gap-2 shadow-lg after:content-[''] after:absolute after:left-full after:top-0 after:h-full after:w-4 after:bg-slate-800 dark:after:bg-slate-700 after:[clip-path:polygon(0_0,0_100%,100%_100%)]">
                                                    <i class="fa-solid fa-tags text-[10px] opacity-80"></i>
                                                    Khoảng giá
                                                </h4>
                                            </div>
                                            <div class="flex flex-col gap-3">
                                                <a href="{{ route('store.category', [$cat->slug, 'min_price' => 0, 'max_price' => 1000000]) }}"
                                                    class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                    <i
                                                        class="fa-solid fa-tags text-[10px] opacity-0 group-hover/p:opacity-100 transition-all"></i>
                                                    Dưới 1 triệu
                                                </a>
                                                <a href="{{ route('store.category', [$cat->slug, 'min_price' => 1000000, 'max_price' => 3000000]) }}"
                                                    class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                    <i
                                                        class="fa-solid fa-tags text-[10px] opacity-0 group-hover/p:opacity-100 transition-all"></i>
                                                    1 triệu - 3 triệu
                                                </a>
                                                <a href="{{ route('store.category', [$cat->slug, 'min_price' => 3000000, 'max_price' => 4000000]) }}"
                                                    class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                    <i
                                                        class="fa-solid fa-tags text-[10px] opacity-0 group-hover/p:opacity-100 transition-all"></i>
                                                    3 triệu - 4 triệu
                                                </a>
                                                <a href="{{ route('store.category', [$cat->slug, 'min_price' => 4000000]) }}"
                                                    class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                    <i
                                                        class="fa-solid fa-tags text-[10px] opacity-0 group-hover/p:opacity-100 transition-all"></i>
                                                    Trên 4 triệu
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Compact Search (Exact copy of top row style) -->
                    <div class="flex-1 max-w-[720px] relative items-center">
                        <form action="{{ route('store.index') }}" method="GET" class="w-full relative">
                            <input name="search" id="search-input-compact" value="{{ request('search') }}" autocomplete="off"
                                class="w-full bg-slate-100 dark:bg-slate-800 border-none rounded-full py-3.5 pl-6 pr-14 focus:ring-2 focus:ring-primary text-sm outline-none dark:text-white shadow-inner"
                                placeholder="Bạn cần tìm linh kiện gì?" type="text" />
                            <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 w-11 h-11 bg-primary text-white rounded-full flex items-center justify-center hover:bg-primary/90 transition-colors">
                                <i class="fa-solid fa-magnifying-glass text-sm"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Compact Actions (Matches Top Row with Text) -->
                    <div class="flex items-center gap-4">
                        <!-- Phone -->
                        <a href="tel:0329346849" class="hidden xl:flex items-center gap-3 group">
                            <div class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-phone text-xs"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[9px] font-bold text-slate-400 uppercase leading-none mb-1">Liên hệ ngay</span>
                                <span class="text-xs font-black text-slate-900 dark:text-white">0329.346.849</span>
                            </div>
                        </a>

                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class="relative w-10 h-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-cart-shopping text-xs"></i>
                            <span id="cart-count-compact" class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-bold px-1 py-0.5 rounded-full border border-white">
                                {{ count(session('cart', [])) }}
                            </span>
                        </a>

                        <!-- User Account -->
                        @guest
                            <a href="{{ route('custom.login') }}"
                                class="flex items-center gap-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors group">
                                <div
                                    class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <i class="fa-solid fa-user text-xs"></i>
                                </div>
                                <div class="hidden lg:flex flex-col">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase leading-none">Tài khoản</span>
                                    <span class="text-xs font-bold text-slate-900 dark:text-white">Đăng nhập</span>
                                </div>
                            </a>
                        @else
                            <div class="relative group">
                                <button class="flex items-center gap-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors focus:outline-none">
                                    <div class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-user text-xs"></i>
                                    </div>
                                    <div class="hidden lg:flex flex-col items-start">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase leading-none">Xin chào</span>
                                        <span class="text-xs font-bold text-slate-900 dark:text-white line-clamp-1 max-w-[80px]">{{ Auth::user()->name }}</span>
                                    </div>
                                </button>
                            </div>
                        @endguest
                    </div>
                </div>

                <!-- Normal Bottom Content -->
                <div id="normal-bottom-content" class="w-full flex items-start gap-10">
                    <!-- Category Menu Container -->
                    <div class="relative group">
                    <!-- Category Menu Button (Link to Store) -->
                    <a href="{{ route('store.index') }}"
                        class="h-[48px] flex items-center gap-3 px-6 bg-primary text-white font-semibold uppercase text-[14px] tracking-widest hover:bg-primary/90 transition-all rounded-xl mb-[12px] focus:outline-none" style="font-size:14px !important; font-weight:600 !important">
                        <i class="fa-solid fa-bars text-sm group-hover:rotate-90 transition-transform"></i>
                        Danh mục sản phẩm
                    </a>

                    <!-- Dropdown Menu (Level 1) -->
                    <div
                        class="absolute top-[48px] left-0 w-72 bg-white dark:bg-slate-900 shadow-2xl rounded-xl border border-slate-200 dark:border-slate-800 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[100] transform translate-y-2 group-hover:translate-y-0">

                        @foreach($globalCategories as $cat)
                            <div class="relative group/sub">
                                <a href="{{ route('store.category', $cat->slug) }}"
                                    class="flex items-center justify-between px-5 py-3.5 text-[13px] font-bold text-slate-700 dark:text-slate-300 group-hover/sub:bg-primary group-hover/sub:text-white transition-all">
                                    <span class="flex items-center gap-3">
                                        @php
                                            $iconClass = 'fa-cube';
                                            foreach($categoryIcons as $keyword => $icon) {
                                                if (str_contains(mb_strtolower($cat->name), $keyword)) {
                                                    $iconClass = $icon;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <i class="fa-solid {{ $iconClass }} w-5 text-center text-slate-400 group-hover/sub:text-white"></i>
                                        {{ $cat->name }}
                                    </span>
                                    <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
                                </a>

                                <!-- Flyout Menu (Level 2 - Right Side) -->
                                <div
                                    class="absolute top-0 left-full ml-2 w-[550px] bg-white dark:bg-slate-900 shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl border border-slate-200 dark:border-slate-800 p-8 opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-300 z-[101] flex gap-12 transform -translate-x-4 group-hover/sub:translate-x-0">
                                    <!-- Brands Section -->
                                    <div class="flex-1">
                                        <div class="mb-6 flex">
                                            <h4 class="relative bg-primary text-white text-[11px] font-black uppercase tracking-wider px-5 py-2.5 rounded-l-lg flex items-center gap-2 shadow-lg shadow-primary/20 after:content-[''] after:absolute after:left-full after:top-0 after:h-full after:w-4 after:bg-primary after:[clip-path:polygon(0_0,0_100%,100%_100%)]">
                                                <i class="fa-solid fa-layer-group text-[10px] opacity-80"></i>
                                                {{ $cat->name }} theo hãng
                                            </h4>
                                        </div>
                                        <div class="grid grid-cols-2 gap-x-6 gap-y-3">
                                            @php
                                                $brandIds = $brandCategoryMap[$cat->id] ?? collect();
                                                $catBrands = $globalBrands->whereIn('id', $brandIds);
                                            @endphp

                                            @forelse($catBrands as $brand)
                                                <a href="{{ route('store.category', [$cat->slug, 'brands' => [$brand->id]]) }}"
                                                    class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-3 group/item">
                                                    <div
                                                        class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover/item:bg-primary transition-colors">
                                                    </div>
                                                    {{ $brand->name }}
                                                </a>
                                            @empty
                                                <div class="text-xs text-slate-400 italic py-2">Chưa có hãng nào</div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <!-- Price Section -->
                                    <div class="w-56">
                                        <div class="mb-6 flex">
                                            <h4 class="relative bg-slate-800 dark:bg-slate-700 text-white text-[11px] font-black uppercase tracking-wider px-5 py-2.5 rounded-l-lg flex items-center gap-2 shadow-lg after:content-[''] after:absolute after:left-full after:top-0 after:h-full after:w-4 after:bg-slate-800 dark:after:bg-slate-700 after:[clip-path:polygon(0_0,0_100%,100%_100%)]">
                                                <i class="fa-solid fa-tags text-[10px] opacity-80"></i>
                                                Khoảng giá
                                            </h4>
                                        </div>
                                        <div class="flex flex-col gap-3">
                                            <a href="{{ route('store.category', [$cat->slug, 'min_price' => 0, 'max_price' => 1000000]) }}"
                                                class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                <i
                                                    class="fa-solid fa-tags text-[10px] opacity-0 group-hover/p:opacity-100 transition-all"></i>
                                                Dưới 1 triệu
                                            </a>
                                            <a href="{{ route('store.category', [$cat->slug, 'min_price' => 1000000, 'max_price' => 3000000]) }}"
                                                class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                <i
                                                    class="fa-solid fa-tags text-[10px] opacity-0 group-hover/p:opacity-100 transition-all"></i>
                                                1 triệu - 3 triệu
                                            </a>
                                            <a href="{{ route('store.category', [$cat->slug, 'min_price' => 3000000, 'max_price' => 4000000]) }}"
                                                class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                <i
                                                    class="fa-solid fa-tags text-[10px] opacity-0 group-hover/p:opacity-100 transition-all"></i>
                                                3 triệu - 4 triệu
                                            </a>
                                            <a href="{{ route('store.category', [$cat->slug, 'min_price' => 4000000]) }}"
                                                class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                <i
                                                    class="fa-solid fa-tags text-[10px] opacity-0 group-hover/p:opacity-100 transition-all"></i>
                                                Trên 4 triệu
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Category Links -->
                <div class="flex items-center gap-8 h-[48px]">
                    @foreach($globalCategories as $navCat)
                        @php
                            $navIconClass = 'fa-cube';
                            foreach($categoryIcons as $keyword => $icon) {
                                if (str_contains(mb_strtolower($navCat->name), $keyword)) {
                                    $navIconClass = $icon;
                                    break;
                                }
                            }
                        @endphp
                        <a href="{{ route('store.category', $navCat->slug) }}"
                            class="text-[14px] font-semibold uppercase tracking-widest text-slate-600 dark:text-slate-400 hover:text-primary transition-colors flex items-center gap-2" style="font-size:14px !important; font-weight:600 !important">
                            <i class="fa-solid {{ $navIconClass }} text-sm opacity-50"></i> {{ $navCat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    <script>
        // Sticky Header Logic
        window.addEventListener('scroll', function() {
            const header = document.getElementById('main-header');
            const scrollThreshold = 100;
            if (window.scrollY > scrollThreshold) {
                header.classList.add('header-compact');
            } else {
                header.classList.remove('header-compact');
            }
        });
    </script>


    <!-- Main Content -->
    <main class="min-h-screen pt-[150px] md:pt-[150px]">
        <div class="{{ request()->routeIs('home') ? '' : 'px-4 pb-16' }}">
            @yield('content')
        </div>
    </main>

    <!-- Footer from Stitch -->
    <footer class="bg-slate-50 dark:bg-slate-950 w-full pt-16 pb-8 font-sans text-sm">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 px-6 lg:px-12 max-w-[1400px] mx-auto">
            <div>
                <div class="mb-6 flex items-center">
                    <img src="{{ asset('images/logo-weblinhkien-Photoroom.png') }}" alt="TechFlow Logo"
                        class="w-[200px] h-[71px] object-contain">
                </div>
                <div class="text-slate-500 dark:text-slate-400 text-[13px] leading-relaxed space-y-2">
                    <p class="font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide text-xs">Về TechFlow</p>
                    <p>TECHFLOW là đơn vị chuyên cung cấp Bàn phím, Chuột, Tai nghe và các sản phẩm linh kiện máy tính giá tốt nhất thị trường.</p>
                </div>
            </div>
            <div>
                <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-white mb-6">Liên hệ và hỗ trợ
                </div>
                <ul class="space-y-4">
                    <li>
                        <a href="tel:0329346849" class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 flex items-center gap-2">
                            <i class="fa-solid fa-phone text-xs"></i> 0329346849
                        </a>
                    </li>
                    <li>
                        <a href="mailto:nguyentrungtpvl@gmail.com" class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-xs"></i> nguyentrungtpvl@gmail.com
                        </a>
                    </li>
                    <li>
                        <a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4"
                            href="{{ route('order.tracking') }}">Tra cứu đơn hàng</a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-white mb-6">Kết
                    nối</div>
                <div class="flex gap-4">
                    <a class="w-10 h-10 bg-slate-200 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-[#1877F2] hover:text-white transition-all text-sm"
                        href="https://www.facebook.com/nguyen.tien.trung.438008" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a class="w-10 h-10 bg-slate-200 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-black hover:text-white transition-all text-sm"
                        href="https://www.tiktok.com/@trung06062005?lang=en" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    <a class="w-10 h-10 bg-slate-200 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-[#E1306C] hover:text-white transition-all text-sm"
                        href="https://www.instagram.com/trung_66_05" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div>
                <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-white mb-6">Chính sách
                </div>
                <ul class="space-y-4">
                    <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4"
                            href="{{ route('policy.privacy') }}">Chính Sách Bảo Mật</a></li>
                    <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4"
                            href="{{ route('policy.warranty') }}">Quy Định Bảo Hành</a></li>
                    <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4"
                            href="{{ route('policy.return') }}">Chính Sách Đổi Trả</a></li>
                    <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4"
                            href="{{ route('policy.terms') }}">Điều khoản sử dụng</a></li>
                    <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4"
                            href="{{ route('policy.shipping') }}">Chính sách vận chuyển & kiểm hàng</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-slate-200 dark:bg-slate-800 h-px w-full my-8"></div>
        <div class="px-6 lg:px-12 max-w-[1400px] mx-auto text-center text-slate-400 text-xs">
            © 2024 TechFlow. Precision Engineered Hardware.
        </div>
    </footer>

    <!-- Global AJAX Logic -->
    <script>
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toast-container') || createToastContainer();
            const toast = document.createElement('div');
            let bgClass = 'bg-emerald-500/90';
            if (type === 'error') bgClass = 'bg-red-500/90';
            if (type === 'warning') bgClass = 'bg-amber-500/90';

            toast.className = `transform translate-x-full opacity-0 transition-all duration-300 ${bgClass} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-4 z-[10001] min-w-[300px] border border-white/20 backdrop-blur-md pointer-events-auto`;

            let iconClass = 'fa-circle-check';
            if (type === 'error') iconClass = 'fa-circle-exclamation';
            if (type === 'warning') iconClass = 'fa-triangle-exclamation';

            toast.innerHTML = `
            <i class="fa-solid ${iconClass} text-xl"></i>
            <div class="flex-1">
                <p class="font-bold text-sm tracking-wide">${message}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        `;
            toastContainer.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            }, 10);

            // Animate out
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add('opacity-0', 'translate-x-4');
                    setTimeout(() => toast.remove(), 300);
                }
            }, 3000);
        }

        function createToastContainer() {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'fixed top-24 right-4 flex flex-col gap-3 z-[10001] pointer-events-none';
            // Enable pointer events for toast itself but not container
            container.style.pointerEvents = 'none';
            document.body.appendChild(container);
            return container;
        }

        // Auto-show session toasts
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif
            @if(session('error') || $errors->any())
                @if($errors->any())
                    showToast("Vui lòng kiểm tra lại thông tin!", 'error');
                @else
                    showToast("{{ session('error') }}", 'error');
                @endif
            @endif
    });

        let pendingAddToCart = null;

        function handleAddToCart(productId, colors, name, price, image) {
            if (colors && Array.isArray(colors) && colors.length > 0) {
                pendingAddToCart = { productId, colors, name, price, image };
                
                // Update Modal UI
                document.getElementById('modalProductName').innerText = name;
                document.getElementById('modalProductPrice').innerText = new Intl.NumberFormat('vi-VN').format(price) + '₫';
                document.getElementById('modalProductImage').src = image;
                
                const optionsContainer = document.getElementById('modalColorOptions');
                optionsContainer.innerHTML = '';
                
                colors.forEach((color, index) => {
                    const btn = document.createElement('button');
                    btn.className = `color-option-btn px-4 py-2.5 rounded-xl border-2 border-slate-100 dark:border-slate-800 text-xs font-bold transition-all hover:border-primary/30 ${index === 0 ? 'active border-primary bg-primary/5 text-primary shadow-sm shadow-primary/10' : 'text-slate-600 dark:text-slate-400'}`;
                    btn.innerText = color;
                    btn.onclick = () => {
                        document.querySelectorAll('.color-option-btn').forEach(b => {
                            b.className = 'color-option-btn px-4 py-2.5 rounded-xl border-2 border-slate-100 dark:border-slate-800 text-xs font-bold transition-all hover:border-primary/30 text-slate-600 dark:text-slate-400';
                        });
                        btn.className = 'color-option-btn px-4 py-2.5 rounded-xl border-2 border-primary bg-primary/5 text-primary text-xs font-bold transition-all shadow-sm shadow-primary/10';
                        pendingAddToCart.selectedColor = color;
                    };
                    optionsContainer.appendChild(btn);
                });
                
                pendingAddToCart.selectedColor = colors[0]; // Default selection
                
                document.getElementById('colorSelectionModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                addToCart(productId);
            }
        }

        document.getElementById('confirmColorBtn').onclick = () => {
            if (pendingAddToCart) {
                addToCart(pendingAddToCart.productId, 1, false, pendingAddToCart.selectedColor);
                closeColorModal();
            }
        };

        function closeColorModal() {
            document.getElementById('colorSelectionModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            pendingAddToCart = null;
        }

        async function addToCart(productId, quantity = 1, redirect = false, color = null) {
            try {
                const response = await fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ 
                        quantity: quantity,
                        color: color
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Update header count
                    const cartCount = document.getElementById('cart-count');
                    const cartCountCompact = document.getElementById('cart-count-compact');
                    if (cartCount) cartCount.innerText = data.cartCount;
                    if (cartCountCompact) cartCountCompact.innerText = data.cartCount;

                    showToast(data.message);

                    if (redirect) {
                        window.location.href = '{{ route('cart.index') }}';
                    }
                } else {
                    // If the item already exists or other failure
                    showToast(data.message, 'warning');
                }
            } catch (error) {
                console.error('Error adding to cart:', error);
                showToast('Không thể kết nối tới máy chủ!', 'error');
            }
        }
    </script>

    <!-- Alpine.js (Optional if needed for other components) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @yield('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const handlePopover = () => {
                const triggers = document.querySelectorAll('.product-trigger');
                
                triggers.forEach(trigger => {
                    const card = trigger.closest('.product-card');
                    if (!card) return;
                    
                    const popover = card.querySelector('.product-popover');
                    if (!popover) return;

                    trigger.addEventListener('mouseenter', () => {
                        card.style.zIndex = '500'; // Đè lên tất cả các thẻ khác khi hover
                        popover.classList.remove('hidden');
                        popover.classList.add('flex');
                        
                        // Fix for containing blocks (like backdrop-blur or transform)
                        // Move popover to body so fixed positioning is relative to viewport
                        document.body.appendChild(popover);
                        
                        setTimeout(() => popover.style.opacity = '1', 10);
                    });

                    trigger.addEventListener('mouseleave', () => {
                        card.style.zIndex = ''; // Trả lại z-index ban đầu
                        popover.style.opacity = '0';
                        setTimeout(() => {
                            popover.classList.add('hidden');
                            popover.classList.remove('flex');
                            // Move popover back to card
                            card.appendChild(popover);
                        }, 200);
                    });

                    trigger.addEventListener('mousemove', (e) => {
                        const popoverWidth = 350;
                        const xOffset = 5;
                        const yOffset = 5; // Khoảng cách từ con trỏ đến cạnh dưới của bảng
                        
                        let x = e.clientX + xOffset;
                        // Tính toán vị trí Y để bảng nằm TRÊN con trỏ
                        let y = e.clientY - popover.offsetHeight - yOffset;
                        
                        // Kiểm tra nếu bảng vượt quá mép phải màn hình
                        if (x + popoverWidth > window.innerWidth) {
                            x = e.clientX - popoverWidth - xOffset;
                        }
                        
                        // Kiểm tra nếu bảng vượt quá mép trên màn hình (đẩy xuống dưới nếu không đủ chỗ)
                        if (y < 10) {
                            y = e.clientY + yOffset;
                        }
                        
                        popover.style.position = 'fixed';
                        popover.style.left = x + 'px';
                        popover.style.top = y + 'px';
                        popover.style.zIndex = '99999';
                    });
                });
            };

            handlePopover();
            // Re-run for dynamic content (if any)
            window.addEventListener('contentUpdated', handlePopover);

            // Search Suggestions Logic
            const searchInputs = [
                document.getElementById('search-input'),
                document.getElementById('search-input-compact')
            ];
            const searchSuggestions = document.getElementById('search-suggestions');
            const suggestionResults = document.getElementById('suggestion-results');
            const viewAllContainer = document.getElementById('view-all-container');
            const viewAllLink = document.getElementById('view-all-link');
            const searchQueryDisplay = document.getElementById('search-query-display');
            let debounceTimer;

            searchInputs.forEach(input => {
                if (!input) return;
                input.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    const query = this.value.trim();

                    if (query.length < 2) {
                        searchSuggestions.classList.add('hidden');
                        return;
                    }

                    // Move suggestions dropdown to the active input's container
                    const parent = this.parentElement;
                    if (searchSuggestions.parentElement !== parent) {
                        parent.appendChild(searchSuggestions);
                    }

                    debounceTimer = setTimeout(() => {
                        fetch(`/search-suggestions?query=${encodeURIComponent(query)}`)
                            .then(response => response.json())
                            .then(data => {
                                suggestionResults.innerHTML = '';
                                
                                if (data.length > 0) {
                                    data.forEach(product => {
                                        const priceHtml = product.sale_price 
                                            ? `<span class="text-primary font-bold">${product.sale_price}</span> <span class="text-xs text-slate-400 line-through ml-2">${product.price}</span>`
                                            : `<span class="text-primary font-bold">${product.price}</span>`;

                                        const item = document.createElement('a');
                                        item.href = product.url;
                                        item.className = 'flex items-center gap-4 p-4 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors border-b border-slate-50 dark:border-slate-800 last:border-none';
                                        item.innerHTML = `
                                            <div class="w-16 h-16 bg-white rounded-lg border border-slate-100 flex-shrink-0 overflow-hidden">
                                                <img src="${product.image}" class="w-full h-full object-contain p-2" alt="${product.name}">
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="text-sm font-bold text-slate-900 dark:text-white line-clamp-1">${product.name}</h4>
                                                <div class="mt-1">${priceHtml}</div>
                                            </div>
                                        `;
                                        suggestionResults.appendChild(item);
                                    });

                                    searchQueryDisplay.textContent = query;
                                    viewAllLink.href = `/store?search=${encodeURIComponent(query)}`;
                                    viewAllContainer.classList.remove('hidden');
                                    searchSuggestions.classList.remove('hidden');
                                } else {
                                    suggestionResults.innerHTML = '<div class="p-8 text-center text-slate-400"><i class="fa-solid fa-magnifying-glass text-3xl mb-3 block"></i> Không tìm thấy sản phẩm nào</div>';
                                    viewAllContainer.classList.add('hidden');
                                    searchSuggestions.classList.remove('hidden');
                                }
                            });
                    }, 300);
                });
            });

            // Close suggestions when clicking outside
            document.addEventListener('click', function(e) {
                const isInputClick = searchInputs.some(input => input && input.contains(e.target));
                if (!isInputClick && !searchSuggestions.contains(e.target)) {
                    searchSuggestions.classList.add('hidden');
                }
            });
        });
    </script>
    <!-- AI Chatbot Widget -->
    <div id="ai-chatbot-container" class="fixed bottom-6 right-6 z-[9999] font-sans">
        <!-- Chat Toggle Button -->
        <button id="chatbot-toggle" class="w-16 h-16 bg-primary text-white rounded-full shadow-[0_10px_40px_rgba(59,130,246,0.5)] flex items-center justify-center hover:scale-110 transition-all duration-300 group">
            <i class="fa-solid fa-robot text-2xl group-hover:hidden animate-in fade-in"></i>
            <i class="fa-solid fa-xmark text-2xl hidden group-hover:block animate-in zoom-in"></i>
        </button>

        <!-- Chat Window -->
        <div id="chatbot-window" class="absolute bottom-20 right-0 w-[380px] h-[550px] bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-[2rem] shadow-2xl flex flex-col overflow-hidden opacity-0 invisible translate-y-10 transition-all duration-500 scale-95 origin-bottom-right">
            <!-- Header -->
            <div class="p-6 bg-primary text-white flex items-center justify-between shadow-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md">
                        <i class="fa-solid fa-robot text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-black uppercase tracking-widest">TechFlow AI</h4>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                            <span class="text-[10px] font-bold text-white/70 uppercase">Trực tuyến</span>
                        </div>
                    </div>
                </div>
                <button id="chatbot-close" class="text-white/70 hover:text-white transition-colors">
                    <i class="fa-solid fa-minus text-lg"></i>
                </button>
            </div>

            <!-- Chat Body -->
            <div id="chatbot-messages" class="flex-1 overflow-y-auto p-6 space-y-4 scroll-smooth">
                <!-- Welcome Message -->
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-primary/10 text-primary rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-robot text-xs"></i>
                    </div>
                    <div class="bg-slate-100 dark:bg-slate-800 p-4 rounded-2xl rounded-tl-none max-w-[85%]">
                        <p class="text-sm text-slate-700 dark:text-slate-300 font-medium leading-relaxed">
                            Xin chào! Tôi là **TechFlow AI**. Tôi có thể giúp gì cho bạn trong việc lựa chọn linh kiện máy tính hôm nay? 💻✨
                        </p>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-4 bg-slate-50/50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800">
                <form id="chatbot-form" class="relative">
                    <input type="text" id="chatbot-input" placeholder="Nhập câu hỏi của bạn..." 
                        class="w-full bg-white dark:bg-slate-900 border-none rounded-2xl pl-5 pr-14 py-3.5 text-sm font-bold text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 shadow-sm transition-all"
                        autocomplete="off">
                    <button type="submit" class="absolute right-2 top-1.5 w-10 h-10 bg-primary text-white rounded-xl flex items-center justify-center hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                    </button>
                </form>
                <p class="text-[9px] text-center text-slate-400 mt-3 font-black uppercase tracking-widest opacity-50">Powered by TechFlow AI & Gemini</p>
            </div>
        </div>
    </div>

    <style>
        #chatbot-window.active {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) scale(1) !important;
        }
        #chatbot-messages::-webkit-scrollbar {
            width: 4px;
        }
        #chatbot-messages::-webkit-scrollbar-thumb {
            background: rgba(var(--primary-rgb), 0.1);
            border-radius: 10px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('chatbot-toggle');
            const chatWindow = document.getElementById('chatbot-window');
            const closeBtn = document.getElementById('chatbot-close');
            const chatForm = document.getElementById('chatbot-form');
            const chatInput = document.getElementById('chatbot-input');
            const chatMessages = document.getElementById('chatbot-messages');

            // Toggle window
            toggleBtn.addEventListener('click', () => {
                chatWindow.classList.toggle('active');
                if (chatWindow.classList.contains('active')) {
                    chatInput.focus();
                }
            });

            closeBtn.addEventListener('click', () => {
                chatWindow.classList.remove('active');
            });

            // Handle Chat
            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const message = chatInput.value.trim();
                if (!message) return;

                // Add User Message
                addMessage(message, 'user');
                chatInput.value = '';

                // Add Typing Indicator
                const typingId = addTypingIndicator();

                try {
                    const response = await fetch('/chatbot/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ message })
                    });

                    const data = await response.json();
                    removeTypingIndicator(typingId);

                    if (data.success) {
                        addMessage(data.reply, 'bot');
                    } else {
                        addMessage(data.reply || 'Rất tiếc, tôi đang gặp chút sự cố kết nối. Bạn thử lại sau nhé!', 'bot');
                    }
                } catch (error) {
                    console.error('Chatbot Error:', error);
                    removeTypingIndicator(typingId);
                    addMessage('Hệ thống đang bận, vui lòng thử lại sau giây lát.', 'bot');
                }
            });

            function addMessage(text, sender) {
                const div = document.createElement('div');
                div.className = `flex items-start gap-3 ${sender === 'user' ? 'flex-row-reverse' : ''} animate-in slide-in-from-bottom-2 duration-300`;
                
                const icon = sender === 'bot' 
                    ? '<div class="w-8 h-8 bg-primary/10 text-primary rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-robot text-xs"></i></div>'
                    : '<div class="w-8 h-8 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-user text-xs"></i></div>';

                const contentClass = sender === 'bot'
                    ? 'bg-slate-100 dark:bg-slate-800 rounded-tl-none'
                    : 'bg-primary text-white rounded-tr-none';

                div.innerHTML = `
                    ${icon}
                    <div class="${contentClass} p-4 rounded-2xl max-w-[85%] shadow-sm">
                        <p class="text-sm font-medium leading-relaxed">
                            ${text.replace(/\n/g, '<br>')
                                .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>')
                                .replace(/\[(.*?)\]\((.*?)\)/g, '<a href="$2" class="text-primary-dark font-black underline hover:no-underline decoration-primary/30 decoration-2 underline-offset-4">$1</a>')}
                        </p>
                    </div>
                `;

                chatMessages.appendChild(div);
                scrollToBottom();
            }

            function addTypingIndicator() {
                const id = 'typing-' + Date.now();
                const div = document.createElement('div');
                div.id = id;
                div.className = 'flex items-start gap-3 animate-in fade-in duration-300';
                div.innerHTML = `
                    <div class="w-8 h-8 bg-primary/10 text-primary rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-robot text-xs"></i>
                    </div>
                    <div class="bg-slate-100 dark:bg-slate-800 p-4 rounded-2xl rounded-tl-none shadow-sm flex gap-1">
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce [animation-delay:0.2s]"></span>
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce [animation-delay:0.4s]"></span>
                    </div>
                `;
                chatMessages.appendChild(div);
                scrollToBottom();
                return id;
            }

            function removeTypingIndicator(id) {
                const el = document.getElementById(id);
                if (el) el.remove();
            }

            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
</body>

</html>