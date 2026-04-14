@extends('layouts.app')

@section('title', 'Quên mật khẩu')

@section('content')
<main class="flex flex-1 items-center justify-center p-4 min-h-[calc(100vh-200px)]">
<div class="layout-content-container flex flex-col w-full max-w-[480px] bg-white dark:bg-slate-900 p-8 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
<!-- Title & Description -->
<div class="flex flex-col gap-3 mb-8">
<div class="flex justify-center mb-2">
<div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center text-primary">
<i class="fa-solid fa-unlock-keyhole text-3xl"></i>
</div>
</div>
<h1 class="text-slate-900 dark:text-white text-3xl font-black leading-tight tracking-tight text-center">Quên mật khẩu?</h1>
<p class="text-slate-500 dark:text-slate-400 text-base font-normal leading-normal text-center">
                            Nhập email của bạn để nhận liên kết khôi phục mật khẩu
                        </p>
</div>
<!-- Input Section -->
<form method="POST" action="{{ route('password.email') }}">
@csrf
<div class="flex flex-col gap-6">
<div class="flex flex-col gap-2">
<label class="text-slate-700 dark:text-slate-300 text-sm font-semibold leading-normal">
                                Email của bạn
                            </label>
<div class="relative flex items-center">
<div class="absolute left-4 text-slate-400">
<i class="fa-solid fa-envelope text-lg"></i>
</div>
<input name="email" required autofocus class="w-full h-14 pl-12 pr-4 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="example@email.com" type="email"/>
</div>
</div>
<!-- Action Buttons -->
<div class="flex flex-col gap-3">
<button type="submit" class="flex w-full items-center justify-center rounded-lg h-12 bg-primary text-white text-base font-bold leading-normal tracking-wide hover:brightness-110 active:scale-[0.98] transition-all shadow-md shadow-primary/20">
<span class="truncate">Gửi liên kết khôi phục</span>
</button>
<a href="{{ route('custom.login') }}" class="flex w-full items-center justify-center rounded-lg h-12 bg-transparent text-slate-600 dark:text-slate-400 text-sm font-semibold leading-normal hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
<i class="fa-solid fa-right-to-bracket mr-2 text-base"></i>
<span class="truncate">Quay lại đăng nhập</span>
</a>
</div>
</div>
</form>
<!-- Footer Help -->
<div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
<p class="text-slate-400 text-xs">
                            Bạn gặp khó khăn? <a class="text-primary hover:underline" href="#">Liên hệ hỗ trợ kỹ thuật</a>
</p>
</div>
</div>
</main>
@endsection
