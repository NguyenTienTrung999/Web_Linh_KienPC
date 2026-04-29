@extends('layouts.admin')

@section('title', 'Thêm Thương Hiệu Mới - TechFlow Admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <div class="text-primary">
            <i class="fa-solid fa-circle-plus text-3xl"></i>
        </div>
        <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">Thêm thương hiệu mới</h2>
    </div>
    
    <a href="{{ route('admin.brands.index') }}" class="text-slate-500 hover:text-slate-700 dark:hover:text-slate-300 font-bold text-sm flex items-center gap-2 transition-colors">
        <i class="fa-solid fa-arrow-left"></i>
        Quay lại danh sách
    </a>
</div>

@if ($errors->any())
    <div class="mb-6 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 p-4 rounded-lg border border-red-200 dark:border-red-800">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-2xl mx-auto">
    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
        @csrf
        <div class="p-6 space-y-6">
            <div class="space-y-2">
                <label class="text-sm font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Tên thương hiệu *</label>
                <input name="name" value="{{ old('name') }}" required class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg py-3 px-4 focus:ring-primary focus:border-primary text-slate-900 dark:text-white font-medium" placeholder="VD: Logitech, Razer, Asus..." type="text"/>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-black uppercase tracking-wider text-slate-500 dark:text-slate-400">Logo thương hiệu</label>
                <div class="flex items-center gap-6">
                    <div id="logo-preview-container" class="w-24 h-24 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 flex items-center justify-center overflow-hidden">
                        <i class="fa-solid fa-image text-3xl text-slate-300"></i>
                    </div>
                    <div class="flex-grow">
                        <input type="file" name="logo" id="logo-input" class="hidden" accept="image/*" onchange="previewLogo(event)">
                        <button type="button" onclick="document.getElementById('logo-input').click()" class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 px-4 py-2 rounded-lg text-sm font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors inline-flex items-center gap-2">
                            <i class="fa-solid fa-upload"></i>
                            Chọn Logo
                        </button>
                        <p class="text-xs text-slate-500 mt-2 italic">Dịnh dạng: PNG, JPG, WebP. Tối đa 2MB.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex justify-end gap-3">
            <a href="{{ route('admin.brands.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                Hủy bỏ
            </a>
            <button type="submit" class="bg-primary text-white px-8 py-2.5 rounded-lg text-sm font-bold hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
                Lưu thương hiệu
            </button>
        </div>
    </form>
</div>

<script>
    function previewLogo(event) {
        const input = event.target;
        const container = document.getElementById('logo-preview-container');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-contain">`;
                container.classList.remove('border-dashed');
                container.classList.add('border-solid', 'border-primary/30');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
