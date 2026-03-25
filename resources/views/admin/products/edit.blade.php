@extends('layouts.admin')

@section('title', 'Sửa Sản Phẩm - TechFlow Admin')

@section('content')
<!-- Header Area inside content -->
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-4">
        <div class="text-primary">
            <span class="material-symbols-outlined text-3xl">edit</span>
        </div>
        <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">Sửa sản phẩm</h2>
    </div>
    
    <div class="flex items-center gap-4">
        <button type="submit" form="product-edit-form" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors">
            <span class="material-symbols-outlined text-lg">save</span>
            Lưu thay đổi
        </button>
    </div>
</div>

<nav class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-6">
    <a href="{{ route('admin.products.index') }}" class="hover:text-primary transition-colors">Sản phẩm</a>
    <span class="material-symbols-outlined text-xs">chevron_right</span>
    <span class="text-slate-900 dark:text-white font-medium">Sửa sản phẩm</span>
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

<form id="product-edit-form" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="max-w-5xl mx-auto space-y-8">
        
        <!-- Basic Information Section -->
        <section class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Thông tin cơ bản</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">Cập nhật tên, danh mục và chi tiết giá sản phẩm</p>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Tên sản phẩm *</label>
                    <input name="name" value="{{ old('name', $product->name) }}" required class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary" placeholder="VD: iPhone 15 Pro Max 256GB" type="text"/>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Danh mục *</label>
                    <select name="category_id" required class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Thương hiệu</label>
                    <input name="brand" value="{{ old('brand', $product->brand ?? '') }}" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary" placeholder="Apple, Samsung..." type="text"/>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Giá bán (VNĐ) *</label>
                    <input name="price" value="{{ old('price', $product->price) }}" required min="0" step="1000" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-primary font-bold" placeholder="0" type="number"/>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Số lượng tồn kho *</label>
                    <input name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required min="0" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary" placeholder="0" type="number"/>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Mô tả sản phẩm</label>
                    <textarea name="description" rows="4" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary" placeholder="Nhập mô tả chi tiết...">{{ old('description', $product->description) }}</textarea>
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
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            Thêm dòng mới
                        </button>
                    </div>
                    <div class="p-6 space-y-4" id="specifications-container">
                        @php
                            $specs = old('specs', $product->specs ?? []);
                        @endphp
                        @if(is_array($specs) && count($specs) > 0)
                            @foreach($specs as $index => $spec)
                            <div class="spec-row flex items-center gap-4">
                                <input name="specs[{{$index}}][key]" value="{{ $spec['key'] ?? '' }}" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Tên thông số (VD: RAM)" type="text">
                                <input name="specs[{{$index}}][value]" value="{{ $spec['value'] ?? '' }}" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Giá trị (VD: 8GB)" type="text">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 transition">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </div>
                            @endforeach
                        @else
                            <div class="spec-row flex items-center gap-4">
                                <input name="specs[0][key]" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Tên thông số (VD: RAM)" type="text">
                                <input name="specs[0][value]" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Giá trị (VD: 8GB)" type="text">
                                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 transition">
                                    <span class="material-symbols-outlined">delete</span>
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
                        @if($product->image)
                        <div class="mb-6 flex gap-4 items-end">
                            <div class="shrink-0 p-2 border border-slate-200 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-800">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-contain rounded">
                            </div>
                            <div class="pb-2">
                                <p class="text-sm font-bold text-slate-900 dark:text-white">Ảnh hiện tại</p>
                                <p class="text-xs text-slate-500 mt-1">Chọn ảnh mới ở dưới nếu bạn muốn thay thế ảnh này.</p>
                            </div>
                        </div>
                        @endif
                        <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-8 flex flex-col items-center justify-center text-center bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer group relative">
                            <img id="image-preview" src="#" alt="Preview" class="hidden w-full max-h-48 object-contain mb-4 rounded-lg">
                            <div id="upload-icon" class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">upload_file</span>
                            </div>
                            <p id="upload-text" class="text-slate-900 dark:text-white font-bold">Nhấn để tải lên hoặc kéo thả</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">PNG, JPG tối đa 5MB</p>
                            <input type="file" name="image" id="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)"/>
                        </div>

                        <!-- Gallery section -->
                        <div class="mt-6 border-t border-slate-200 dark:border-slate-800 pt-6">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ảnh phụ (Gallery)</label>
                            
                            @if($product->gallery && is_array($product->gallery) && count($product->gallery) > 0)
                            <div class="mb-4 text-sm text-slate-500">Các ảnh phụ hiện tại (Tải thêm ảnh mới sẽ được giữ nguyên ảnh cũ):</div>
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-4 mb-4">
                                @foreach($product->gallery as $galImage)
                                <div class="aspect-square rounded border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-2">
                                    <img src="{{ asset('storage/' . $galImage) }}" class="w-full h-full object-contain rounded">
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl p-4 flex flex-col items-center justify-center text-center bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors cursor-pointer group relative">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary mb-2 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-xl">imagesmode</span>
                                </div>
                                <p class="text-slate-900 dark:text-white font-bold text-sm">Thêm nhiều ảnh phụ</p>
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
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Sản phẩm nổi bật</span>
                                <span class="text-xs text-slate-500">Gắn tag Hot & đưa lên đầu trang</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
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
                        <input name="tags" class="w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Thêm thẻ, cách nhau bằng dấu phẩy" type="text" value="{{ old('tags', $product->tags ?? '') }}">
                        <div class="flex flex-wrap gap-2 text-slate-500 text-xs mt-1">
                            Phân cách thẻ bằng dấu phẩy.
                        </div>
                    </div>
                </section>
                
                <!-- Action Box -->
                <div class="p-6 bg-primary/5 rounded-xl border border-primary/20 space-y-4">
                    <p class="text-xs text-slate-600 dark:text-slate-400 italic">Kiểm tra lại tất cả các thông số trước khi lưu thay đổi vào cơ sở dữ liệu.</p>
                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined">publish</span>
                        Lưu thay đổi
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
    let specIndex = {{ (is_array(old('specs', $product->specs ?? [])) && count(old('specs', $product->specs ?? [])) > 0) ? count(old('specs', $product->specs ?? [])) : 1 }};
    
    function addSpecRow() {
        const container = document.getElementById('specifications-container');
        const row = document.createElement('div');
        row.className = 'spec-row flex items-center gap-4';
        row.innerHTML = `
            <input name="specs[${specIndex}][key]" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Tên thông số (VD: RAM)" type="text">
            <input name="specs[${specIndex}][value]" class="w-1/2 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Giá trị (VD: 8GB)" type="text">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 transition">
                <span class="material-symbols-outlined">delete</span>
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

