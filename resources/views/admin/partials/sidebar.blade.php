<aside class="w-64 flex-shrink-0 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 flex flex-col">
    <div class="p-6 flex items-center gap-3">
        <div class="w-8 h-8 bg-primary rounded flex items-center justify-center text-white">
            <span class="material-symbols-outlined">bolt</span>
        </div>
        <div class="flex flex-col">
            <h1 class="text-lg font-bold leading-tight tracking-tight">TechFlow</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">Quản trị hệ thống</p>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-sm">Tổng quan</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-primary/10 text-primary font-medium' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors' }}" href="{{ route('admin.products.index') }}">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="text-sm">Sản phẩm</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
            <span class="material-symbols-outlined">shopping_cart</span>
            <span class="text-sm">Đơn hàng</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
            <span class="material-symbols-outlined">group</span>
            <span class="text-sm">Khách hàng</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
            <span class="material-symbols-outlined">bar_chart</span>
            <span class="text-sm">Báo cáo</span>
        </a>
        
        <div class="pt-4 mt-4 border-t border-slate-100 dark:border-slate-800">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
                <span class="material-symbols-outlined">settings</span>
                <span class="text-sm">Cài đặt</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="{{ route('home') }}" target="_blank">
                <span class="material-symbols-outlined">open_in_new</span>
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
                <button type="submit" class="material-symbols-outlined text-slate-400 hover:text-red-500 transition-colors text-sm cursor-pointer" title="Đăng xuất">logout</button>
            </form>
        </div>
    </div>
</aside>
