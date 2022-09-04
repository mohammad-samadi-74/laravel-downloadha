@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-form d-flex">
                    <div class="form-wallpaper">
                        <img src="/images/wallpaper.jpg" class="img-fluid" alt="wallpaper">
                    </div>
                    <div class="form">
                        <h4>فرم ورود</h4>

                        <a class="btn btn-danger btn-sm text-white mx-4" href="{{route('auth-google')}}"><i class="fab fa-google mx-2"></i>ورود با گوگل</a>
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <div class="form-group d-flex flex-column">
                                <label for="email" class="col-form-label text-md-right">آدرس ایمیل</label>

                                <input id="email" type="email" class="ltr text-left form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group d-flex flex-column">
                                <label for="password" class="col-md-4 col-form-label text-md-right">پسوورد</label>

                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <div class="form-check mx-2">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label mx-4" for="remember">
                                        مرا به خاطر بسپار
                                    </label>
                                </div>
                            </div>

                            <x-recaptcha/>
                            <button type="submit" class="btn btn-primary mb-4">
                                ورود
                            </button>
                        </form>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                پسوورد خود را فراموش کرده اید؟
                            </a><br>
                        @endif
                        <a class="btn btn-link" href="{{ route('register') }}">
                            هنوز ثبت نام نکرده اید؟
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
