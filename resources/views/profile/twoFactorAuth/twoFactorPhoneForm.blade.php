@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-form d-flex">
                    <div class="form">
                        <h4>فرم تایید شماره تلفن</h4>
                        <div class="alert alert-success font-16 my-2">
                            کد با موفقیت به شماره موبایل مورد نظر ارسال شد.
                        </div>

                        <form method="POST" action="{{route('confirm-two-factor-auth')}}" id="active-two-factor-auth">
                            @csrf

                            <div class="form-group flex-column">
                                <label for="token" class="col-form-label text-md-right">کد تایید</label>
                                <input id="token" type="text" class="text-center form-control @error('token') is-invalid @enderror" name="token">
                                @error('token')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <x-recaptcha/>

                            <button class="btn btn-success btn-sm shadow-sm" type="submit">تایید کد</button>

                        </form>
                        <a href="" class="font-14">ارسال مجدد کد?</a>
                    </div>
                    <div class="form-wallpaper">
                        <img src="/images/tfa.jpg" class="img-fluid" alt="wallpaper">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

