<!DOCTYPE html>
<html lang="vi" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang chủ') - TechFlow</title>

    <!-- Favicon / Brand Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-weblinhkien-nho.png') }}?v=2">

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

        /* Reveal on Scroll */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .reveal-on-scroll.is-revealed {
            opacity: 1;
            transform: translateY(0);
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

        /* 
           ==================================================
           DRIBBBLE STYLE TRANSPARENT HEADER (SINGLE-ROW)
           ==================================================
        */
        /* 
           ==================================================
           DRIBBBLE STYLE TRANSPARENT HEADER (SINGLE-ROW)
           ==================================================
        */
        #main-header {
            transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, backdrop-filter 0.3s ease;
        }

        @media (min-width: 1024px) {
            .header-transparent {
                background-color: transparent !important;
                border-color: transparent !important;
                box-shadow: none !important;
                backdrop-filter: none !important;
            }

            /* Invert logo in transparent mode if it has dark text to make it bright white */
            .header-transparent #header-logo {
                filter: brightness(0) invert(1) !important;
            }

            /* Style only top-level header links/buttons marked with .header-link when transparent */
            .header-transparent .header-link,
            .header-transparent .header-link span:not(#cart-count):not(.bg-red-500),
            .header-transparent .header-link i {
                color: #f8fafc !important; /* Off-white */
                text-shadow: 0 1px 2px rgba(15, 23, 42, 0.4) !important;
                transition: color 0.3s ease;
            }

            /* Hover states for top-level header links and buttons when transparent */
            .header-transparent .header-link:hover,
            .header-transparent .header-link:hover span:not(#cart-count):not(.bg-red-500),
            .header-transparent .header-link:hover i,
            /* Keep parent header links highlighted when their dropdown menu is active/hovered (for both transparent and white states) */
            .group:hover .header-link,
            .group:hover .header-link span:not(#cart-count):not(.bg-red-500),
            .group:hover .header-link i {
                color: #2badee !important;
                text-shadow: none !important;
            }

            /* Search icon in transparent header */
            .header-transparent #search-form button i {
                color: rgba(248, 250, 252, 0.6) !important;
                text-shadow: none !important;
            }
            
            .header-transparent #search-form button:hover i {
                color: #2badee !important;
            }

            /* Glassmorphic search input when transparent */
            .header-transparent #search-input {
                background-color: rgba(248, 250, 252, 0.08) !important;
                border: 1px solid rgba(248, 250, 252, 0.15) !important;
                color: #f8fafc !important;
                backdrop-filter: blur(12px) !important;
                box-shadow: inset 0 2px 4px rgba(15, 23, 42, 0.2) !important;
                transition: all 0.3s ease !important;
            }
            
            .header-transparent #search-input::placeholder {
                color: rgba(248, 250, 252, 0.5) !important;
            }

            .header-transparent #search-input:focus {
                background-color: rgba(248, 250, 252, 0.15) !important;
                border-color: #2badee !important;
                box-shadow: 0 0 15px rgba(43, 173, 238, 0.4) !important;
            }

            /* Glassmorphic buttons (Cart, Hotline, Auth wrapper) when transparent (excluding absolute dropdowns & flyouts) */
            .header-transparent .bg-slate-100:not(.absolute):not(.absolute *), 
            .header-transparent .dark\:bg-slate-800:not(.absolute):not(.absolute *) {
                background-color: rgba(248, 250, 252, 0.08) !important;
                border: 1px solid rgba(248, 250, 252, 0.10) !important;
                transition: all 0.3s ease !important;
            }

            .header-transparent .bg-slate-100:not(.absolute):not(.absolute *):hover, 
            .header-transparent .dark\:bg-slate-800:not(.absolute):not(.absolute *):hover {
                background-color: rgba(248, 250, 252, 0.20) !important;
                border-color: rgba(248, 250, 252, 0.30) !important;
            }

            /* ===== LIGHT-BG OVERRIDE: Login/Register pages have light backgrounds ===== */
            .header-light-bg.header-transparent .header-link,
            .header-light-bg.header-transparent .header-link span:not(#cart-count):not(.bg-red-500),
            .header-light-bg.header-transparent .header-link i {
                color: #334155 !important; /* slate-700 */
                text-shadow: none !important;
            }

            .header-light-bg.header-transparent .header-link:hover,
            .header-light-bg.header-transparent .header-link:hover span:not(#cart-count):not(.bg-red-500),
            .header-light-bg.header-transparent .header-link:hover i {
                color: #2badee !important;
            }

            .header-light-bg.header-transparent #header-logo {
                filter: none !important;
            }

            .header-light-bg.header-transparent #search-input {
                background-color: #f1f5f9 !important; /* slate-100 */
                border: 1px solid #e2e8f0 !important; /* slate-200 */
                color: #0f172a !important;
                backdrop-filter: none !important;
                box-shadow: inset 0 1px 2px rgba(0,0,0,0.05) !important;
            }

            .header-light-bg.header-transparent #search-input::placeholder {
                color: #94a3b8 !important; /* slate-400 */
            }

            .header-light-bg.header-transparent #search-input:focus {
                background-color: #ffffff !important;
                border-color: #2badee !important;
                box-shadow: 0 0 0 3px rgba(43, 173, 238, 0.15) !important;
            }

            .header-light-bg.header-transparent #search-form button i {
                color: #94a3b8 !important;
                text-shadow: none !important;
            }

            .header-light-bg.header-transparent .bg-slate-100:not(.absolute):not(.absolute *),
            .header-light-bg.header-transparent .dark\:bg-slate-800:not(.absolute):not(.absolute *) {
                background-color: #f1f5f9 !important;
                border: 1px solid #e2e8f0 !important;
            }

            .header-light-bg.header-transparent .bg-slate-100:not(.absolute):not(.absolute *):hover,
            .header-light-bg.header-transparent .dark\:bg-slate-800:not(.absolute):not(.absolute *):hover {
                background-color: #e2e8f0 !important;
                border-color: #cbd5e1 !important;
            }
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
    
    <!-- THIẾT KẾ MỚI (TRANSPARENT HEADER - DRIBBBLE STYLE SINGLE-ROW): -->
    <header id="main-header"
        class="fixed top-0 w-full z-[1000] transition-all duration-300 ease-in-out antialiased {{ (request()->routeIs('home') || request()->routeIs('custom.login') || request()->routeIs('register')) ? 'header-transparent lg:bg-transparent lg:border-transparent lg:shadow-none bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-sm' : 'bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-sm' }} {{ (request()->routeIs('custom.login') || request()->routeIs('register')) ? 'header-light-bg' : '' }}">
        <div class="max-w-[1600px] mx-auto px-6 lg:px-12 flex flex-col transition-all duration-300" id="header-container-wrapper">
            <div class="flex items-center justify-between gap-6 transition-all duration-300 {{ (request()->routeIs('home') || request()->routeIs('custom.login') || request()->routeIs('register')) ? 'lg:h-20 h-16' : 'h-16' }}" id="header-container">
                <!-- ========================================== -->
                <!-- DESKTOP HEADER LAYOUT                      -->
                <!-- ========================================== -->
                <div class="hidden lg:flex w-full items-center justify-between gap-6">
                    <!-- Left Side: Logo & Horizontal Nav Links -->
                    <div class="flex items-center gap-8">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="shrink-0 flex items-center">
                            <img src="{{ asset('images/logo-weblinhkien-Photoroom.png') }}?v=2" alt="TechFlow Logo"
                                class="w-[150px] h-[54px] object-contain transition-all duration-300" id="header-logo">
                        </a>

                        <!-- Horizontal Navigation Links -->
                        <div class="hidden lg:flex items-center gap-6 xl:gap-8">
                            <!-- "Sản phẩm" Dropdown Category -->
                            <div class="relative group">
                                <a href="{{ route('store.index') }}" class="header-link flex items-center gap-1.5 text-[14px] font-semibold text-slate-700 dark:text-slate-300 hover:text-primary transition-all focus:outline-none" style="font-size:14px !important; font-weight:600 !important">
                                    <span>Sản phẩm</span>
                                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform group-hover:rotate-180 opacity-70"></i>
                                </a>
                                
                                <!-- Dropdown Menu Level 1 -->
                                <div class="absolute top-full left-0 w-72 mt-2 bg-white dark:bg-slate-900 shadow-2xl rounded-xl border border-slate-200 dark:border-slate-800 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[2000] transform translate-y-2 group-hover:translate-y-0">
                                    @foreach($globalCategories as $cat)
                                        <div class="relative group/sub">
                                            <a href="{{ route('store.category', $cat->slug) }}" class="flex items-center justify-between px-5 py-3.5 text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover/sub:bg-primary group-hover/sub:text-white transition-all">
                                                <span>{{ $cat->name }}</span>
                                                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
                                            </a>

                                            <!-- Flyout Menu (Level 2 - Brand & Price Filtering) -->
                                            <div class="absolute top-0 left-full ml-2 w-[550px] bg-white dark:bg-slate-900 shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl border border-slate-200 dark:border-slate-800 p-8 opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible transition-all duration-300 z-[2001] flex gap-12 transform -translate-x-4 group-hover/sub:translate-x-0">
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
                                                                <div class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover/item:bg-primary transition-colors"></div>
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
                                                            Dưới 1 triệu
                                                        </a>
                                                        <a href="{{ route('store.category', [$cat->slug, 'min_price' => 1000000, 'max_price' => 3000000]) }}"
                                                            class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                            1 triệu - 3 triệu
                                                        </a>
                                                        <a href="{{ route('store.category', [$cat->slug, 'min_price' => 3000000, 'max_price' => 4000000]) }}"
                                                            class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                            3 triệu - 4 triệu
                                                        </a>
                                                        <a href="{{ route('store.category', [$cat->slug, 'min_price' => 4000000]) }}"
                                                            class="text-sm text-slate-600 dark:text-slate-400 hover:text-primary hover:translate-x-1 transition-all flex items-center gap-2 group/p">
                                                            Trên 4 triệu
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Quick Categories (Plain Text like Dribbble) -->
                            @foreach($globalCategories->take(4) as $navCat)
                                <a href="{{ route('store.category', $navCat->slug) }}" class="header-link text-[14px] font-semibold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors" style="font-size:14px !important; font-weight:600 !important">
                                    {{ $navCat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Right Side: Compact Search, Hotline, Cart, Auth Buttons -->
                    <div class="flex items-center gap-4 xl:gap-6">
                        <!-- Expandable Search Input -->
                        <div class="relative flex items-center">
                            <form action="{{ route('store.index') }}" method="GET" class="relative" id="search-form">
                                <input name="search" id="search-input" value="{{ request('search') }}" autocomplete="off"
                                    class="w-[160px] md:w-[190px] focus:w-[260px] bg-slate-100 dark:bg-slate-800 border border-transparent rounded-full py-2 pl-4 pr-10 focus:ring-2 focus:ring-primary text-xs font-bold outline-none dark:text-white shadow-inner transition-all duration-300"
                                    placeholder="Tìm linh kiện..." type="text" />
                                <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 w-8 h-8 text-slate-400 hover:text-primary flex items-center justify-center transition-colors">
                                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                                </button>
                            </form>
                            <!-- Suggestions Dropdown -->
                            <div id="search-suggestions" class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden hidden z-[1100] w-[260px] md:w-[320px]">
                                <div class="max-h-[400px] overflow-y-auto" id="suggestion-results"></div>
                                <div id="view-all-container" class="p-3 bg-slate-50 dark:bg-slate-800 border-t border-slate-100 dark:border-slate-700 text-center hidden">
                                    <a href="#" id="view-all-link" class="text-xs font-bold text-primary hover:underline">
                                        Xem tất cả kết quả cho "<span id="search-query-display"></span>"
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Hotline -->
                        <a href="tel:0329346849" class="header-link hidden xl:flex items-center gap-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-all group">
                            <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-phone text-xs"></i>
                            </div>
                            <span class="text-xs font-black font-mono">0329346849</span>
                        </a>

                        <!-- Cart Button -->
                        <a href="{{ route('cart.index') }}" class="header-link relative w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-cart-shopping text-xs"></i>
                            <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white dark:border-slate-900">
                                {{ count(session('cart', [])) }}
                            </span>
                        </a>

                        <!-- Dribbble Style Pill Auth Buttons -->
                        @guest
                            <div class="flex items-center gap-4">
                                <a href="{{ route('register') }}" class="header-link hidden sm:inline-block text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors">Đăng ký</a>
                                <a href="{{ route('custom.login') }}" class="px-5 py-2.5 bg-slate-950 text-white dark:bg-white dark:text-slate-900 rounded-full text-sm font-bold shadow-md hover:bg-slate-800 dark:hover:bg-slate-100 hover:scale-105 transition-all">
                                    Đăng nhập
                                </a>
                            </div>
                        @else
                            <div class="relative group">
                                <button class="header-link flex items-center gap-2 px-4 py-2 bg-slate-950 text-white dark:bg-white dark:text-slate-900 rounded-full hover:scale-105 transition-all focus:outline-none">
                                    <i class="fa-solid fa-user text-xs"></i>
                                    <span class="text-xs font-bold max-w-[80px] truncate">{{ Auth::user()->name }}</span>
                                </button>
                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 top-full mt-2 w-52 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 overflow-hidden transform translate-y-2 group-hover:translate-y-0">
                                    <div class="px-4 py-3 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-600">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">Tài khoản</p>
                                        <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="p-2">
                                        <a href="{{ route('profile.index') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-primary hover:text-white rounded-lg transition-colors">
                                            <i class="fa-solid fa-id-card text-slate-400"></i> Hồ sơ
                                        </a>
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-primary hover:text-white rounded-lg transition-colors">
                                                <i class="fa-solid fa-gauge text-slate-400"></i> Quản trị
                                            </a>
                                        @endif
                                        <a href="{{ route('order.tracking') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-primary hover:text-white rounded-lg transition-colors">
                                            <i class="fa-solid fa-box text-slate-400"></i> Đơn hàng
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}" class="m-0 border-t border-slate-100 dark:border-slate-700 p-2">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg font-bold transition-colors">
                                            <i class="fa-solid fa-right-from-bracket text-red-400"></i> Đăng xuất
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- MOBILE HEADER LAYOUT                       -->
                <!-- ========================================== -->
                <div class="flex lg:hidden w-full items-center justify-between gap-4 relative">
                    <!-- Left: Category Menu Drawer Toggle -->
                    <div class="flex items-center w-10 h-10 shrink-0">
                        <button id="open-menu-drawer" type="button" class="header-link w-10 h-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full flex items-center justify-center hover:bg-slate-200 dark:hover:bg-slate-700 transition-all focus:outline-none">
                            <i class="fa-solid fa-bars text-base"></i>
                        </button>
                    </div>

                    <!-- Center: Center Logo (Absolute Centering to prevent shifting) -->
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none z-10">
                        <a href="{{ route('home') }}" class="flex items-center justify-center pointer-events-auto">
                            <img src="{{ asset('images/logo-weblinhkien-Photoroom.png') }}?v=2" alt="TechFlow Logo"
                                class="w-[120px] h-[44px] object-contain transition-all duration-300" id="header-logo-mobile">
                        </a>
                    </div>

                    <!-- Right: Cart Button & Mobile Search Toggle -->
                    <div class="flex items-center gap-2 shrink-0 justify-end min-w-[40px]">
                        <!-- Mobile Search Toggle -->
                        <button id="mobile-search-toggle" type="button" class="header-link w-0 h-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full flex items-center justify-center hover:bg-slate-200 dark:hover:bg-slate-700 transition-all duration-300 focus:outline-none opacity-0 scale-90 pointer-events-none overflow-hidden">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </button>
                        
                        <!-- Cart Button -->
                        <a href="{{ route('cart.index') }}" class="header-link relative w-10 h-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-cart-shopping text-sm"></i>
                            <span id="cart-count-mobile" class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white dark:border-slate-900">
                                {{ count(session('cart', [])) }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Search Bar (Only visible on mobile, directly under the header row) -->
            <div class="lg:hidden w-full pb-4 pt-1 transition-all duration-300 ease-in-out overflow-hidden max-h-20 opacity-100" id="mobile-search-row">
                <form action="{{ route('store.index') }}" method="GET" class="relative w-full" id="search-form-mobile">
                    <input name="search" id="search-input-mobile" value="{{ request('search') }}" autocomplete="off"
                        class="w-full bg-slate-100 dark:bg-slate-800 border border-transparent rounded-full py-2.5 pl-5 pr-12 focus:ring-2 focus:ring-primary text-xs font-bold outline-none dark:text-white shadow-inner transition-all duration-300"
                        placeholder="Tìm linh kiện..." type="text" />
                    <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 w-10 h-10 text-slate-400 hover:text-primary flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- ========================================== -->
    <!-- MOBILE FULLSCREEN MENU DRAWER              -->
    <!-- ========================================== -->
    <div id="mobile-menu-drawer" class="fixed inset-0 z-[10000] bg-white dark:bg-slate-950 transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden flex flex-col">
        <!-- Drawer Header -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950">
            <span class="text-base font-black uppercase tracking-wider text-slate-900 dark:text-white">Danh mục & Tài khoản</span>
            <button id="close-menu-drawer" type="button" class="w-10 h-10 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark text-xl text-slate-500 dark:text-slate-400"></i>
            </button>
        </div>
        
        <!-- Drawer Body -->
        <div class="flex-1 overflow-y-auto px-6 py-8 space-y-8 bg-white dark:bg-slate-950">
            <!-- Auth Buttons Section (Top) -->
            <div class="space-y-4">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Tài khoản cá nhân</p>
                @guest
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('custom.login') }}" class="py-3.5 text-center bg-slate-950 text-white dark:bg-white dark:text-slate-900 rounded-2xl text-xs font-black uppercase tracking-widest shadow-md hover:bg-slate-800 transition-all">
                            Đăng nhập
                        </a>
                        <a href="{{ route('register') }}" class="py-3.5 text-center border-2 border-slate-200 dark:border-slate-800 text-slate-800 dark:text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 dark:hover:bg-slate-900 transition-colors">
                            Đăng ký
                        </a>
                    </div>
                @else
                    <div class="p-5 bg-slate-50 dark:bg-slate-900/60 border border-slate-100 dark:border-slate-800/80 rounded-2xl flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center transition-colors" title="Quản trị">
                                    <i class="fa-solid fa-gauge text-sm"></i>
                                </a>
                            @endif
                            <a href="{{ route('profile.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-850 text-slate-600 dark:text-slate-400 flex items-center justify-center transition-colors" title="Hồ sơ">
                                <i class="fa-solid fa-id-card text-sm"></i>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 dark:bg-red-950/20 text-red-500 flex items-center justify-center transition-colors" title="Đăng xuất">
                                    <i class="fa-solid fa-right-from-bracket text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
            
            <!-- Category Navigation List -->
            <div class="space-y-4">
                <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Danh mục linh kiện</p>
                <nav class="flex flex-col gap-2">
                    <a href="{{ route('store.index') }}" class="flex items-center justify-between py-3.5 px-5 bg-slate-50 dark:bg-slate-900/50 rounded-2xl text-xs font-bold text-slate-800 dark:text-slate-200 hover:text-primary hover:bg-slate-100/50 transition-colors">
                        <span>TẤT CẢ SẢN PHẨM</span>
                        <i class="fa-solid fa-chevron-right text-[10px] opacity-40"></i>
                    </a>
                    @foreach($globalCategories as $cat)
                        <div class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl overflow-hidden transition-all duration-300 border border-transparent">
                            <div class="flex items-center justify-between">
                                <a href="{{ route('store.category', $cat->slug) }}" class="flex-grow py-3.5 pl-5 pr-2 text-xs font-bold text-slate-800 dark:text-slate-200 hover:text-primary transition-colors uppercase">
                                    {{ $cat->name }}
                                </a>
                                <button type="button" class="w-12 h-11 flex items-center justify-center text-slate-400 dark:text-slate-500 hover:text-primary dark:hover:text-primary transition-colors focus:outline-none" onclick="toggleCategoryAccordion(this, 'cat-{{ $cat->id }}')">
                                    <i class="fa-solid fa-chevron-right text-[10px] transition-transform duration-300 pointer-events-none"></i>
                                </button>
                            </div>
                            
                            <!-- Dropdown panel -->
                            <div id="cat-{{ $cat->id }}" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white dark:bg-slate-950/20">
                                <div class="px-5 pb-4 pt-2 border-t border-slate-100 dark:border-slate-800/80 space-y-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <!-- Prices -->
                                        <div>
                                            <span class="text-[9px] font-black tracking-widest text-slate-400 dark:text-slate-500 uppercase block mb-2">Khoảng giá</span>
                                            <div class="flex flex-col gap-1.5">
                                                <a href="{{ route('store.category', $cat->slug) }}?min_price=0&max_price=500000" class="text-[11px] font-bold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">Dưới 500k</a>
                                                <a href="{{ route('store.category', $cat->slug) }}?min_price=500000&max_price=1000000" class="text-[11px] font-bold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">500k - 1tr</a>
                                                <a href="{{ route('store.category', $cat->slug) }}?min_price=1000000&max_price=2000000" class="text-[11px] font-bold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">1tr - 2tr</a>
                                                <a href="{{ route('store.category', $cat->slug) }}?min_price=2000000&max_price=3000000" class="text-[11px] font-bold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">2tr - 3tr</a>
                                                <a href="{{ route('store.category', $cat->slug) }}?min_price=3000000" class="text-[11px] font-bold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">Trên 3tr</a>
                                            </div>
                                        </div>
                                        
                                        <!-- Brands -->
                                        <div>
                                            <span class="text-[9px] font-black tracking-widest text-slate-400 dark:text-slate-500 uppercase block mb-2">Hãng sản xuất</span>
                                            @php
                                                $catBrandIds = $brandCategoryMap[$cat->id] ?? collect();
                                                $catBrands = $globalBrands->whereIn('id', $catBrandIds);
                                            @endphp
                                            @if($catBrands->count() > 0)
                                                <div class="flex flex-wrap gap-1.5">
                                                    @foreach($catBrands->take(8) as $br)
                                                        <a href="{{ route('store.category', $cat->slug) }}?brands[]={{ $br->id }}" class="text-[10px] font-bold text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-lg hover:bg-primary hover:text-white transition-colors">
                                                            {{ $br->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-[11px] text-slate-400 italic">Đang cập nhật...</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
    </header>



    <!-- SCRIPT MỚI (STICKY & TRANSPARENT HEADER - DRIBBBLE STYLE): -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('main-header');
            const container = document.getElementById('header-container');
            const logo = document.getElementById('header-logo');
            const scrollThreshold = 50;
            const isHome = {{ (request()->routeIs('home') || request()->routeIs('custom.login') || request()->routeIs('register')) ? 'true' : 'false' }};
            
            const mobileSearchRow = document.getElementById('mobile-search-row');
            const mobileSearchToggle = document.getElementById('mobile-search-toggle');
            let isMobileSearchManuallyToggled = false;
            
            function updateHeader() {
                const scrollY = window.scrollY;
                const isDesktop = window.innerWidth >= 1024;
                
                if (isDesktop) {
                    if (scrollY > 50) {
                        if (container) {
                            container.classList.remove('h-20');
                            container.classList.add('h-16');
                        }
                        if (logo) {
                            logo.classList.remove('w-[150px]', 'h-[54px]');
                            logo.classList.add('w-[125px]', 'h-[45px]');
                        }
                    } else {
                        if (container) {
                            container.classList.add('h-20');
                            container.classList.remove('h-16');
                        }
                        if (logo) {
                            logo.classList.add('w-[150px]', 'h-[54px]');
                            logo.classList.remove('w-[125px]', 'h-[45px]');
                        }
                    }
                    
                    if (isHome) {
                        if (scrollY > scrollThreshold) {
                            header.classList.remove('header-transparent', 'lg:bg-transparent', 'lg:border-transparent', 'lg:shadow-none');
                            header.classList.add('bg-white', 'dark:bg-slate-900', 'border-b', 'border-slate-200', 'dark:border-slate-800', 'shadow-sm');
                        } else {
                            header.classList.add('header-transparent', 'lg:bg-transparent', 'lg:border-transparent', 'lg:shadow-none');
                            header.classList.remove('bg-white', 'dark:bg-slate-900', 'border-b', 'border-slate-200', 'dark:border-slate-800', 'shadow-sm');
                        }
                    }
                } else {
                    // Mobile header: Always keep solid white and borders, remove transparent classes
                    header.classList.remove('header-transparent', 'bg-transparent', 'border-transparent', 'lg:bg-transparent', 'lg:border-transparent', 'lg:shadow-none');
                    header.classList.add('bg-white', 'dark:bg-slate-900', 'border-b', 'border-slate-200', 'dark:border-slate-800', 'shadow-sm');
                    
                    // Collapse search bar on scroll
                    if (scrollY > 50) {
                        if (!isMobileSearchManuallyToggled) {
                            if (mobileSearchRow) {
                                mobileSearchRow.classList.add('max-h-0', 'opacity-0', 'pb-0', 'pt-0', 'pointer-events-none');
                                mobileSearchRow.classList.remove('max-h-20', 'opacity-100', 'pb-4', 'pt-1');
                            }
                            if (mobileSearchToggle) {
                                mobileSearchToggle.classList.remove('w-0', 'opacity-0', 'scale-90', 'pointer-events-none');
                                mobileSearchToggle.classList.add('w-10', 'opacity-100', 'scale-100');
                            }
                        }
                    } else {
                        isMobileSearchManuallyToggled = false;
                        if (mobileSearchRow) {
                            mobileSearchRow.classList.remove('max-h-0', 'opacity-0', 'pb-0', 'pt-0', 'pointer-events-none');
                            mobileSearchRow.classList.add('max-h-20', 'opacity-100', 'pb-4', 'pt-1');
                        }
                        if (mobileSearchToggle) {
                            mobileSearchToggle.classList.add('w-0', 'opacity-0', 'scale-90', 'pointer-events-none');
                            mobileSearchToggle.classList.remove('w-10', 'opacity-100', 'scale-100');
                        }
                    }
                }
            }
            
            if (mobileSearchToggle && mobileSearchRow) {
                mobileSearchToggle.addEventListener('click', function() {
                    if (mobileSearchRow.classList.contains('opacity-0')) {
                        mobileSearchRow.classList.remove('max-h-0', 'opacity-0', 'pb-0', 'pt-0', 'pointer-events-none');
                        mobileSearchRow.classList.add('max-h-20', 'opacity-100', 'pb-4', 'pt-1');
                        isMobileSearchManuallyToggled = true;
                        // Automatically focus search input when opened
                        const mobileInput = document.getElementById('search-input-mobile');
                        if (mobileInput) mobileInput.focus();
                    } else {
                        mobileSearchRow.classList.add('max-h-0', 'opacity-0', 'pb-0', 'pt-0', 'pointer-events-none');
                        mobileSearchRow.classList.remove('max-h-20', 'opacity-100', 'pb-4', 'pt-1');
                        isMobileSearchManuallyToggled = false;
                    }
                });
            }
            
            window.addEventListener('scroll', updateHeader);
            updateHeader(); // Run on initial load

            // Mobile Menu Drawer toggler
            const openMenuBtn = document.getElementById('open-menu-drawer');
            const closeMenuBtn = document.getElementById('close-menu-drawer');
            const menuDrawer = document.getElementById('mobile-menu-drawer');

            if (openMenuBtn && closeMenuBtn && menuDrawer) {
                openMenuBtn.addEventListener('click', function() {
                    menuDrawer.classList.remove('-translate-x-full');
                });
                closeMenuBtn.addEventListener('click', function() {
                    menuDrawer.classList.add('-translate-x-full');
                });
            }

            // Toggle category accordion function
            window.toggleCategoryAccordion = function(button, panelId) {
                const panel = document.getElementById(panelId);
                const icon = button.querySelector('i');
                if (!panel) return;
                
                if (panel.style.maxHeight && panel.style.maxHeight !== '0px') {
                    panel.style.maxHeight = '0px';
                    icon.classList.remove('rotate-90');
                } else {
                    // Close other sub-accordions
                    document.querySelectorAll('[id^="cat-"]').forEach(p => {
                        if (p.id !== panelId) {
                            p.style.maxHeight = '0px';
                            const otherBtn = p.previousElementSibling.querySelector('button');
                            if (otherBtn) {
                                const otherIcon = otherBtn.querySelector('i');
                                if (otherIcon) otherIcon.classList.remove('rotate-90');
                            }
                        }
                    });
                    panel.style.maxHeight = panel.scrollHeight + 'px';
                    icon.classList.add('rotate-90');
                }
            };
        });
    </script>


    <!-- Main Content -->

    <!-- THIẾT KẾ MỚI (TRANSPARENT HEADER COMPATIBILITY): -->
    <main class="min-h-screen {{ (request()->routeIs('home') || request()->routeIs('custom.login') || request()->routeIs('register')) ? 'pt-[124px] lg:pt-0' : 'pt-[124px] lg:pt-[80px]' }}">
        <div class="{{ (request()->routeIs('home') || request()->routeIs('custom.login') || request()->routeIs('register')) ? '' : 'px-4 pb-16' }}">
            @yield('content')
        </div>
    </main>

    <!-- Footer from Stitch -->
    <!-- Footer from Stitch -->
    <footer class="bg-slate-50 dark:bg-slate-950 w-full pt-16 pb-8 font-sans text-sm">
        <!-- Logo on mobile only -->
        <div class="flex justify-center mb-8 md:hidden px-6">
            <img src="{{ asset('images/logo-weblinhkien-Photoroom.png') }}?v=2" alt="TechFlow Logo"
                class="w-[200px] h-[71px] object-contain">
        </div>

        <style>
            @media (max-width: 767px) {
                .footer-content {
                    max-height: 0;
                    opacity: 0;
                    overflow: hidden;
                    transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease-out;
                }
            }
        </style>

        <div class="flex flex-col md:grid md:grid-cols-4 gap-3 md:gap-8 px-6 lg:px-12 max-w-[1400px] mx-auto">
            <!-- Về TechFlow -->
            <div class="footer-column">
                <button type="button" class="footer-header-btn w-full flex items-center justify-between px-4 py-3 md:px-0 md:py-0 bg-slate-100 dark:bg-slate-900 md:bg-transparent rounded-lg md:rounded-none text-[13px] font-black uppercase tracking-widest text-slate-800 dark:text-slate-200 md:text-slate-900 md:dark:text-white mb-2 md:mb-6 focus:outline-none">
                    <span>Về TechFlow</span>
                    <i class="fa-solid fa-chevron-right text-xs transition-all duration-300 md:hidden"></i>
                </button>
                <div class="footer-content pb-4 md:pb-0">
                    <!-- Logo on desktop only -->
                    <div class="mb-6 hidden md:flex items-center">
                        <img src="{{ asset('images/logo-weblinhkien-Photoroom.png') }}?v=2" alt="TechFlow Logo"
                            class="w-[200px] h-[71px] object-contain">
                    </div>
                    <div class="text-slate-500 dark:text-slate-400 text-[13px] leading-relaxed mt-2 md:mt-0">
                        TECHFLOW là đơn vị chuyên cung cấp Bàn phím, Chuột, Tai nghe và các sản phẩm linh kiện máy tính giá tốt nhất thị trường.
                    </div>
                </div>
            </div>

            <!-- Liên hệ và hỗ trợ -->
            <div class="footer-column">
                <button type="button" class="footer-header-btn w-full flex items-center justify-between px-4 py-3 md:px-0 md:py-0 bg-slate-100 dark:bg-slate-900 md:bg-transparent rounded-lg md:rounded-none text-[13px] font-black uppercase tracking-widest text-slate-800 dark:text-slate-200 md:text-slate-900 md:dark:text-white mb-2 md:mb-6 focus:outline-none">
                    <span>Liên hệ và hỗ trợ</span>
                    <i class="fa-solid fa-chevron-right text-xs transition-all duration-300 md:hidden"></i>
                </button>
                <div class="footer-content pb-4 md:pb-0">
                    <ul class="space-y-4 mt-3 md:mt-0">
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
            </div>

            <!-- Kết nối -->
            <div class="footer-column">
                <button type="button" class="footer-header-btn w-full flex items-center justify-between px-4 py-3 md:px-0 md:py-0 bg-slate-100 dark:bg-slate-900 md:bg-transparent rounded-lg md:rounded-none text-[13px] font-black uppercase tracking-widest text-slate-800 dark:text-slate-200 md:text-slate-900 md:dark:text-white mb-2 md:mb-6 focus:outline-none">
                    <span>Kết nối</span>
                    <i class="fa-solid fa-chevron-right text-xs transition-all duration-300 md:hidden"></i>
                </button>
                <div class="footer-content pb-4 md:pb-0">
                    <div class="flex gap-4 mt-4 md:mt-0">
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
            </div>

            <!-- Chính sách -->
            <div class="footer-column">
                <button type="button" class="footer-header-btn w-full flex items-center justify-between px-4 py-3 md:px-0 md:py-0 bg-slate-100 dark:bg-slate-900 md:bg-transparent rounded-lg md:rounded-none text-[13px] font-black uppercase tracking-widest text-slate-800 dark:text-slate-200 md:text-slate-900 md:dark:text-white mb-2 md:mb-6 focus:outline-none">
                    <span>Chính sách</span>
                    <i class="fa-solid fa-chevron-right text-xs transition-all duration-300 md:hidden"></i>
                </button>
                <div class="footer-content pb-4 md:pb-0">
                    <ul class="space-y-4 mt-3 md:mt-0">
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
                    
                    popover.originalCard = card;
                    let hideTimeout = null;

                    const showPopover = () => {
                        const isMobile = window.innerWidth < 1024 || 
                                         ('ontouchstart' in window) || 
                                         (navigator.maxTouchPoints > 0) ||
                                         window.matchMedia("(pointer: coarse)").matches;
                        if (isMobile) return;
                        
                        if (hideTimeout) {
                            clearTimeout(hideTimeout);
                            hideTimeout = null;
                        }
                        
                        // Close any other open popovers first
                        document.querySelectorAll('.product-popover').forEach(p => {
                            if (p !== popover && !p.classList.contains('hidden')) {
                                p.style.opacity = '0';
                                p.classList.add('hidden');
                                p.classList.remove('flex');
                                p.classList.add('pointer-events-none');
                                if (p.originalCard) {
                                    p.originalCard.appendChild(p);
                                    p.originalCard.style.zIndex = '';
                                }
                            }
                        });

                        card.style.zIndex = '500';
                        popover.classList.remove('hidden');
                        popover.classList.add('flex');
                        popover.classList.remove('pointer-events-none');
                        
                        if (popover.parentNode !== document.body) {
                            document.body.appendChild(popover);
                        }
                        
                        setTimeout(() => popover.style.opacity = '1', 10);
                    };

                    const hidePopover = () => {
                        if (hideTimeout) clearTimeout(hideTimeout);
                        hideTimeout = setTimeout(() => {
                            card.style.zIndex = '';
                            popover.style.opacity = '0';
                            setTimeout(() => {
                                if (popover.style.opacity === '0') {
                                    popover.classList.add('hidden');
                                    popover.classList.remove('flex');
                                    popover.classList.add('pointer-events-none');
                                    card.appendChild(popover);
                                }
                            }, 200);
                            hideTimeout = null;
                        }, 100);
                    };

                    trigger.addEventListener('mouseenter', showPopover);
                    trigger.addEventListener('mouseleave', hidePopover);
                    
                    popover.addEventListener('mouseenter', showPopover);
                    popover.addEventListener('mouseleave', hidePopover);

                    trigger.addEventListener('mousemove', (e) => {
                        const popoverWidth = 350;
                        const xOffset = 5;
                        const yOffset = 5;
                        
                        let x = e.clientX + xOffset;
                        let y = e.clientY - popover.offsetHeight - yOffset;
                        
                        if (x + popoverWidth > window.innerWidth) {
                            x = e.clientX - popoverWidth - xOffset;
                        }
                        
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

            // Footer Accordion on Mobile (Animate height smoothly)
            document.querySelectorAll('.footer-header-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    if (window.innerWidth >= 768) return;
                    
                    const content = btn.nextElementSibling;
                    const chevron = btn.querySelector('i');
                    
                    const isOpen = content.classList.contains('active-accordion');
                    
                    if (isOpen) {
                        content.style.maxHeight = '0px';
                        content.style.opacity = '0';
                        content.classList.remove('active-accordion');
                        if (chevron) {
                            chevron.style.transform = 'rotate(0deg)';
                        }
                    } else {
                        // Close any other open accordions first
                        document.querySelectorAll('.footer-content').forEach(el => {
                            if (el.classList.contains('active-accordion') && el !== content) {
                                el.style.maxHeight = '0px';
                                el.style.opacity = '0';
                                el.classList.remove('active-accordion');
                                const otherBtn = el.previousElementSibling;
                                const otherChevron = otherBtn ? otherBtn.querySelector('i') : null;
                                if (otherChevron) {
                                    otherChevron.style.transform = 'rotate(0deg)';
                                }
                            }
                        });
                        
                        content.classList.add('active-accordion');
                        content.style.maxHeight = content.scrollHeight + 'px';
                        content.style.opacity = '1';
                        if (chevron) {
                            chevron.style.transform = 'rotate(90deg)';
                        }
                    }
                });
            });

            // Search Suggestions Logic
            const searchInputs = [
                document.getElementById('search-input'),
                document.getElementById('search-input-compact'),
                document.getElementById('search-input-mobile')
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reveal on Scroll Logic
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>