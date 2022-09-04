@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-form d-flex" id="editProfileForm">
                    <div class="form">
                        <h4>فرم ویرایش اطلاعات کاربری</h4>
                        <form method="POST" action="{{ route('updateProfile') }}">
                            @csrf
                            @php $user = auth()->user() @endphp
                            <div class="form-group d-flex flex-column">
                                <label for="name" class="col-form-label">نام:</label>
                                <input id="name" type="text"
                                       class="ltr text-left form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name',$user->name) }}" required autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group d-flex flex-column">
                                <label for="email" class="col-form-label">ایمیل:</label>
                                <input id="email" type="email"
                                       class="ltr text-left form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email',$user->email) }}" required
                                       autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group d-flex flex-column">
                                <label for="phone_number" class="col-form-label">شماره موبایل:</label>
                                <input id="phone_number" type="text"
                                       class="ltr text-left form-control @error('phone_number') is-invalid @enderror"
                                       name="phone_number" value="{{ old('phone_number',$user->phone_number) }}"
                                       required autocomplete="phone_number">
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary">
                                    ویرایش اطلاعات
                                </button>
                                <a role="btn" class="btn" href="{{route('profile')}}">برگشت</a>
                            </div>
                        </form>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                تغییر پسوورد با ارسال ایمیل
                            </a><br>
                        @endif
                    </div>
                    <div class="form-wallpaper ">
                        <img src="/images/profile.jpg" class="img-fluid" alt="wallpaper">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
