@extends('layouts.admin')

@section('content')
<!-- Title & Action -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Danh sách sản phẩm</h2>
        <p class="text-slate-500 mt-1 text-sm md:text-base">Quản lý kho hàng và thông tin sản phẩm của bạn.</p>
    </div>
    <div class="w-full md:w-auto">
        <a href="{{ route('admin.products.create') }}" class="w-full md:w-auto justify-center bg-primary text-white px-6 py-2.5 rounded-xl font-semibold flex items-center gap-2 hover:bg-primary/90 transition-shadow shadow-lg shadow-primary/20 text-sm">
            <i class="fa-solid fa-plus text-sm"></i>
            Thêm sản phẩm
        </a>
    </div>
</div>

<!-- Filters & Table Container -->
<div class="w-full max-w-full bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
    <!-- Filters Bar -->
    <div class="p-4 border-b border-slate-100 dark:border-slate-800 space-y-4">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-3 w-full">
            <div class="flex-1 w-full relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-700 dark:bg-slate-800 rounded-xl focus:ring-primary focus:border-primary text-sm" placeholder="Tìm theo tên sản phẩm..." type="text"/>
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto">
                <div class="flex-1 md:w-48">
                    <select name="category" class="w-full border border-slate-200 dark:border-slate-700 dark:bg-slate-800 rounded-xl py-2.5 focus:ring-primary focus:border-primary text-sm" onchange="this.form.submit()">
                        <option value="">Tất cả danh mục</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="shrink-0 flex items-center justify-center gap-2 px-6 py-2.5 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-sm font-semibold">
                    <i class="fa-solid fa-magnifying-glass text-slate-500 text-sm"></i>
                    <span>Tìm</span>
                </button>
            </div>
        </form>

        <!-- Tabs -->
        <div class="flex flex-wrap gap-1 border-b border-slate-100 dark:border-slate-800">
            <a href="{{ request()->fullUrlWithQuery(['status' => null, 'page' => 1]) }}" class="px-3 py-2 text-xs sm:text-sm font-semibold border-b-2 {{ !request('status') ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">Tất cả</a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'active', 'page' => 1]) }}" class="px-3 py-2 text-xs sm:text-sm font-semibold border-b-2 {{ request('status') == 'active' ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">Đang kinh doanh</a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'out_of_stock', 'page' => 1]) }}" class="shrink-0 px-3 py-2 text-xs sm:text-sm font-semibold border-b-2 {{ request('status') == 'out_of_stock' ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">Hết hàng</a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'inactive', 'page' => 1]) }}" class="shrink-0 px-3 py-2 text-xs sm:text-sm font-semibold border-b-2 {{ request('status') == 'inactive' ? 'border-primary text-primary' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">Ngừng kinh doanh</a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                <tr>
                    <th class="px-6 py-4">Sản phẩm</th>
                    <th class="hidden md:table-cell px-6 py-4">Danh mục</th>
                    <th class="hidden md:table-cell px-6 py-4">Giá bán</th>
                    <th class="hidden md:table-cell px-6 py-4">Tồn kho</th>
                    <th class="hidden md:table-cell px-6 py-4">Trạng thái</th>
                    <th class="hidden md:table-cell px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($products as $product)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group cursor-pointer md:cursor-default" onclick="handleRowClick(event, {
                        id: '{{ $product->id }}',
                        name: '{{ addslashes($product->name) }}',
                        image: '{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/100x100?text=No+Image' }}',
                        category: '{{ $product->category ? addslashes($product->category->name) : 'N/A' }}',
                        price: {{ $product->price }},
                        salePrice: {{ $product->sale_price ?? 'null' }},
                        stock: {{ $product->stock_quantity }},
                        isActive: {{ $product->is_active ? 'true' : 'false' }},
                        editUrl: '{{ route('admin.products.edit', $product) }}',
                        deleteUrl: '{{ route('admin.products.destroy', $product) }}'
                    })">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-slate-100 dark:bg-slate-800 overflow-hidden shrink-0 border border-slate-100 dark:border-slate-700">
                                    <img class="w-full h-full object-cover" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/100x100?text=No+Image' }}" alt="{{ $product->name }}"/>
                                </div>
                                <div class="max-w-[280px] md:max-w-[320px]">
                                    <p class="font-semibold text-slate-900 dark:text-slate-100 truncate text-sm sm:text-base" title="{{ $product->name }}">{{ $product->name }}</p>
                                    <p class="text-xs text-slate-500">ID: {{ $product->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden md:table-cell px-6 py-4">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded">
                                {{ $product->category ? $product->category->name : 'N/A' }}
                            </span>
                        </td>
                        <td class="hidden md:table-cell px-6 py-4">
                            @if($product->sale_price)
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-900 dark:text-white text-sm sm:text-base">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                                    <span class="text-[10px] text-slate-400 line-through">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                </div>
                            @else
                                <span class="font-semibold text-slate-900 dark:text-slate-100 text-sm sm:text-base">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                            @endif
                        </td>
                        <td class="hidden md:table-cell px-6 py-4 text-sm {{ $product->stock_quantity <= 0 ? 'text-red-500 font-medium' : '' }}">
                            {{ $product->stock_quantity }}
                        </td>
                        <td class="hidden md:table-cell px-6 py-4">
                            @if(!$product->is_active)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 dark:bg-slate-800 text-slate-650 dark:text-slate-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-550"></span>
                                    Ngừng kinh doanh
                                </span>
                            @elseif($product->stock_quantity > 0)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Đang kinh doanh
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Hết hàng
                                </span>
                            @endif
                        </td>
                        <td class="hidden md:table-cell px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                        <i class="fa-solid fa-trash-can text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                            Không có sản phẩm nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(method_exists($products, 'links'))
        <div class="p-4 border-t border-slate-100 dark:border-slate-800">
            {{ $products->links() }}
        </div>
    @endif
</div>

<!-- Mobile Product Detail Modal -->
<div id="product-detail-modal" class="fixed inset-0 z-[10000] hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" onclick="if(event.target === this) closeProductModal()">
    <div class="bg-white dark:bg-slate-900 rounded-2xl max-w-sm w-full overflow-hidden shadow-2xl border border-slate-100 dark:border-slate-800 transform scale-95 opacity-0 transition-all duration-300" id="modal-card">
        <!-- Header -->
        <div class="p-5 pb-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-base text-slate-900 dark:text-white">Chi tiết sản phẩm</h3>
            <button onclick="closeProductModal()" class="text-slate-400 hover:text-slate-650 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>
        <!-- Body -->
        <div class="p-5 space-y-4">
            <div class="flex items-center gap-3">
                <img id="modal-product-img" class="w-14 h-14 rounded-xl object-cover border border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800" src="" alt=""/>
                <div class="flex-1 min-w-0">
                    <h4 id="modal-product-name" class="font-bold text-slate-900 dark:text-white leading-snug truncate"></h4>
                    <p class="text-xs text-slate-500 mt-1">ID: <span id="modal-product-id"></span></p>
                </div>
            </div>
            
            <div class="divide-y divide-slate-100 dark:divide-slate-800 text-xs">
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Danh mục:</span>
                    <span id="modal-product-category" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Giá bán:</span>
                    <span id="modal-product-price" class="font-bold text-primary"></span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span class="text-slate-500">Tồn kho:</span>
                    <span id="modal-product-stock" class="font-semibold text-slate-900 dark:text-white"></span>
                </div>
                <div class="py-2.5 flex justify-between items-center">
                    <span class="text-slate-500">Trạng thái:</span>
                    <span id="modal-product-status"></span>
                </div>
            </div>
        </div>
        <!-- Footer / Actions -->
        <div class="p-5 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex items-center gap-3">
            <a id="modal-edit-btn" href="" class="flex-1 justify-center bg-primary text-white py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-primary/90 transition-colors text-xs shadow-md shadow-primary/10">
                <i class="fa-solid fa-pen-to-square"></i>
                Chỉnh sửa
            </a>
            <form id="modal-delete-form" action="" method="POST" class="flex-1" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full justify-center bg-red-500 hover:bg-red-650 text-white py-2.5 rounded-xl font-bold flex items-center gap-2 transition-colors text-xs shadow-md shadow-red-500/10 cursor-pointer">
                    <i class="fa-solid fa-trash-can"></i>
                    Xóa sản phẩm
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function formatCurrency(value) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' })
            .format(value)
            .replace('₫', '') + '₫';
    }

    function handleRowClick(event, productData) {
        // Prevent click if user is clicking button inside the table row or editing
        if (event.target.closest('a') || event.target.closest('button') || event.target.closest('form')) {
            return;
        }
        
        // Only trigger modal on mobile screens
        if (window.innerWidth >= 768) return;

        const modal = document.getElementById('product-detail-modal');
        const card = document.getElementById('modal-card');
        
        // Format Price HTML
        let priceHtml = '';
        if (productData.salePrice && productData.salePrice < productData.price) {
            priceHtml = `<span class="text-primary font-bold">${formatCurrency(productData.salePrice)}</span> <span class="text-xs text-slate-400 line-through font-normal">${formatCurrency(productData.price)}</span>`;
        } else {
            priceHtml = `<span class="text-slate-900 dark:text-white font-bold">${formatCurrency(productData.price)}</span>`;
        }

        // Format Status HTML
        let statusHtml = '';
        if (!productData.isActive) {
            statusHtml = `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-650"><span class="w-1.5 h-1.5 rounded-full bg-slate-550"></span>Ngừng kinh doanh</span>`;
        } else if (productData.stock > 0) {
            statusHtml = `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-600"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Đang kinh doanh</span>`;
        } else {
            statusHtml = `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-600"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Hết hàng</span>`;
        }

        // Populate modal data
        document.getElementById('modal-product-img').src = productData.image;
        document.getElementById('modal-product-name').textContent = productData.name;
        document.getElementById('modal-product-id').textContent = productData.id;
        document.getElementById('modal-product-category').textContent = productData.category;
        document.getElementById('modal-product-price').innerHTML = priceHtml;
        document.getElementById('modal-product-stock').textContent = productData.stock;
        document.getElementById('modal-product-status').innerHTML = statusHtml;
        
        // Action URLs
        document.getElementById('modal-edit-btn').href = productData.editUrl;
        document.getElementById('modal-delete-form').action = productData.deleteUrl;
        
        // Show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }
    
    function closeProductModal() {
        const modal = document.getElementById('product-detail-modal');
        const card = document.getElementById('modal-card');
        
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
