<aside class="w-full lg:w-64 flex flex-col gap-2">
    <div class="p-4 mb-4 bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 flex items-center gap-3">
        <div class="h-12 w-12 rounded-full overflow-hidden bg-primary/10 flex items-center justify-center text-primary border border-slate-100 dark:border-slate-800">
            @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
            @else
                <img alt="Placeholder" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"/>
            @endif
        </div>
        <div>
            <p class="font-bold text-sm truncate max-w-[120px]">{{ $user->name }}</p>
            <p class="text-xs text-slate-500 capitalize">{{ $user->role ?? 'Thành viên' }}</p>
        </div>
    </div>
    <nav class="flex flex-col gap-1">
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile.index') ? 'bg-primary text-white font-medium shadow-md shadow-primary/20' : 'hover:bg-white dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 font-medium transition-all group' }}" href="{{ route('profile.index') }}">
            <i class="fa-solid fa-user text-lg {{ request()->routeIs('profile.index') ? '' : 'group-hover:text-primary' }}"></i>
            <span class="text-sm {{ request()->routeIs('profile.index') ? '' : 'group-hover:text-primary' }}">Thông tin cá nhân</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile.orders') ? 'bg-primary text-white font-medium shadow-md shadow-primary/20' : 'hover:bg-white dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 font-medium transition-all group' }}" href="{{ route('profile.orders') }}">
            <i class="fa-solid fa-box text-lg {{ request()->routeIs('profile.orders') ? '' : 'group-hover:text-primary' }}"></i>
            <span class="text-sm {{ request()->routeIs('profile.orders') ? '' : 'group-hover:text-primary' }}">Đơn hàng của tôi</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile.addresses') ? 'bg-primary text-white font-medium shadow-md shadow-primary/20' : 'hover:bg-white dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 font-medium transition-all group' }}" href="{{ route('profile.addresses') }}">
            <i class="fa-solid fa-location-dot text-lg {{ request()->routeIs('profile.addresses') ? '' : 'group-hover:text-primary' }}"></i>
            <span class="text-sm {{ request()->routeIs('profile.addresses') ? '' : 'group-hover:text-primary' }}">Sổ địa chỉ</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile.notifications') ? 'bg-primary text-white font-medium shadow-md shadow-primary/20' : 'hover:bg-white dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 font-medium transition-all group' }}" href="{{ route('profile.notifications') }}">
            <div class="relative">
                <i class="fa-solid fa-bell text-lg {{ request()->routeIs('profile.notifications') ? '' : 'group-hover:text-primary' }}"></i>
                @if($user->unreadNotifications->count() > 0)
                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                @endif
            </div>
            <span class="text-sm {{ request()->routeIs('profile.notifications') ? '' : 'group-hover:text-primary' }}">Thông báo</span>
        </a>
        <div class="my-2 border-t border-slate-200 dark:border-slate-800"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 text-red-500 font-medium transition-all">
                <i class="fa-solid fa-right-from-bracket text-lg"></i>
                <span class="text-sm">Đăng xuất</span>
            </button>
        </form>
    </nav>
</aside>
