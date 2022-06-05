@extends('layouts.home_layout')
@section("title")
    Register
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row border border-dark rounded rounded-3 p-0 mx-3">
            <div class="col-12 col-md-5 col-lg-6 d-sm-none d-md-block p-0">
                <img class="h-100 w-100 rounded-start" src="{{ asset('upload/images/background.jpg') }}" alt="">
            </div>
            <div class="col-12 col-md-7 col-lg-6 p-5">
                <h2 class="text-center mb-4 fw-bold">Đăng kí tài khoản</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') }}" placeholder="Tên" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" placeholder="Mật khẩu" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="">
                            <input id="password-confirm" placeholder="Xác nhận mật khẩu" type="password" class="form-control" name="password_confirmation"
                                   required autocomplete="new-password">
                        </div>
                    </div>

                    {{-- <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY" data-callback="verifyCaptcha"></div>
                    <div id="g-recaptcha-error"></div> --}}

                    <div class="mb-0 mt-2">
                        <div class="">
                            <button type="submit" class="btn btn-danger w-100">
                                {{ __('Đăng ký') }}
                            </button>
                        </div>
                    </div>
                </form>
                <h5></h5>
                <h5 class="w-100 text-center">hoặc đăng ký với</h5>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <button class="btn btn-primary w-100 fw-bold">Facebook</button>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <button class="btn btn-danger w-100 fw-bold">Google</button>
                    </div>
                </div>
                <hr>
                <div class="mt-4">
                    <p class="text-center">Bạn đã có tài khoản? <a class="text-decoration-none fw-bold" href="{{ route("login") }}">Đăng nhập ngay</a></p>
                </div>
            </div>
        </div>

    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
