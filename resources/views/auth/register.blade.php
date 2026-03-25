@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<main class="flex-1 flex items-center justify-center p-6 bg-background-light dark:bg-background-dark min-h-[calc(100vh-200px)]">
<div class="w-full max-w-[440px] bg-white dark:bg-slate-900 rounded-xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 p-8">
<!-- Title Section -->
<div class="mb-8">
<h2 class="text-3xl font-black text-slate-900 dark:text-white leading-tight tracking-tight">Đăng ký</h2>
<p class="text-slate-500 dark:text-slate-400 mt-2">Tạo tài khoản mới để trải nghiệm TechFlow</p>
</div>
<!-- Register Form -->
<form method="POST" action="{{ route('register') }}" class="space-y-5">
@csrf

<!-- Name Field -->
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Họ và tên</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">person</span>
<input name="name" value="{{ old('name') }}" required autofocus class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white" placeholder="Nguyễn Văn A" type="text"/>
</div>
@error('name')
<span class="text-xs text-red-500 mt-1">{{ $message }}</span>
@enderror
</div>

<!-- Email Field -->
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
<input name="email" value="{{ old('email') }}" required class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white" placeholder="Nhập email của bạn" type="email"/>
</div>
@error('email')
<span class="text-xs text-red-500 mt-1">{{ $message }}</span>
@enderror
</div>

<!-- Password Field -->
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Mật khẩu</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
<input name="password" required class="w-full pl-11 pr-12 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white" placeholder="Tạo mật khẩu (tối thiểu 8 ký tự)" type="password"/>
</div>
@error('password')
<span class="text-xs text-red-500 mt-1">{{ $message }}</span>
@enderror
</div>

<!-- Confirm Password Field -->
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Xác nhận mật khẩu</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock_clock</span>
<input name="password_confirmation" required class="w-full pl-11 pr-12 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white" placeholder="Nhập lại mật khẩu" type="password"/>
</div>
</div>

<!-- Register Button -->
<button class="w-full py-3.5 mt-2 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2" type="submit">
<span>Tạo tài khoản</span>
<span class="material-symbols-outlined text-lg">person_add</span>
</button>
</form>

<!-- Login Link -->
<div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-800 text-center">
<p class="text-slate-600 dark:text-slate-400 text-sm">
Đã có tài khoản? 
<a class="text-primary font-bold hover:underline underline-offset-4 ml-1" href="{{ route('custom.login') }}">Đăng nhập ngay</a>
</p>
</div>
</div>
</main>
@endsection
