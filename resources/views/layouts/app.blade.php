<!DOCTYPE html>
<html lang="vi" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang chủ') - TechFlow</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                    fontFamily: { "headline": ["Inter"], "body": ["Inter"], "label": ["Inter"], "display": ["Inter", "sans-serif"] },
                    borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem"},
                },
            },
        }
    </script>

    
    <!-- Tailwind CSS (Vite via App) and configuration fallback -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
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
    </style>
</head>
<body class="bg-background dark:bg-slate-900 text-on-surface dark:text-slate-100 antialiased font-['Inter']">

<!-- Top NavBar from Stitch -->
<header class="fixed top-0 w-full z-50 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 shadow-sm font-['Inter'] antialiased">
    <nav class="flex justify-between items-center h-16 w-full max-w-[1400px] mx-auto px-4">
        <a href="{{ route('home') }}" class="text-2xl font-black tracking-tighter text-slate-900 dark:text-white uppercase flex items-center gap-2">
            <i class="fa-solid fa-terminal text-primary text-2xl"></i> TECHFLOW
        </a>
        
        <!-- Navigation Links -->
        <div class="hidden lg:flex items-center space-x-8">
            <a class="{{ request()->routeIs('home') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-slate-600 dark:text-slate-400 font-medium hover:text-primary transition-colors' }}" href="{{ route('home') }}">Trang chủ</a>
            <a class="{{ request()->routeIs('store.index') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-slate-600 dark:text-slate-400 font-medium hover:text-primary transition-colors' }}" href="{{ route('store.index') }}">Sản phẩm</a>
            <a class="text-slate-600 dark:text-slate-400 font-medium hover:text-primary transition-colors" href="#">Danh mục</a>
            <a class="text-slate-600 dark:text-slate-400 font-medium hover:text-primary transition-colors" href="#">Tin tức</a>
            <a class="text-slate-600 dark:text-slate-400 font-medium hover:text-primary transition-colors" href="#">Liên hệ</a>
        </div>
        
        <!-- Search & Actions -->
        <div class="flex items-center gap-6">
            <div class="hidden md:flex relative items-center">
                <input class="bg-surface-container-high dark:bg-slate-800 border-none rounded-lg py-2 pl-4 pr-10 w-64 focus:ring-2 focus:ring-primary text-sm outline-none dark:text-white" placeholder="Tìm kiếm linh kiện..." type="text"/>
                <i class="fa-solid fa-magnifying-glass absolute right-3 text-on-surface-variant dark:text-slate-400"></i>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('cart.index') }}" class="relative hover:opacity-80 transition-opacity scale-105 duration-200 block text-slate-700 dark:text-slate-300 hover:text-primary">
                    <i class="fa-solid fa-cart-shopping text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">0</span>
                </a>
                
                @guest
                    <a href="{{ route('custom.login') }}" class="hover:opacity-80 transition-opacity scale-105 duration-200 block text-slate-700 dark:text-slate-300 hover:text-primary">
                        <i class="fa-solid fa-user text-lg"></i>
                    </a>
                @else
                    <div class="relative group">
                        <button class="flex items-center hover:opacity-80 transition-opacity scale-105 duration-200 text-slate-700 dark:text-slate-300 hover:text-primary focus:outline-none">
                            <i class="fa-solid fa-user text-lg"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 overflow-hidden">
                            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700">
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                            </div>
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-primary">Hồ sơ của tôi</a>
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-primary">Trang quản trị</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="m-0 border-t border-slate-100 dark:border-slate-700">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 font-medium">Đăng xuất</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</header>

<!-- Alerts -->
@if(session('success') || session('error'))
<div class="pt-24 max-w-[1400px] mx-auto px-4 z-40 relative">
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 px-4 py-3 rounded-lg flex items-center gap-3 shadow-sm mb-4">
            <i class="fa-solid fa-circle-check"></i>
            <p class="font-medium text-sm">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 px-4 py-3 rounded-lg flex items-center gap-3 shadow-sm mb-4">
            <i class="fa-solid fa-circle-exclamation"></i>
            <p class="font-medium text-sm">{{ session('error') }}</p>
        </div>
    @endif
</div>
@endif

<!-- Main Content -->
<main class="min-h-screen {{ request()->routeIs('home') ? 'pt-16' : 'pt-24 max-w-[1400px] mx-auto px-4 pb-16' }}">
    @yield('content')
</main>

<!-- Footer from Stitch -->
<footer class="bg-slate-50 dark:bg-slate-950 w-full pt-16 pb-8 font-['Inter'] text-sm">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 px-6 lg:px-12 max-w-[1400px] mx-auto">
        <div>
            <div class="flex items-center gap-2 mb-6">
                <i class="fa-solid fa-terminal text-primary text-2xl"></i>
                <div class="text-lg font-black tracking-tighter text-slate-900 dark:text-white uppercase">TECHFLOW</div>
            </div>
            <ul class="space-y-4">
                <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4" href="#">Về TechFlow</a></li>
                <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4" href="#">Tuyển dụng</a></li>
                <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4" href="#">Hệ thống cửa hàng</a></li>
            </ul>
        </div>
        <div>
            <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-white mb-6">Hỗ trợ</div>
            <ul class="space-y-4">
                <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4" href="#">Hướng dẫn mua hàng</a></li>
                <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4" href="#">Chính sách bảo hành</a></li>
                <li><a class="text-slate-500 dark:text-slate-400 hover:text-primary transition-all duration-300 hover:underline decoration-primary underline-offset-4" href="#">Trả góp 0%</a></li>
            </ul>
        </div>
        <div>
            <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-white mb-6">Kết nối</div>
            <div class="flex gap-4">
                <a class="w-10 h-10 bg-slate-200 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-all text-sm" href="#">
                    <i class="fa-solid fa-share-nodes"></i>
                </a>
                <a class="w-10 h-10 bg-slate-200 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-all text-sm" href="#">
                    <i class="fa-brands fa-youtube"></i>
                </a>
                <a class="w-10 h-10 bg-slate-200 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-all text-sm" href="#">
                    <i class="fa-solid fa-comments"></i>
                </a>
            </div>
        </div>
        <div>
            <div class="text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-white mb-6">Thanh toán</div>
            <div class="grid grid-cols-3 gap-2 opacity-60">
                <div class="bg-white dark:bg-slate-800 dark:border-slate-700 border p-1 rounded h-8 flex items-center justify-center text-[8px] font-black text-slate-900 dark:text-slate-100">VISA</div>
                <div class="bg-white dark:bg-slate-800 dark:border-slate-700 border p-1 rounded h-8 flex items-center justify-center text-[8px] font-black text-slate-900 dark:text-slate-100">MOMO</div>
                <div class="bg-white dark:bg-slate-800 dark:border-slate-700 border p-1 rounded h-8 flex items-center justify-center text-[8px] font-black text-slate-900 dark:text-slate-100">ZALO</div>
            </div>
        </div>
    </div>
    <div class="bg-slate-200 dark:bg-slate-800 h-px w-full my-8"></div>
    <div class="px-6 lg:px-12 max-w-[1400px] mx-auto text-center text-slate-400 text-xs">
        © 2024 TechFlow. Precision Engineered Hardware.
    </div>
</footer>

<!-- Alpine.js (Optional if needed for other components) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
