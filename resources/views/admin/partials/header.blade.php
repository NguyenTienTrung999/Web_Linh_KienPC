<header class="h-16 border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 flex items-center justify-between px-8">
    <div class="flex items-center gap-4 flex-1 max-w-md">
        <div class="relative w-full">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">search</span>
            <input class="w-full pl-10 pr-4 py-2 bg-slate-100 dark:bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary/50 transition-all" placeholder="Tìm kiếm dữ liệu..." type="text"/>
        </div>
    </div>
    
    <div class="flex items-center gap-4">
        <button class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
            <span class="material-symbols-outlined">notifications</span>
        </button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400">
            <span class="material-symbols-outlined">help</span>
        </button>
        <div class="h-8 w-[1px] bg-slate-200 dark:border-slate-800 mx-2"></div>
        <div class="flex items-center gap-2">
            <span class="text-sm font-medium">Xin chào, {{ explode(' ', auth()->user()->name ?? 'Admin')[count(explode(' ', auth()->user()->name ?? 'Admin')) - 1] }}</span>
            <div class="w-8 h-8 rounded-full bg-slate-200 bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name=Admin+User&background=2badee&color=fff')"></div>
        </div>
    </div>
</header>
