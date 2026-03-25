@extends('layouts.app')

@section('title', 'Quản lý Danh mục')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="bi bi-folder me-2" style="color: var(--primary-light);"></i>Quản lý Danh mục</h2>
            <p class="text-secondary mb-0">Thêm, sửa, xóa các danh mục sản phẩm</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg me-1"></i>Thêm danh mục
        </a>
    </div>

    <div class="glass-container">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Số sản phẩm</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td class="text-secondary">{{ Str::limit($category->description, 60) }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-25 text-primary-emphasis" style="color: var(--primary-light) !important;">
                                    {{ $category->products_count }} sản phẩm
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-custom me-1">
                                    <i class="bi bi-pencil"></i> Sửa
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Tất cả sản phẩm trong danh mục cũng sẽ bị xóa.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="border: 1px solid var(--danger-color); color: var(--danger-color); border-radius: 10px;">
                                        <i class="bi bi-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-secondary">
                                <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                <p class="mt-2 mb-0">Chưa có danh mục nào.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Navigation -->
    <div class="mt-4">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-custom">
            <i class="bi bi-box-seam me-1"></i>Quản lý Sản phẩm
        </a>
    </div>
</div>
@endsection
