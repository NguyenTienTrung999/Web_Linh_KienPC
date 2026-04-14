@extends('layouts.admin')

@section('title', 'Thêm Sản Phẩm Mới - TechFlow Admin')

@section('content')
<!-- Header Area inside content -->
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <div class="text-primary">
            <i class="fa-solid fa-square-plus text-3xl"></i>
        </div>
        <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">Thêm sản phẩm mới</h2>
    </div>
    
    <div class="flex items-center gap-4">
        <button type="submit" form="product-create-form" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors">
            <i class="fa-solid fa-floppy-disk text-lg"></i>
            Lưu sản phẩm
        </button>
    </div>
</div>

<nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-6">
    <a href="{{ route('admin.products.index') }}" class="hover:text-primary transition-colors">Sản phẩm</a>
    <span class="text-slate-500"><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
    <span class="text-slate-900 dark:text-white font-medium">Thêm sản phẩm mới</span>
</nav>

@if ($errors->any())
    <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg border border-red-200">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="product-create-form" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="max-w-5xl mx-auto space-y-8">
        
        <!-- Basic Information Section -->
        <section class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Thông tin cơ bản</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">Nhập tên, danh mục và chi tiết giá sản phẩm</p>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Tên sản phẩm *</label>
                    <input name="name" value="{{ old('name') }}" required class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary" placeholder="VD: iPhone 15 Pro Max 256GB" type="text"/>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Danh mục *</label>
                    <select name="category_id" required class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Thương hiệu</label>
                    <input name="brand" value="{{ old('brand') }}" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary" placeholder="Apple, Samsung..." type="text"/>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Giá bán (VNĐ) *</label>
                    <input name="price" value="{{ old('price', 0) }}" required min="0" step="1000" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-primary font-bold" placeholder="0" type="number"/>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Giá khuyến mãi (VNĐ) <span class="text-xs font-normal text-slate-500">(Để trống nếu không giảm giá)</span></label>
                    <input name="sale_price" value="{{ old('sale_price') }}" min="0" step="1000" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-green-600 font-bold" placeholder="VD: 450000" type="number"/>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Số lượng tồn kho *</label>
                    <input name="stock_quantity" value="{{ old('stock_quantity', 1) }}" required min="0" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary" placeholder="0" type="number"/>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Mô tả sản phẩm</label>
                    <textarea name="description" rows="4" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary" placeholder="Nhập mô tả chi tiết...">{{ old('description') }}</textarea>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Media & Specs -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Specifications -->
                <section class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Thông số kỹ thuật</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Thêm các đặc tính kỹ thuật của sản phẩm</p>
                        </div>
                        <button type="button" onclick="addSpecRow()" class="text-primary hover:bg-primary/10 px-3 py-1 rounded text-sm font-bold flex items-center gap-1">
                            <i class="fa-solid fa-circle-plus text-lg"></i>
                            Thêm dòng mới
                        </button>
                    </div>
                    <div class="p-6 space-y-4" id="specifications-container">
                        @if(old('specs'))
                            @foreach(old('specs') as $index => $spec)
                            <div class="spec-row flex items-center gap-4">
                                <input name="specs[{{$index}}][key]" value="{{ $spec['key'] ?? '' }}" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Tên thông số (VD: RAM)" type="text">
                                <input name="specs[{{$index}}][value]" value="{{ $spec['value'] ?? '' }}" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Giá trị (VD: 8GB)" type="text">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 transition">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                            @endforeach
                        @else
                            <div class="spec-row flex items-center gap-4">
                                <input name="specs[0][key]" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Tên thông số (VD: RAM)" type="text">
                                <input name="specs[0][value]" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Giá trị (VD: 8GB)" type="text">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 transition">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Image Upload -->
                <section class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Hình ảnh sản phẩm</h3>
                    </div>
                    <div class="p-6">
                        <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-8 flex flex-col items-center justify-center text-center bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer group relative">
                            <img id="image-preview" src="#" alt="Preview" class="hidden w-full max-h-48 object-contain mb-4 rounded-lg">
                            <div id="upload-icon" class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-file-arrow-up text-3xl"></i>
                            </div>
                            <p id="upload-text" class="text-slate-900 dark:text-white font-bold">Nhấn để tải lên hoặc kéo thả</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">PNG, JPG tối đa 5MB (Khuyên dùng 1000x1000px)</p>
                            <input type="file" name="image" id="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)"/>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ảnh phụ (Gallery)</label>
                            <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col items-center justify-center text-center bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer group relative">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary mb-2 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-images text-xl"></i>
                                </div>
                                <p class="text-slate-900 dark:text-white font-bold text-sm">Chọn nhiều ảnh phụ</p>
                                <input type="file" name="gallery[]" id="gallery" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" multiple onchange="previewGallery(event)"/>
                            </div>
                            <div id="gallery-preview-container" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 empty:hidden">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            
            <!-- Right Column: Status & Publish -->
            <div class="space-y-8">
                <!-- Status Panel -->
                <section class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Trạng thái & Hiển thị</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Công khai sản phẩm</span>
                                <span class="text-xs text-slate-500">Sản phẩm sẽ hiển thị trên web</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Sản phẩm nổi bật</span>
                                <span class="text-xs text-slate-500">Gắn tag Hot & đưa lên đầu trang</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                    </div>
                </section>
                
                <!-- Tags -->
                <section class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Thẻ (Tags)</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <input name="tags" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Thêm thẻ, cách nhau bằng dấu phẩy" type="text" value="{{ old('tags') }}">
                        <div class="flex flex-wrap gap-2 text-slate-500 text-xs mt-1">
                            Phân cách thẻ bằng dấu phẩy.
                        </div>
                    </div>
                </section>
                
                <!-- Action Box -->
                <div class="p-6 bg-primary/5 rounded-xl border border-primary/20 space-y-4">
                    <p class="text-xs text-slate-600 dark:text-slate-400 italic">Kiểm tra lại tất cả các thông số trước khi lưu sản phẩm vào cơ sở dữ liệu.</p>
                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors">
                        <i class="fa-solid fa-upload"></i>
                        Đăng bán ngay
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="block text-center w-full border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 py-2 rounded-lg text-sm font-bold hover:bg-white dark:hover:bg-slate-800 transition-colors">
                        Hủy bỏ
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    let specIndex = {{ old('specs') ? count(old('specs')) : 1 }};
    
    function addSpecRow() {
        const container = document.getElementById('specifications-container');
        const row = document.createElement('div');
        row.className = 'spec-row flex items-center gap-4';
        row.innerHTML = `
            <input name="specs[${specIndex}][key]" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Tên thông số (VD: RAM)" type="text">
            <input name="specs[${specIndex}][value]" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Giá trị (VD: 8GB)" type="text">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 transition">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        `;
        container.appendChild(row);
        specIndex++;
    }

    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const icon = document.getElementById('upload-icon');
        const text = document.getElementById('upload-text');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                icon.classList.add('hidden');
                text.textContent = 'Thay đổi hình ảnh';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.classList.add('hidden');
            icon.classList.remove('hidden');
            text.textContent = 'Nhấn để tải lên hoặc kéo thả';
        }
    }

    function previewGallery(event) {
        const input = event.target;
        const container = document.getElementById('gallery-preview-container');
        container.innerHTML = '';
        
        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'aspect-square rounded border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 overflow-hidden';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endsection
