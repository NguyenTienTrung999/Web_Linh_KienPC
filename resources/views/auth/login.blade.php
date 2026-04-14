@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold"><i class="fa-solid fa-right-to-bracket me-2 text-primary"></i>Đăng nhập</h2>
                <p class="text-secondary">Đăng nhập để truy cập tài khoản của bạn</p>
            </div>

            <div class="glass-container">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success alert-custom mb-4">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="email@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                        <input type="password" class="form-control form-control-custom @error('password') is-invalid @enderror"
                               id="password" name="password" required placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-secondary" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="color: var(--primary-light); text-decoration: none; font-size: 0.9rem;">
                                Quên mật khẩu?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary-custom w-100 mb-3">
                        <i class="fa-solid fa-right-to-bracket me-1"></i>Đăng nhập
                    </button>

                    <p class="text-center text-secondary mb-0">
                        Chưa có tài khoản?
                        <a href="{{ route('register') }}" style="color: var(--primary-light); text-decoration: none;">Đăng ký ngay</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
