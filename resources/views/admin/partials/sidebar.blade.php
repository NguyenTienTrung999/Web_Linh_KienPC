<aside id="admin-sidebar" class="w-64 flex-shrink-0 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 flex flex-col h-screen fixed lg:sticky top-0 left-0 z-[9999] transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <div class="p-6 flex items-center justify-between border-b border-slate-100 dark:border-slate-800">
        <a href="{{ route('admin.dashboard') }}" class="block flex items-center">
            <img src="{{ asset('images/logo-weblinhkien-Photoroom.png') }}?v=2" alt="TechFlow Admin Logo" class="w-[160px] h-[57px] object-contain">
        </a>
        <button type="button" onclick="toggleAdminSidebar()" class="lg:hidden text-slate-400 hover:text-slate-600 flex items-center justify-center w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 border border-slate-250 dark:border-slate-700">
            <i class="fa-solid fa-xmark text-base"></i>
        </button>
    </div>

    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-gauge-high w-5 text-center"></i>
            <span class="text-sm">Tổng quan</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.products.index') }}">
            <i class="fa-solid fa-boxes-stacked w-5 text-center"></i>
            <span class="text-sm">Sản phẩm</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.categories.index') }}">
            <i class="fa-solid fa-list w-5 text-center"></i>
            <span class="text-sm">Danh mục</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.brands.*') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.brands.index') }}">
            <i class="fa-solid fa-copyright w-5 text-center"></i>
            <span class="text-sm">Thương hiệu</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.coupons.*') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.coupons.index') }}">
            <i class="fa-solid fa-ticket w-5 text-center"></i>
            <span class="text-sm">Khuyến mãi</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.orders.index') }}">
            <i class="fa-solid fa-cart-shopping w-5 text-center"></i>
            <span class="text-sm">Đơn hàng</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.customers.*') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.customers.index') }}">
            <i class="fa-solid fa-users w-5 text-center"></i>
            <span class="text-sm">Khách hàng</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.reports.index') }}">
            <i class="fa-solid fa-chart-simple w-5 text-center"></i>
            <span class="text-sm">Báo cáo</span>
        </a>
        
        <div class="pt-4 mt-4 border-t border-slate-100 dark:border-slate-800">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
                <i class="fa-solid fa-gear w-5 text-center"></i>
                <span class="text-sm">Cài đặt</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="{{ route('home') }}" target="_blank">
                <i class="fa-solid fa-up-right-from-square w-5 text-center"></i>
                <span class="text-sm">Xem trang web</span>
            </a>
        </div>
    </nav>

    <div class="p-4 border-t border-slate-100 dark:border-slate-800">
        <div class="flex items-center gap-3 p-2 bg-slate-50 dark:bg-slate-800 rounded-lg">
            <div class="w-8 h-8 rounded-full bg-primary/20 bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name=Admin+User&background=2badee&color=fff')"></div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Admin User' }}</p>
                <p class="text-[10px] text-slate-500 truncate">{{ auth()->user()->email ?? 'admin@techflow.vn' }}</p>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors cursor-pointer" title="Đăng xuất">
                    <i class="fa-solid fa-right-from-bracket text-sm"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
