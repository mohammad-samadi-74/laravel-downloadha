@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-form d-flex flex-row-reverse">
                    <div class="form">
                        <h4>فرم تایید احراز هویت دومرحله ای</h4>
                        <form method="POST" action="{{route('two_factor_auth_token')}}" id="active-two-factor-auth">
                            @csrf

                            <div class="form-group flex-column">
                                <label for="token" class="col-form-label text-md-right">کد تایید</label>
                                <input id="token" type="text" class="text-center form-control @error('token') is-invalid @enderror" name="token" required>
                            </div>

                            <x-recaptcha/>

                            <button class="btn btn-success btn-sm shadow-sm" type="submit">تایید کد</button>
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

