<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang chủ') - TechFlow</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons for fallback if needed, but styling prefers Material Symbols -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0 group">
                    <span class="material-symbols-outlined text-primary text-3xl transition-transform group-hover:scale-110">terminal</span>
                    <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white uppercase transition-colors group-hover:text-primary">TechFlow</span>
                </a>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-md">
                    <form action="{{ route('home') }}" method="GET" class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
                        </div>
                        <input name="search" class="block w-full pl-10 pr-3 py-2 border-none bg-slate-100 dark:bg-slate-800 rounded-lg leading-5 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:bg-white dark:focus:bg-slate-900 sm:text-sm transition-colors text-slate-900 dark:text-white" placeholder="Tìm kiếm phần cứng..." type="text" value="{{ request('search') }}"/>
                    </form>
                </div>

                <!-- Nav Links & Icons -->
                <nav class="flex items-center gap-6">
                    <div class="hidden lg:flex items-center gap-6">
                        <a class="text-sm font-medium hover:text-primary transition-colors py-2 relative group {{ request()->routeIs('store.index') ? 'text-primary' : '' }}" href="{{ route('store.index') }}">
    Cửa hàng
    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left {{ request()->routeIs('store.index') ? 'scale-x-100' : '' }}"></span>
</a>
<a class="text-sm font-medium hover:text-primary transition-colors py-2 relative group" href="{{ route('store.index') }}">
    Danh mục
    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
</a>
<a class="text-sm font-medium hover:text-primary transition-colors py-2 relative group" href="{{ route('store.index') }}">
    Ưu đãi
    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
</a>                        
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-orange-500 hover:text-orange-400 transition-colors py-2 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-lg">admin_panel_settings</span> Quản trị
                                </a>
                            @endif
                        @endauth
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('cart.index') }}" class="p-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors relative group">
                            <span class="material-symbols-outlined group-hover:scale-110 transition-transform">shopping_cart</span>
                            <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white shadow-sm">3</span>
                        </a>
                        
                        @guest
                            <a href="{{ route('custom.login') }}" class="p-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors" title="Đăng nhập">
                                <span class="material-symbols-outlined">login</span>
                            </a>
                        @else
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="p-2 flex items-center gap-1 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">person</span>
                                    <span class="material-symbols-outlined text-sm">expand_more</span>
                                </button>
                                <!-- Dropdown -->
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute right-0 mt-2 w-48 rounded-xl shadow-xl shadow-black/20 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1 z-50">
                                    <div class="px-4 py-2 border-b border-slate-200 dark:border-slate-700">
                                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                                    </div>
                                    <a href="{{ route('profile.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-sm">settings</span> Hồ sơ
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">logout</span> Đăng xuất
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                        
                        <!-- Mobile menu button -->
                        <button class="md:hidden p-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Alerts -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 px-4 py-3 rounded-lg flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined">check_circle</span>
                <p class="font-medium text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 px-4 py-3 rounded-lg flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined">error</span>
                <p class="font-medium text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-100 dark:bg-slate-950 pt-16 pb-8 border-t border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-16">
                <!-- Branding -->
                <div class="col-span-2 lg:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">terminal</span>
                        <h1 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white uppercase">TechFlow</h1>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 mb-6 max-w-sm">
                        Điểm đến cuối cùng cho phần cứng và phụ kiện máy tính cao cấp. Chúng tôi giúp bạn xây dựng không gian trong mơ.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full border border-slate-300 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white hover:border-primary transition-all shadow-sm">
                            <span class="material-symbols-outlined text-sm">public</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-slate-300 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white hover:border-primary transition-all shadow-sm">
                            <span class="material-symbols-outlined text-sm">share</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-slate-300 dark:border-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white hover:border-primary transition-all shadow-sm">
                            <span class="material-symbols-outlined text-sm">mail</span>
                        </a>
                    </div>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-6">Công ty</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Về chúng tôi</a></li>
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Tuyển dụng</a></li>
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Blog</a></li>
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Liên hệ</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-6">Hỗ trợ</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Trung tâm trợ giúp</a></li>
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Giao hàng</a></li>
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Đổi trả</a></li>
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Bảo hành</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-6">Pháp lý</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Chính sách bảo mật</a></li>
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Điều khoản dịch vụ</a></li>
                        <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary hover:translate-x-1 inline-block transition-all">Cookies</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-200 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-sm">&copy; {{ date('Y') }} TechFlow. Bảo lưu mọi quyền.</p>
                <div class="flex items-center gap-6">
                    <span class="material-symbols-outlined text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">payments</span>
                    <span class="material-symbols-outlined text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">credit_card</span>
                    <span class="material-symbols-outlined text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">account_balance_wallet</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
