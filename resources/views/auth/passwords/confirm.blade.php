@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="auth-form d-flex flex-row-reverse">
                <div class="form">
                    <h4>{{ __('فرم تایید پسوورد') }}</h4>
                    <form method="POST" action="{{ route('password.confirm') }}" id="resetPassword">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-form-label text-md-right">{{ __('پسوورد') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('تایید پسوورد') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('پسوورد خود را فراموش کرده اید؟') }}
                            </a>
                        @endif

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
