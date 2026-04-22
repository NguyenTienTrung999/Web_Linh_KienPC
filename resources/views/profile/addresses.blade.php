@extends('layouts.app')

@section('title', 'Sổ địa chỉ')

@section('content')
<main class="flex-1 w-full max-w-[1440px] mx-auto px-4 md:px-10 lg:px-40 py-8 min-h-[calc(100vh-200px)]">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        @include('profile.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col gap-8">
            <section class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Sổ địa chỉ</h2>
                        <p class="text-sm text-slate-500 mt-1">Quản lý các địa chỉ giao hàng của bạn</p>
                    </div>
                    <button onclick="openModal('add')" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition-all">
                        <i class="fa-solid fa-plus"></i>
                        Thêm địa chỉ mới
                    </button>
                </div>

                <div class="p-6">
                    @if($addresses->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12 text-slate-400">
                            <i class="fa-solid fa-map-location-dot text-6xl opacity-20 mb-4"></i>
                            <p class="text-lg italic">Bạn chưa lưu địa chỉ nào.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($addresses as $address)
                            <div class="relative p-5 rounded-xl border-2 {{ $address->is_default ? 'border-primary bg-primary/5' : 'border-slate-100 dark:border-slate-800' }} group hover:border-primary/50 transition-all">
                                @if($address->is_default)
                                    <span class="absolute top-4 right-4 bg-primary text-white text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wider flex items-center gap-1">
                                        <i class="fa-solid fa-circle-check"></i> Mặc định
                                    </span>
                                @endif

                                <div class="flex items-start gap-3 mb-4">
                                    <div class="mt-1 size-8 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500">
                                        <i class="fa-solid {{ $address->label == 'Công ty' ? 'fa-building' : 'fa-house' }}"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                            {{ $address->label ?? 'Địa chỉ' }}
                                        </h3>
                                        <p class="text-sm font-semibold mt-1">{{ $address->receiver_name }}</p>
                                        <p class="text-sm text-slate-500">{{ $address->receiver_phone }}</p>
                                    </div>
                                </div>

                                <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 mb-6 h-10">
                                    {{ $address->address }}
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800">
                                    <div class="flex gap-4">
                                        <button onclick="editAddress({{ $address }})" class="text-xs font-bold text-primary hover:underline">Chỉnh sửa</button>
                                        <form action="{{ route('profile.address.delete', $address->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-bold text-red-500 hover:underline">Xóa</button>
                                        </form>
                                    </div>
                                    @if(!$address->is_default)
                                        <form action="{{ route('profile.address.set-default', $address->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-xs font-bold text-slate-500 hover:text-primary transition-colors">Đặt làm mặc định</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Address Modal -->
<div id="address-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative bg-white dark:bg-slate-900 w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
            <h3 id="modal-title" class="text-lg font-bold">Thêm địa chỉ mới</h3>
            <button onclick="closeModal()" class="size-8 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form id="address-form" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase">Tên người nhận</label>
                    <input name="receiver_name" id="receiver_name" type="text" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-primary h-12 px-4 shadow-sm">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase">Số điện thoại</label>
                    <input name="receiver_phone" id="receiver_phone" type="tel" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-primary h-12 px-4 shadow-sm">
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-500 uppercase">Địa chỉ chi tiết</label>
                <textarea name="address" id="address" rows="3" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-primary p-4 shadow-sm"></textarea>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-slate-500 uppercase">Loại địa chỉ</label>
                <div class="flex gap-4">
                    <label class="flex-1 border-2 border-slate-100 dark:border-slate-800 rounded-lg p-3 flex items-center justify-center gap-2 cursor-pointer hover:border-primary transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                        <input type="radio" name="label" value="Nhà riêng" class="hidden" checked>
                        <i class="fa-solid fa-house text-slate-400"></i>
                        <span class="text-sm font-bold">Nhà riêng</span>
                    </label>
                    <label class="flex-1 border-2 border-slate-100 dark:border-slate-800 rounded-lg p-3 flex items-center justify-center gap-2 cursor-pointer hover:border-primary transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                        <input type="radio" name="label" value="Công ty" class="hidden">
                        <i class="fa-solid fa-building text-slate-400"></i>
                        <span class="text-sm font-bold">Công ty</span>
                    </label>
                </div>
            </div>

            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" name="is_default" value="1" class="rounded border-slate-300 text-primary focus:ring-primary">
                <span class="text-sm text-slate-600 dark:text-slate-400 group-hover:text-slate-900 transition-colors">Đặt làm địa chỉ mặc định</span>
            </label>

            <div class="pt-6 flex gap-3">
                <button type="button" onclick="closeModal()" class="flex-1 h-12 rounded-xl font-bold text-slate-600 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Hủy</button>
                <button type="submit" class="flex-[2] h-12 rounded-xl bg-primary text-white font-bold hover:shadow-lg hover:shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">Lưu địa chỉ</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(type) {
        const modal = document.getElementById('address-modal');
        const form = document.getElementById('address-form');
        const title = document.getElementById('modal-title');
        const method = document.getElementById('form-method');

        if (type === 'add') {
            title.innerText = 'Thêm địa chỉ mới';
            form.action = "{{ route('profile.address.store') }}";
            method.value = "POST";
            form.reset();
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('address-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function editAddress(address) {
        openModal('edit');
        const title = document.getElementById('modal-title');
        const form = document.getElementById('address-form');
        const method = document.getElementById('form-method');

        title.innerText = 'Chỉnh sửa địa chỉ';
        form.action = `/my-addresses/${address.id}`;
        method.value = "PUT";

        document.getElementById('receiver_name').value = address.receiver_name;
        document.getElementById('receiver_phone').value = address.receiver_phone;
        document.getElementById('address').value = address.address;
        
        // Set radio button
        form.querySelectorAll('input[name="label"]').forEach(radio => {
            if (radio.value === address.label) radio.checked = true;
        });

        // Set checkbox
        form.querySelector('input[name="is_default"]').checked = address.is_default;
    }
</script>
@endsection
