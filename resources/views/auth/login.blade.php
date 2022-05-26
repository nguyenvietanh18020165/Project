@extends('layouts.home_layout')
@section("title")
    Login
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row border border-dark rounded rounded-3 p-0 mx-3">
            <div class="col-12 col-md-5 col-lg-6 d-sm-none d-md-block p-0">
                <img class="h-100 w-100 rounded-start" src="{{ asset('upload/images/background.jpg') }}" alt="">
            </div>
            <div class="col-12 col-md-7 col-lg-6 p-5">
                <h2 class="text-center mb-4 fw-bold">Login to your account</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="position-relative">
                            <input id="email" type="email"
                                   class="form-control px-4 @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" autofocus>
                            <i class="fa-solid fa-envelope position-absolute" style="top:11px; left: 5px;"></i>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="position-relative">
                            <input id="password" type="password"
                                   class="form-control px-4 @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="current-password" placeholder="Password">
                            <i class="fa-solid fa-key position-absolute" style="top:11px; left: 5px;"></i>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <div class="text-end">
                                    <a class="btn btn-link fw-bold" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
                <h5 class="w-100 text-center">or login with</h5>
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
                    <p class="text-center">Check out as a guest? <a class="text-decoration-none fw-bold" href="/">Click Here</a><br></p>
                    <p class="text-center">Don't have an account? <a class="text-decoration-none fw-bold" href="{{route("register")}}">Register Here</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
