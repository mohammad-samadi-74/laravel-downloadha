@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-form d-flex flex-row-reverse">
                    <div class="form">
                        <h4>{{ __('فرم ریست پسوورد') }}</h4>
                        <form method="POST" action="{{ route('password.email') }}" id="resetPassword">
                            @csrf

                            <div class="form-group flex-column">
                                <label for="email" class="col-form-label text-md-right">{{ __('آدرس ایمیل') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <x-recaptcha/>

                            <button type="submit" class="btn btn-primary">
                                {{ __('ارسال ریست پسوورد') }}
                            </button>

                            <a class="btn btn-link mt-4" href="{{ route('login') }}">
                                قصد ورود به سایت را دارید؟
                            </a><br>
                            <a class="btn btn-link" href="{{ route('register') }}">
                                هنوز ثبت نام نکرده اید؟
                            </a>
                        </form>
                    </div>
                    <div class="form-wallpaper">
                        <img src="/images/wallpaper.jpg" class="img-fluid" alt="wallpaper">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
