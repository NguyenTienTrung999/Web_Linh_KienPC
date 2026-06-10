@extends('layouts.admin')

@section('title', 'Cập Nhật Mã Khuyến Mãi - TechFlow Admin')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.coupons.index') }}" class="w-10 h-10 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-500 hover:text-primary hover:shadow-md transition-all">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">Cập nhật mã khuyến mãi</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400">Chỉnh sửa thông tin mã giảm giá: <span class="font-bold text-primary uppercase">{{ $coupon->code }}</span></p>
    </div>
</div>

<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 lg:p-8 shadow-sm">
    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST" class="max-w-3xl">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Mã giảm giá <span class="text-red-500">*</span></label>
                <input type="text" name="code" value="{{ old('code', $coupon->code) }}" required class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 focus:ring-primary focus:border-primary uppercase px-4 @error('code') border-red-500 @enderror" placeholder="VD: TECHFLOW10">
                @error('code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="col-span-2 md:col-span-1 flex items-end mb-2">
                <label class="relative flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 dark:peer-focus:ring-primary/30 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-600 peer-checked:bg-primary"></div>
                    <span class="ml-3 text-sm font-bold text-slate-700 dark:text-slate-300">Kích hoạt ngay</span>
                </label>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Loại giảm giá <span class="text-red-500">*</span></label>
                <select name="discount_type" required class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 @error('discount_type') border-red-500 @enderror">
                    <option value="fixed" {{ old('discount_type', $coupon->discount_type) == 'fixed' ? 'selected' : '' }}>Giảm số tiền cố định (VNĐ)</option>
                    <option value="percent" {{ old('discount_type', $coupon->discount_type) == 'percent' ? 'selected' : '' }}>Giảm theo phần trăm (%)</option>
                </select>
                @error('discount_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Mức giảm <span class="text-red-500">*</span></label>
                <input type="number" name="discount_value" value="{{ old('discount_value', $coupon->discount_value) }}" required min="0" class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 @error('discount_value') border-red-500 @enderror" placeholder="VD: 50000 hoặc 10">
                @error('discount_value')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Đơn hàng tối thiểu (VNĐ)</label>
                <input type="number" name="min_order_value" value="{{ old('min_order_value', intval($coupon->min_order_value)) }}" min="0" class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 @error('min_order_value') border-red-500 @enderror" placeholder="VD: 100000">
                <p class="text-xs text-slate-500 mt-1">Để 0 nếu áp dụng cho mọi đơn hàng.</p>
                @error('min_order_value')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Giới hạn số lượt dùng</label>
                <input type="number" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" min="1" class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 @error('usage_limit') border-red-500 @enderror" placeholder="VD: 100">
                <p class="text-xs text-slate-500 mt-1">Bỏ trống nếu không giới hạn.</p>
                @error('usage_limit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Từ ngày (Thời gian bắt đầu)</label>
                <input type="datetime-local" name="valid_from" value="{{ old('valid_from', $coupon->valid_from ? $coupon->valid_from->format('Y-m-d\TH:i') : '') }}" class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 @error('valid_from') border-red-500 @enderror">
                @error('valid_from')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Đến ngày (Thời gian kết thúc)</label>
                <input type="datetime-local" name="valid_to" value="{{ old('valid_to', $coupon->valid_to ? $coupon->valid_to->format('Y-m-d\TH:i') : '') }}" class="w-full h-12 rounded-lg border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 focus:ring-primary focus:border-primary px-4 @error('valid_to') border-red-500 @enderror">
                @error('valid_to')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row gap-3">
            <button type="submit" class="w-full sm:w-auto justify-center bg-primary hover:bg-primary/90 text-white font-bold py-2.5 px-6 sm:py-3 sm:px-8 rounded-lg shadow-lg shadow-primary/20 transition-all flex items-center gap-2 text-sm sm:text-base">
                <i class="fa-solid fa-save"></i>
                Cập nhật mã
            </button>
            <a href="{{ route('admin.coupons.index') }}" class="w-full sm:w-auto text-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold py-2.5 px-6 sm:py-3 sm:px-8 rounded-lg transition-all text-sm sm:text-base">
                Hủy bỏ
            </a>
        </div>
    </form>
</div>
@endsection
