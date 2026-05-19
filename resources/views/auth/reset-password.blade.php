@extends('layouts.app')

@section('title', 'Tạo mật khẩu mới')

@section('content')
<main class="flex flex-1 items-center justify-center p-4 min-h-[calc(100vh-200px)]">
    <div class="layout-content-container flex flex-col w-full max-w-[480px] bg-white dark:bg-slate-900 p-8 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
        <!-- Title & Description -->
        <div class="flex flex-col gap-3 mb-8">
            <div class="flex justify-center mb-2">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                    <i class="fa-solid fa-key text-3xl"></i>
                </div>
            </div>
            <h1 class="text-slate-900 dark:text-white text-3xl font-black leading-tight tracking-tight text-center">Tạo mật khẩu mới</h1>
            <p class="text-slate-500 dark:text-slate-400 text-base font-normal leading-normal text-center">
                Vui lòng nhập mật khẩu mới cho tài khoản của bạn
            </p>
        </div>
        
        <!-- Input Section -->
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="flex flex-col gap-5">
                
                <!-- Email Address -->
                <div class="flex flex-col gap-2">
                    <label class="text-slate-700 dark:text-slate-300 text-sm font-semibold leading-normal">
                        Email của bạn
                    </label>
                    <div class="relative flex items-center">
                        <div class="absolute left-4 text-slate-400">
                            <i class="fa-solid fa-envelope text-lg"></i>
                        </div>
                        <input name="email" required autofocus class="w-full h-14 pl-12 pr-4 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" value="{{ old('email', $request->email) }}" type="email" autocomplete="username"/>
                    </div>
                    @error('email')
                        <span class="text-red-500 text-xs font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-2">
                    <label class="text-slate-700 dark:text-slate-300 text-sm font-semibold leading-normal">
                        Mật khẩu mới
                    </label>
                    <div class="relative flex items-center">
                        <div class="absolute left-4 text-slate-400">
                            <i class="fa-solid fa-lock text-lg"></i>
                        </div>
                        <input id="password" name="password" required class="w-full h-14 pl-12 pr-12 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="••••••••" type="password" autocomplete="new-password"/>
                        <button type="button" id="togglePassword" class="absolute right-4 text-slate-400 hover:text-primary transition-colors focus:outline-none">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-xs font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="flex flex-col gap-2">
                    <label class="text-slate-700 dark:text-slate-300 text-sm font-semibold leading-normal">
                        Xác nhận mật khẩu
                    </label>
                    <div class="relative flex items-center">
                        <div class="absolute left-4 text-slate-400">
                            <i class="fa-solid fa-lock-open text-lg"></i>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" required class="w-full h-14 pl-12 pr-4 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="••••••••" type="password" autocomplete="new-password"/>
                    </div>
                    @error('password_confirmation')
                        <span class="text-red-500 text-xs font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3 mt-2">
                    <button type="submit" class="flex w-full items-center justify-center rounded-lg h-12 bg-primary text-white text-base font-bold leading-normal tracking-wide hover:brightness-110 active:scale-[0.98] transition-all shadow-md shadow-primary/20">
                        <span class="truncate">Đổi mật khẩu</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('password_confirmation');
        const eyeIcon = document.getElementById('eyeIcon');

        if(togglePassword && passwordInput && passwordConfirmInput) {
            togglePassword.addEventListener('click', function () {
                // Toggle type
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                passwordConfirmInput.setAttribute('type', type);
                
                // Toggle icon
                if (type === 'password') {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                } else {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                }
            });
        }
    });
</script>
@endsection
