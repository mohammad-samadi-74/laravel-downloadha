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
                        <h4>فرم تایید ایمیل</h4>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('یک کد تایید تازه به ادرس ایمیل شما ارسال شد.') }}
                            </div>
                        @endif

<div class="px-3">
    {{ __('لطفا ایمیل خود را برای کد تایید چک کنید.') }}
    {{ __('اگر هنوز ایمیلی دریافت نکرده اید') }},
</div>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}" id="verifyForm">
                            @csrf
                            <button type="submit" class="m-4 btn btn-secondary">{{ __('ارسال مجدد ایمیل') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
