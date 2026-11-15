<!DOCTYPE html>
<html lang="vi">
@push('styles')
    <link rel="stylesheet" href="{{ asset('clients/assets/css/css-login/style.css') }}">
@endpush
@include('clients.block.header_2')

<main class="main-login">
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success" role="status">{{ session('message') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        <section class="sign-in account-card" aria-labelledby="login-title">
            <div class="row align-items-center g-4">
                <div class="col-md-5 text-center d-none d-md-block">
                    <img class="account-image" src="{{ asset('clients/assets/css/css-login/images/signin-image.jpg') }}" alt="Minh họa đăng nhập">
                </div>
                <div class="col-md-7">
                    <h1 id="login-title" class="account-title">Đăng nhập</h1>
                    <p class="mb-4">Chào mừng bạn trở lại Vivutravel.</p>
                    <form method="POST" action="{{ route('login.submit') }}" class="register-form" id="login-form">
                        @csrf
                        <label for="your_name" class="mb-2">Tên đăng nhập hoặc email</label>
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="your_name" id="your_name" placeholder="Nhập tên đăng nhập hoặc email" autocomplete="username">
                        </div>
                        <div class="invalid-feedback" id="validate_username"></div>
                        <label for="your_pass" class="mb-2">Mật khẩu</label>
                        <div class="form-group mb-3">
                            <input class="form-control" type="password" name="your_pass" id="your_pass" placeholder="Nhập mật khẩu" autocomplete="current-password">
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <input type="checkbox" name="remember-me" id="remember-me">
                            <label for="remember-me">Nhớ tài khoản</label>
                        </div>
                        <button type="submit" name="signin" id="signin" class="theme-btn w-100">
                            <span data-hover="Đăng nhập">Đăng nhập</span>
                            <i class="fal fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </form>
                    <p class="text-center my-3">Hoặc đăng nhập bằng</p>
                    <a href="{{ route('login-google') }}" class="theme-btn style-three w-100">
                        Google <i class="fab fa-google" aria-hidden="true"></i>
                    </a>
                    <p class="text-center mt-4 mb-0">
                        Chưa có tài khoản?
                        <a href="#register-form" class="signup-image-link">Đăng ký ngay</a>
                    </p>
                </div>
            </div>
        </section>

        <section class="signup account-card" aria-labelledby="register-title">
            <div class="row align-items-center g-4">
                <div class="col-md-5 text-center d-none d-md-block">
                    <img class="account-image" src="{{ asset('clients/assets/css/css-login/images/signup-image.jpg') }}" alt="Minh họa đăng ký">
                </div>
                <div class="col-md-7">
                    <h2 id="register-title" class="account-title">Tạo tài khoản</h2>
                    <p class="mb-4">Cùng Vivutravel khám phá những chuyến đi mới.</p>
                    <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
                        @csrf
                        <label for="username_register" class="mb-2">Tên đăng nhập</label>
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="username_register" id="username_register" placeholder="Nhập tên đăng nhập" autocomplete="username" required>
                        </div>
                        <div class="invalid-feedback" id="validate_username_regis"></div>
                        <label for="email_register" class="mb-2">Email</label>
                        <div class="form-group mb-3">
                            <input class="form-control" type="email" name="email_register" id="email_register" placeholder="Nhập địa chỉ email" autocomplete="email">
                        </div>
                        <div class="invalid-feedback" id="validate_email_regis"></div>
                        <label for="password_register" class="mb-2">Mật khẩu</label>
                        <div class="form-group mb-3">
                            <input class="form-control" type="password" name="pass" id="password_register" placeholder="Nhập mật khẩu" autocomplete="new-password">
                        </div>
                        <div class="invalid-feedback" id="validate_password_regis"></div>
                        <label for="re_pass" class="mb-2">Xác nhận mật khẩu</label>
                        <div class="form-group mb-3">
                            <input class="form-control" type="password" name="re_pass" id="re_pass" placeholder="Nhập lại mật khẩu" autocomplete="new-password">
                        </div>
                        <div class="invalid-feedback" id="validate_repass"></div>
                        <div class="d-flex align-items-start gap-2 mb-4">
                            <input type="checkbox" name="agree-term" id="agree-term" class="mt-2">
                            <label for="agree-term">Tôi đồng ý với các <a href="#" class="term-service">điều khoản dịch vụ</a>.</label>
                        </div>
                        <button type="submit" name="signup" id="signup" class="theme-btn w-100">
                            <span data-hover="Đăng ký">Đăng ký</span>
                            <i class="fal fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </form>
                    <p class="text-center mt-4 mb-0">
                        Đã có tài khoản?
                        <a href="#login-form" class="signup-image-link">Đăng nhập</a>
                    </p>
                </div>
            </div>
        </section>
    </div>
</main>
@include('clients.block.footer', ['disableAos' => true, 'hideSessionAlert' => true])
