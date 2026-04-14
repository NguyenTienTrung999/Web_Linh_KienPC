@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<main class="flex-1 flex items-center justify-center p-6 bg-background-light dark:bg-background-dark min-h-[calc(100vh-200px)]">
<div class="w-full max-w-[440px] bg-white dark:bg-slate-900 rounded-xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 p-8">
<!-- Title Section -->
<div class="mb-8">
<h2 class="text-3xl font-black text-slate-900 dark:text-white leading-tight tracking-tight">Đăng nhập</h2>
<p class="text-slate-500 dark:text-slate-400 mt-2">Chào mừng bạn trở lại với hệ sinh thái TechFlow</p>
</div>
<!-- Login Form -->
<form action="{{ route('login') }}" method="POST" class="space-y-5">
@csrf
<!-- Email / Username Field -->
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email / Tên đăng nhập</label>
<div class="relative">
<i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
<input name="email" class="w-full pl-11 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white" placeholder="Nhập email hoặc tên đăng nhập" type="text" required autofocus/>
</div>
@error('email')
<span class="text-xs text-red-500 mt-1">{{ $message }}</span>
@enderror
</div>
<!-- Password Field -->
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Mật khẩu</label>
<div class="relative">
<i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
<input name="password" class="w-full pl-11 pr-12 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white" placeholder="Nhập mật khẩu" type="password" required/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary" type="button">
<i class="fa-solid fa-eye text-lg"></i>
</button>
</div>
@error('password')
<span class="text-xs text-red-500 mt-1">{{ $message }}</span>
@enderror
</div>
<!-- Remember & Forgot -->
<div class="flex items-center justify-between">
<label class="flex items-center gap-2 cursor-pointer group">
<input name="remember" class="w-4 h-4 rounded border-slate-300 text-primary focus:ring-primary dark:bg-slate-800 dark:border-slate-700" type="checkbox"/>
<span class="text-sm text-slate-600 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-200 transition-colors">Ghi nhớ đăng nhập</span>
</label>
<a class="text-sm font-medium text-primary hover:underline underline-offset-4" href="{{ route('custom.forgot-password') }}">Quên mật khẩu?</a>
</div>
<!-- Login Button -->
<button class="w-full py-3.5 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2" type="submit">
<span>Đăng nhập</span>
<i class="fa-solid fa-arrow-right text-sm"></i>
</button>
</form>
<!-- Divider -->
<div class="relative my-8">
<div class="absolute inset-0 flex items-center">
<span class="w-full border-t border-slate-200 dark:border-slate-800"></span>
</div>
<div class="relative flex justify-center text-xs uppercase">
<span class="bg-white dark:bg-slate-900 px-4 text-slate-500 dark:text-slate-400 font-medium">Hoặc đăng nhập với</span>
</div>
</div>
<!-- Social Logins -->
<div class="grid grid-cols-2 gap-4">
<button class="flex items-center justify-center gap-2 py-2.5 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
<img alt="Google Logo" class="w-5 h-5" data-alt="Google colorful brand logo icon" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBKJlQXGAqoSsFau0SsW7PhmrKumZ9Qqd2GohecrlfbrHlnlfnCCq-bsFfid2Vb2HRa1Q2hmCRZ7BairJHL1f1_JFPVhesn5-YSRIq-zmLXTM0q4J_I0jeERk9y2zZWY3txb-cc239kMn-kgilI6gp6pnOZbUX-n5l2QZuGdOi6JS844bzu8h9PC-f1VT4nmn5rwXnWvxUuIramZyrJqZZVNC3gF5NogZiePZUCGSRFp4Zz2F-YJ1EzFTypqRjDq7ozrddeGBD_W5M"/>
<span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Google</span>
</button>
<button class="flex items-center justify-center gap-2 py-2.5 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
<svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewbox="0 0 24 24">
<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
</svg>
<span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Facebook</span>
</button>
</div>
<!-- Registration Link -->
<div class="mt-8 text-center">
<p class="text-slate-600 dark:text-slate-400 text-sm">
                    Chưa có tài khoản? 
                    <a class="text-primary font-bold hover:underline underline-offset-4 ml-1" href="{{ route('register') }}">Đăng ký ngay</a>
</p>
</div>
</div>
</main>
@endsection
