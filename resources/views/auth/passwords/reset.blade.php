@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-form d-flex flex-row-reverse">
                    <div class="form">
                        <h4>{{ __('فرم ریست پسوورد') }}</h4>
                        <form method="POST" action="{{ route('password.update') }}" id="resetPassword">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group flex-column">
                                <label for="email" class="col-form-label text-md-right">{{ __('آدرس ایمیل') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" >

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group flex-column">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('پسوورد') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group flex-column">
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('تکرار پسوورد') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <x-recaptcha/>

                            <button type="submit" class="btn btn-primary">
                                {{ __('ریست پسوورد') }}
                            </button>
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
