@extends('layouts.admin')

@section('title', 'Quản lý khách hàng - TechFlow Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Danh sách khách hàng</h2>
            <p class="text-slate-500 text-sm font-medium">Xem và quản lý cơ sở người dùng của bạn</p>
        </div>
        <div class="w-full md:w-auto flex items-center gap-4">
            <form action="{{ route('admin.customers.index') }}" method="GET" id="filter-form" class="w-full flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <select name="sort" onchange="this.form.submit()" class="w-full sm:w-auto bg-white dark:bg-slate-800 border-none rounded-2xl pl-4 pr-10 py-2.5 text-sm font-bold text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                    <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                    <option value="most_orders" {{ $sort == 'most_orders' ? 'selected' : '' }}>Nhiều đơn nhất</option>
                    <option value="highest_spending" {{ $sort == 'highest_spending' ? 'selected' : '' }}>Tổng chi lớn nhất</option>
                    <option value="highest_single_purchase" {{ $sort == 'highest_single_purchase' ? 'selected' : '' }}>Chi đơn lẻ lớn nhất</option>
                </select>
                
                <div class="relative group w-full sm:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên, email, sđt..." class="w-full bg-white dark:bg-slate-800 border-none rounded-2xl pl-10 pr-4 py-2.5 text-sm font-bold text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 transition-all">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                </div>
                
                @if(request('sort') || request('search'))
                    <a href="{{ route('admin.customers.index') }}" class="text-xs font-bold text-rose-500 hover:underline whitespace-nowrap text-center sm:text-left">Xóa lọc</a>
                @endif
            </form>
        </div>
    </div>



    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                        <th class="px-8 py-5">Khách hàng</th>
                        <th class="hidden md:table-cell px-8 py-5">Email & SĐT</th>
                        <th class="hidden md:table-cell px-8 py-5">Ngày tham gia</th>
                        <th class="hidden md:table-cell px-8 py-5 text-center">Đơn hàng</th>
                        <th class="hidden md:table-cell px-8 py-5 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($customers as $user)
                    <tr class="group hover:bg-slate-50/50 dark:hover:bg-indigo-500/5 transition-colors cursor-pointer md:cursor-default" onclick="handleCustomerRowClick(event, {
                        id: '{{ $user->id }}',
                        name: '{{ addslashes($user->name) }}',
                        username: '{{ addslashes($user->username ?? 'user_' . $user->id) }}',
                        email: '{{ $user->email }}',
                        phone: '{{ $user->phone ?? 'N/A' }}',
                        joinedAt: '{{ $user->created_at->format('d/m/Y') }}',
                        ordersCount: '{{ number_format($user->orders()->count()) }} Đơn',
                        showUrl: '{{ route('admin.customers.show', $user->id) }}',
                        deleteUrl: '{{ route('admin.customers.destroy', $user->id) }}',
                        canDelete: {{ auth()->id() !== $user->id ? 'true' : 'false' }}
                    })">
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
                        <td class="hidden md:table-cell px-8 py-5">
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
                        <td class="hidden md:table-cell px-8 py-5">
                            <span class="text-xs font-bold text-slate-500">{{ $user->created_at->format('d/m/Y') }}</span>
                        </td>
                        <td class="hidden md:table-cell px-8 py-5 text-center">
                            <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-lg text-[10px] font-black uppercase">
                                {{ number_format($user->orders()->count()) }} Đơn
                            </span>
                        </td>
                        <td class="hidden md:table-cell px-8 py-5 text-right">
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

<!-- Mobile Customer Detail Modal -->
<div id="customer-detail-modal" class="fixed inset-0 z-[10000] hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" onclick="if(event.target === this) closeCustomerModal()">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-sm w-full overflow-hidden shadow-2xl border border-slate-100 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="customer-modal-card">
        <!-- Header -->
        <div class="p-5 pb-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-base text-slate-900 dark:text-white">Chi tiết khách hàng</h3>
            <button onclick="closeCustomerModal()" class="text-slate-400 hover:text-slate-650 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>
        <!-- Body -->
        <div class="p-5 space-y-4">
            <div class="flex items-center gap-3">
                <div id="customer-modal-avatar-container" class="w-12 h-12 rounded-2xl overflow-hidden flex items-center justify-center border border-slate-150 dark:border-slate-700">
                </div>
                <div>
                    <h4 id="customer-modal-name" class="font-black text-sm text-slate-900 dark:text-white leading-snug"></h4>
                    <p class="text-[10px] text-slate-400 mt-0.5"><span id="customer-modal-username"></span> (ID: <span id="customer-modal-id"></span>)</p>
                </div>
            </div>
            
            <div class="divide-y divide-slate-100 dark:divide-slate-800 text-xs">
                <div class="py-2.5">
                    <span class="text-slate-500 block mb-1">Email:</span>
                    <p id="customer-modal-email" class="font-bold text-slate-900 dark:text-slate-100"></p>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Số điện thoại:</span>
                    <span id="customer-modal-phone" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Ngày tham gia:</span>
                    <span id="customer-modal-joined" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Đơn hàng đã đặt:</span>
                    <span id="customer-modal-orders" class="font-black text-indigo-600 dark:text-indigo-400"></span>
                </div>
            </div>
        </div>
        <!-- Footer / Actions -->
        <div class="p-5 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex items-center gap-3">
            <a id="customer-modal-show-btn" href="" class="flex-1 justify-center bg-primary text-white py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors text-xs shadow-md shadow-primary/10">
                <i class="fa-solid fa-eye"></i>
                Xem hồ sơ
            </a>
            <form id="customer-modal-delete-form" action="" method="POST" class="flex-1" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này? Thao tác này không thể hoàn tác.');">
                @csrf
                @method('DELETE')
                <button id="customer-modal-delete-btn" type="submit" class="w-full justify-center bg-red-500 hover:bg-red-650 text-white py-2.5 rounded-xl font-bold flex items-center gap-2 transition-colors text-xs shadow-md shadow-red-500/10 cursor-pointer">
                    <i class="fa-solid fa-trash-can"></i>
                    Xóa tài khoản
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function handleCustomerRowClick(event, data) {
        if (event.target.closest('button') || event.target.closest('form') || event.target.closest('a')) {
            return;
        }
        if (window.innerWidth >= 768) return;

        const modal = document.getElementById('customer-detail-modal');
        const card = document.getElementById('customer-modal-card');

        // Dynamically get the avatar element from row to keep user experience high
        const row = event.currentTarget;
        const avatarCell = row.cells[0];
        const avatarHTML = avatarCell.querySelector('img, div.w-10').outerHTML;
        
        document.getElementById('customer-modal-avatar-container').innerHTML = avatarHTML;
        document.getElementById('customer-modal-name').textContent = data.name;
        document.getElementById('customer-modal-username').textContent = '@' + data.username;
        document.getElementById('customer-modal-id').textContent = data.id;
        document.getElementById('customer-modal-email').textContent = data.email;
        document.getElementById('customer-modal-phone').textContent = data.phone;
        document.getElementById('customer-modal-joined').textContent = data.joinedAt;
        document.getElementById('customer-modal-orders').textContent = data.ordersCount;

        document.getElementById('customer-modal-show-btn').href = data.showUrl;
        
        const deleteForm = document.getElementById('customer-modal-delete-form');
        if (data.canDelete) {
            deleteForm.classList.remove('hidden');
            deleteForm.action = data.deleteUrl;
        } else {
            deleteForm.classList.add('hidden');
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeCustomerModal() {
        const modal = document.getElementById('customer-detail-modal');
        const card = document.getElementById('customer-modal-card');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
