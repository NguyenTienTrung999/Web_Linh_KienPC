@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<main class="flex-1 flex items-start lg:items-center justify-center p-4 sm:p-6 lg:p-12 bg-gradient-to-tr from-indigo-50/70 via-blue-50/50 to-white dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 min-h-screen pt-[10px] lg:pt-[120px] pb-8 lg:pb-16">
    
    <style>
        /* Double Slider custom styles */
        .auth-container {
            transition: all 0.7s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .auth-form-panel {
            transition: all 0.7s cubic-bezier(0.25, 1, 0.5, 1);
        }
        
        /* Stacking background images cross-fade transitions */
        .overlay-bg-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.7s cubic-bezier(0.25, 1, 0.5, 1);
        }
        
        .login-bg-img {
            opacity: 1;
            z-index: 1;
        }
        
        .register-bg-img {
            opacity: 0;
            z-index: 1;
        }
        
        .right-panel-active .login-bg-img {
            opacity: 0;
        }
        
        .right-panel-active .register-bg-img {
            opacity: 1;
        }
        
        /* Desktop specific animation rules */
        @media (min-width: 1024px) {
            .sign-in-container {
                left: 0;
                width: 50%;
                z-index: 20;
            }
            .sign-up-container {
                left: 0;
                width: 50%;
                opacity: 0;
                z-index: 10;
                pointer-events: none;
            }
            
            .auth-container.right-panel-active .sign-in-container {
                transform: translateX(100%);
                opacity: 0;
                z-index: 10;
                pointer-events: none;
            }
            .auth-container.right-panel-active .sign-up-container {
                transform: translateX(100%);
                opacity: 1;
                z-index: 30;
                pointer-events: auto;
                animation: show-signup-anim 0.7s cubic-bezier(0.25, 1, 0.5, 1);
            }
            
            .overlay-container {
                left: 50%;
                width: 50%;
                transition: transform 0.7s cubic-bezier(0.25, 1, 0.5, 1);
            }
            .auth-container.right-panel-active .overlay-container {
                transform: translateX(-100%);
            }
            
            .overlay-bg {
                width: 200%;
                left: -100%;
                transition: transform 0.7s cubic-bezier(0.25, 1, 0.5, 1);
            }
            .auth-container.right-panel-active .overlay-bg {
                transform: translateX(50%);
            }
            
            .overlay-panel {
                width: 50%;
                transition: transform 0.7s cubic-bezier(0.25, 1, 0.5, 1);
            }
            .overlay-left {
                transform: translateX(-20%);
            }
            .auth-container.right-panel-active .overlay-left {
                transform: translateX(0);
            }
            .overlay-right {
                transform: translateX(0);
            }
            .auth-container.right-panel-active .overlay-right {
                transform: translateX(20%);
            }
        }
        
        @keyframes show-signup-anim {
            0%, 49.99% { opacity: 0; z-index: 10; }
            50%, 100% { opacity: 1; z-index: 30; }
        }
        
        /* Mobile overrides (below 1024px) */
        @media (max-width: 1023px) {
            .auth-form-panel {
                position: relative !important;
                width: 100% !important;
                transform: none !important;
                transition: opacity 0.5s ease, visibility 0.5s ease !important;
            }
            .sign-in-container {
                opacity: 1;
                z-index: 20;
                pointer-events: auto;
            }
            .sign-up-container {
                opacity: 0;
                z-index: 10;
                position: absolute !important;
                top: 0;
                left: 0;
                pointer-events: none;
            }
            .auth-container.right-panel-active .sign-in-container {
                opacity: 0;
                z-index: 10;
                position: absolute !important;
                top: 0;
                left: 0;
                pointer-events: none;
            }
            .auth-container.right-panel-active .sign-up-container {
                opacity: 1;
                z-index: 20;
                position: relative !important;
                pointer-events: auto;
            }
        }
    </style>

    <!-- Card Container -->
    <div class="relative w-full max-w-[1100px] min-h-[640px] bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[32px] overflow-hidden shadow-2xl border border-slate-100 dark:border-slate-800/80 flex auth-container" id="auth-double-container">
        
        <!-- ==================================================== -->
        <!-- SIGN UP (REGISTER) FORM CONTAINER -->
        <!-- ==================================================== -->
        <div class="auth-form-panel sign-up-container absolute top-0 h-full flex flex-col justify-center p-8 sm:p-12 lg:p-16 bg-transparent">
            <!-- Header Title -->
            <div class="mb-6">
                <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Đăng ký</h3>
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mt-2">Tạo tài khoản mới để trải nghiệm hệ sinh thái TechFlow</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="form_type" value="register">
                
                <!-- Name Field -->
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">Họ và tên</label>
                    <div class="relative">
                        <input name="name" value="{{ old('name') }}" class="w-full px-5 py-3 bg-slate-100 dark:bg-slate-800/60 border border-transparent rounded-2xl focus:bg-white dark:focus:bg-slate-900 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white text-sm font-semibold placeholder-slate-400" placeholder="Nhập đầy đủ họ và tên của bạn" type="text" required/>
                    </div>
                    @if ($errors->has('name') && old('form_type') === 'register')
                        <span class="text-xs text-red-500 mt-1 block font-semibold"><i class="fa-solid fa-triangle-exclamation mr-1"></i>{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <!-- Email Field -->
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">Email</label>
                    <div class="relative">
                        <input name="email" value="{{ old('email') }}" class="w-full px-5 py-3 bg-slate-100 dark:bg-slate-800/60 border border-transparent rounded-2xl focus:bg-white dark:focus:bg-slate-900 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white text-sm font-semibold placeholder-slate-400" placeholder="Nhập địa chỉ email của bạn" type="email" required/>
                    </div>
                    @if ($errors->has('email') && old('form_type') === 'register')
                        <span class="text-xs text-red-500 mt-1 block font-semibold"><i class="fa-solid fa-triangle-exclamation mr-1"></i>{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <!-- Password Field -->
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">Mật khẩu</label>
                    <div class="relative">
                        <input name="password" class="w-full px-5 py-3 bg-slate-100 dark:bg-slate-800/60 border border-transparent rounded-2xl focus:bg-white dark:focus:bg-slate-900 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white text-sm font-semibold placeholder-slate-400" placeholder="Mật khẩu (tối thiểu 8 ký tự)" type="password" required/>
                    </div>
                    @if ($errors->has('password') && old('form_type') === 'register')
                        <span class="text-xs text-red-500 mt-1 block font-semibold"><i class="fa-solid fa-triangle-exclamation mr-1"></i>{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">Xác nhận mật khẩu</label>
                    <div class="relative">
                        <input name="password_confirmation" class="w-full px-5 py-3 bg-slate-100 dark:bg-slate-800/60 border border-transparent rounded-2xl focus:bg-white dark:focus:bg-slate-900 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white text-sm font-semibold placeholder-slate-400" placeholder="Xác nhận lại mật khẩu" type="password" required/>
                    </div>
                </div>

                <!-- Submit Button -->
                <button class="w-full py-4 mt-4 bg-blue-600 hover:bg-blue-750 dark:bg-primary dark:hover:bg-primary/90 text-white font-black rounded-2xl transition-all shadow-lg shadow-blue-500/10 dark:shadow-primary/10 hover:shadow-xl hover:scale-[1.01] uppercase tracking-widest text-xs flex items-center justify-center gap-2" type="submit">
                    <span>Đăng ký</span>
                </button>
            </form>

            <!-- Toggle Register Link (Visible on Mobile Only) -->
            <div class="mt-6 text-center pt-4 border-t border-slate-50 dark:border-slate-800/50 lg:hidden">
                <p class="text-slate-500 dark:text-slate-400 text-xs font-semibold">
                    Đã có tài khoản? 
                    <button class="text-primary font-black hover:underline ml-1 focus:outline-none" id="to-login-btn-mobile">Đăng nhập ngay</button>
                </p>
            </div>
        </div>

        <!-- ==================================================== -->
        <!-- SIGN IN (LOGIN) FORM CONTAINER -->
        <!-- ==================================================== -->
        <div class="auth-form-panel sign-in-container absolute top-0 h-full flex flex-col justify-center p-8 sm:p-12 lg:p-16 bg-transparent">
            <!-- Header Title -->
            <div class="mb-8">
                <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Đăng nhập</h3>
                <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mt-2">Chào mừng bạn trở lại với hệ sinh thái TechFlow</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 text-sm font-semibold flex items-center gap-3 animate-in fade-in duration-300">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="form_type" value="login">
                
                <!-- Email Field -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">Email / Tên đăng nhập</label>
                    <div class="relative">
                        <input name="email" class="w-full px-5 py-3.5 bg-slate-100 dark:bg-slate-800/60 border border-transparent rounded-2xl focus:bg-white dark:focus:bg-slate-900 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white text-sm font-semibold placeholder-slate-400" placeholder="Nhập địa chỉ email của bạn" type="text" required autofocus/>
                    </div>
                    @if ($errors->has('email') && old('form_type') !== 'register')
                        <span class="text-xs text-red-500 mt-1 block font-semibold"><i class="fa-solid fa-triangle-exclamation mr-1"></i>{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider">Mật khẩu</label>
                    </div>
                    <div class="relative">
                        <input id="password-input" name="password" class="w-full px-5 py-3.5 pr-12 bg-slate-100 dark:bg-slate-800/60 border border-transparent rounded-2xl focus:bg-white dark:focus:bg-slate-900 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-white text-sm font-semibold placeholder-slate-400" placeholder="Nhập mật khẩu" type="password" required/>
                        <button id="toggle-password" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors focus:outline-none" type="button">
                            <i id="password-icon" class="fa-solid fa-eye text-base"></i>
                        </button>
                    </div>
                    @if ($errors->has('password') && old('form_type') !== 'register')
                        <span class="text-xs text-red-500 mt-1 block font-semibold"><i class="fa-solid fa-triangle-exclamation mr-1"></i>{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input name="remember" class="w-4 h-4 rounded-md border-slate-350 text-blue-600 focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 transition-colors" type="checkbox"/>
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 group-hover:text-slate-800 dark:group-hover:text-slate-200 transition-colors">Ghi nhớ đăng nhập</span>
                    </label>
                    <a class="text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-primary transition-colors" href="{{ route('custom.forgot-password') }}">Quên mật khẩu?</a>
                </div>

                <!-- Submit Button -->
                <button class="w-full py-4 bg-blue-600 hover:bg-blue-750 dark:bg-primary dark:hover:bg-primary/90 text-white font-black rounded-2xl transition-all shadow-lg shadow-blue-500/10 dark:shadow-primary/10 hover:shadow-xl hover:scale-[1.01] uppercase tracking-widest text-xs flex items-center justify-center gap-2" type="submit">
                    <span>Đăng nhập</span>
                </button>
            </form>

            <!-- Toggle Login Link (Visible on Mobile Only) -->
            <div class="mt-8 text-center pt-4 border-t border-slate-50 dark:border-slate-800/50 lg:hidden">
                <p class="text-slate-500 dark:text-slate-400 text-xs font-semibold">
                    Chưa có tài khoản? 
                    <button class="text-primary font-black hover:underline ml-1 focus:outline-none" id="to-register-btn-mobile">Đăng ký ngay</button>
                </p>
            </div>
        </div>

        <!-- ==================================================== -->
        <!-- GRAPHIC OVERLAY CONTAINER (DESKTOP ONLY) -->
        <!-- ==================================================== -->
        <div class="hidden lg:block absolute left-1/2 top-0 h-full w-1/2 overflow-hidden z-[100] overlay-container">
            <!-- Full-bleed background images stacked inside overlay-container for absolute cross-fade synchronization -->
            <img src="{{ asset('images/banner-login_rotated.png') }}" class="overlay-bg-img login-bg-img">
            <img src="{{ asset('images/banner-login.png') }}" class="overlay-bg-img register-bg-img">

            <div class="relative h-full w-[200%] -left-full overlay-bg flex z-20">
                <!-- Left Overlay Panel (Show Sign-In invite when Sign-Up is visible) -->
                <div class="h-full w-1/2 flex flex-col items-center justify-between py-16 px-12 text-slate-800 text-center overlay-panel overlay-left relative select-none">
                    <div class="relative z-10 flex flex-col items-center text-center mt-2">
                        <h4 class="text-3xl font-black italic tracking-tight font-display mb-3 text-slate-900 drop-shadow-[0_1px_2px_rgba(255,255,255,0.8)]">Chào mừng trở lại!</h4>
                        <p class="text-slate-600 text-xs font-semibold max-w-[280px] leading-relaxed drop-shadow-[0_1px_1px_rgba(255,255,255,0.8)]">
                            Để tiếp tục hành trình công nghệ cùng TechFlow, vui lòng kết nối với tài khoản của bạn.
                        </p>
                    </div>
                    <div class="relative z-10 mb-2">
                        <button class="px-8 py-3.5 border-2 border-slate-900/85 hover:border-primary hover:text-white hover:bg-primary text-slate-900 font-bold rounded-full transition-all text-xs uppercase tracking-widest hover:scale-105 active:scale-95 focus:outline-none shadow-sm" id="to-login-btn-desktop">
                            Đăng nhập ngay
                        </button>
                    </div>
                </div>

                <!-- Right Overlay Panel (Show Sign-Up invite when Sign-In is visible) -->
                <div class="h-full w-1/2 flex flex-col items-center justify-between py-16 px-12 text-slate-800 text-center overlay-panel overlay-right relative select-none">
                    <div class="relative z-10 flex flex-col items-center text-center mt-2">
                        <h4 class="text-3xl font-black italic tracking-tight font-display mb-3 text-slate-900 drop-shadow-[0_1px_2px_rgba(255,255,255,0.8)]">Khởi đầu công nghệ mới!</h4>
                        <p class="text-slate-600 text-xs font-semibold max-w-[280px] leading-relaxed drop-shadow-[0_1px_1px_rgba(255,255,255,0.8)]">
                            Đăng ký tài khoản ngay hôm nay để mở khóa hệ sinh thái linh kiện PC hàng đầu thế giới.
                        </p>
                    </div>
                    <div class="relative z-10 mb-2">
                        <button class="px-8 py-3.5 border-2 border-slate-900/85 hover:border-primary hover:text-white hover:bg-primary text-slate-900 font-bold rounded-full transition-all text-xs uppercase tracking-widest hover:scale-105 active:scale-95 focus:outline-none shadow-sm" id="to-register-btn-desktop">
                            Đăng ký tài khoản
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle Password Visibility
        const toggleBtn = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password-input');
        const passwordIcon = document.getElementById('password-icon');

        if (toggleBtn && passwordInput && passwordIcon) {
            toggleBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordIcon.classList.remove('fa-eye');
                    passwordIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.classList.remove('fa-eye-slash');
                    passwordIcon.classList.add('fa-eye');
                }
            });
        }

        // Double Slider Form Switcher Logic
        const container = document.getElementById('auth-double-container');
        
        // Buttons
        const toRegisterBtnDesktop = document.getElementById('to-register-btn-desktop');
        const toLoginBtnDesktop = document.getElementById('to-login-btn-desktop');
        const toRegisterBtnMobile = document.getElementById('to-register-btn-mobile');
        const toLoginBtnMobile = document.getElementById('to-login-btn-mobile');

        // Route references
        const loginUrl = '{{ route("custom.login") }}';
        const registerUrl = '{{ route("register") }}';

        // Switch to Register slide
        function switchToRegister() {
            if (container) {
                container.classList.add('right-panel-active');
                // Dynamically update document title & history URL
                document.title = 'Đăng ký - TechFlow';
                window.history.pushState(null, '', registerUrl);
            }
        }

        // Switch to Login slide
        function switchToLogin() {
            if (container) {
                container.classList.remove('right-panel-active');
                // Dynamically update document title & history URL
                document.title = 'Đăng nhập - TechFlow';
                window.history.pushState(null, '', loginUrl);
            }
        }

        // Bind event listeners
        if (toRegisterBtnDesktop) toRegisterBtnDesktop.addEventListener('click', switchToRegister);
        if (toLoginBtnDesktop) toLoginBtnDesktop.addEventListener('click', switchToLogin);
        if (toRegisterBtnMobile) toRegisterBtnMobile.addEventListener('click', switchToRegister);
        if (toLoginBtnMobile) toLoginBtnMobile.addEventListener('click', switchToLogin);

        // Check if there are active errors specifically on the Sign-Up Form, or if we started on /register
        const startOnRegister = {{ request()->routeIs('register') ? 'true' : 'false' }};
        const hasSignUpErrors = {{ ($errors->has('name') || ($errors->any() && request()->is('register*'))) ? 'true' : 'false' }};
        
        if (startOnRegister || hasSignUpErrors) {
            // Instantly activate register panel without transition on load
            if (container) {
                // Temporarily disable transition during initial load positioning
                container.style.transition = 'none';
                const overlayContainer = container.querySelector('.overlay-container');
                const overlayBg = container.querySelector('.overlay-bg');
                if (overlayContainer) overlayContainer.style.transition = 'none';
                if (overlayBg) overlayBg.style.transition = 'none';

                container.classList.add('right-panel-active');

                // Force layout reflow
                container.offsetHeight;

                // Re-enable transitions
                container.style.transition = '';
                if (overlayContainer) overlayContainer.style.transition = '';
                if (overlayBg) overlayBg.style.transition = '';
            }
        }
        
        // Listen to Popstate to transition smoothly when user clicks browser Back/Forward buttons
        window.addEventListener('popstate', function() {
            if (window.location.pathname.includes('register')) {
                container.classList.add('right-panel-active');
                document.title = 'Đăng ký - TechFlow';
            } else {
                container.classList.remove('right-panel-active');
                document.title = 'Đăng nhập - TechFlow';
            }
        });
    });
</script>
@endsection
