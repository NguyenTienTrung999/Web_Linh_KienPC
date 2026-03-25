@extends('layouts.app')

@section('title', 'Thêm Danh mục')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <h2 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color: var(--primary-light);"></i>Thêm Danh mục mới</h2>
                <p class="text-secondary mb-0">Tạo danh mục sản phẩm mới cho cửa hàng</p>
            </div>

            <div class="glass-container">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-custom @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên danh mục..." required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Mô tả</label>
                        <textarea class="form-control form-control-custom @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4" placeholder="Nhập mô tả danh mục...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-check-lg me-1"></i>Tạo danh mục
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-custom">
                            <i class="bi bi-arrow-left me-1"></i>Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
