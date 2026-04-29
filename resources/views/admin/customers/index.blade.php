@extends('layouts.admin')

@section('title', 'Quản lý khách hàng - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Danh sách khách hàng</h2>
            <p class="text-slate-500 text-sm font-medium">Xem và quản lý cơ sở người dùng của bạn</p>
        </div>
        <div class="flex items-center gap-3">
            <form action="{{ route('admin.customers.index') }}" method="GET" class="relative group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên, email, sđt..." class="bg-white dark:bg-slate-800 border-none rounded-2xl pl-10 pr-4 py-2.5 text-sm font-bold text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 w-64 transition-all">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors"></i>
            </form>
        </div>
    </div>



    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="px-8 py-5">Khách hàng</th>
                        <th class="px-8 py-5">Email & SĐT</th>
                        <th class="px-8 py-5">Ngày tham gia</th>
                        <th class="px-8 py-5 text-center">Đơn hàng</th>
                        <th class="px-8 py-5 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($customers as $user)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-indigo-500/5 transition-colors">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-2xl object-cover border-2 border-slate-100 dark:border-slate-800">
                                @else
                                    <div class="w-10 h-10 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center text-xs font-black uppercase border border-indigo-500/20">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                @endif
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-slate-900 dark:text-white group-hover:text-indigo-500 transition-colors">{{ $user->name }}</span>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Hi: {{ '@' . ($user->username ?? 'user_' . $user->id) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2 text-xs font-bold text-slate-600 dark:text-slate-400">
                                    <i class="fa-solid fa-envelope text-[10px] text-slate-400"></i>
                                    {{ $user->email }}
                                </div>
                                <div class="flex items-center gap-2 text-xs font-bold text-slate-600 dark:text-slate-400">
                                    <i class="fa-solid fa-phone text-[10px] text-slate-400"></i>
                                    {{ $user->phone ?? 'N/A' }}
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-bold text-slate-500">{{ $user->created_at->format('d/m/Y') }}</span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-lg text-[10px] font-black uppercase">
                                {{ number_format($user->orders()->count()) }} Đơn
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.customers.show', $user->id) }}" class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-400 hover:text-indigo-500 hover:border-indigo-500 flex items-center justify-center transition-all shadow-sm">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.customers.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này? Thao tác này không thể hoàn tác.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-slate-400 hover:text-rose-500 hover:border-rose-500 flex items-center justify-center transition-all shadow-sm">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-slate-400 text-sm italic font-medium">Không tìm thấy khách hàng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($customers->hasPages())
        <div class="px-8 py-6 border-t border-slate-50 dark:border-slate-800">
            {{ $customers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
