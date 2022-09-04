@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-form d-flex flex-row-reverse">
                    <div class="form">
                        <h4>فرم ثبت نام</h4>
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <div class="form-group flex-column">
                                <label for="name" class="col-md-4 col-form-label text-md-right">نام</label>

                                <input id="name" type="text" class="form-control ltr text-center @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group flex-column">
                                <label for="email" class="col-md-4 col-form-label text-md-right">آدرس ایمیل</label>

                                <input id="email" type="email" class="form-control text-center @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group flex-column">
                                <label for="password" class="col-md-4 col-form-label text-md-right">پسوورد</label>

                                <input id="password" type="password" class="form-control text-center @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group flex-column">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تکرار پسوورد</label>
                                <input id="password-confirm" type="password" class="form-control ltr text-center" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <x-recaptcha/>

                            <button type="submit" class="btn btn-primary">
                                ثبت نام
                            </button>
                        </form>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                پسوورد خود را فراموش کرده اید؟
                            </a><br>
                        @endif
                        <a class="btn btn-link" href="{{ route('login') }}">
                            قبلا ثبت نام کرده اید؟
                        </a>
                    </div>
                    <div class="form-wallpaper">
                        <img src="/images/wallpaper.jpg" class="img-fluid" alt="wallpaper">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
