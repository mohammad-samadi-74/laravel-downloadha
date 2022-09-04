@extends('layouts.app')

@section('script')
    <script>
        let addCities = (event)=>{
            let state = event.target.value;

            $.ajaxSetup({
                headers:{
                    'x-csrf-token':document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type':'application/json'
                }
            })

            $.ajax({
                'url':'/address/getcities',
                'method':'post',
                'data':JSON.stringify({state:state}),
                'success':function (res){
                    if (res.cities){
                        console.log(true)
                        let cities = res.cities;
                        let options = "";
                        cities.map(function(item){
                            options += `<option value="${item}">${item}</option>`;
                        })
                        $('select#city').html(options).attr('disabled',false)
                    }

                }
            })
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="auth-form">
                    <div class="form w-75 mx-auto pt-2">
                        <h4>فرم اضافه کردن آدرس جدید</h4>
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        @endif
                        <form action="{{route('address.store')}}" method="POST">
                            @csrf
                            @php $user = auth()->user() @endphp

                            <input type="hidden" name="old_url" value="{{$url}}">

                            <div class="form-group d-flex flex-column">
                                <label for="state" class="col-form-label">استان:</label>
                                <select class="w-50 mr-4 form-control" name="state" id="state" onchange="addCities(event);">
                                    @php
                                        $cities = \Illuminate\Support\Facades\DB::table('cities')->where('parent','0')->get()->pluck('title');
                                    @endphp
                                    @foreach($cities as $city)
                                        <option value="{{$city}}" {{old('state') == 'تهران' ? 'selected' : ''}}>{{$city}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group d-flex flex-column">
                                <label for="city" class="col-form-label">شهر یا شهرستان:</label>
                                <select class="w-50 mr-4 form-control" name="city" id="city" disabled>
                                    <option value="تهران" {{old('city') == '' ? 'selected' : ''}}>...</option>
                                </select>
                            </div>

                            <div class="form-group d-flex flex-column">
                                <label for="address" class="col-form-label">آدرس:</label>
                                <textarea class="mx-4 form-control" name="address" id="address"
                                          placeholder="آدرس را وارد کنید.">{{old('address')}}</textarea>
                            </div>

                            <div class=" form-group d-flex flex-column">
                                <label for="phone" class="col-form-label">شماره تلفن ثابت:</label>
                                <div class="d-flex">
                                    <input class="mx-4 w-50 form-control" type="text" id="phone" name="phone" value="{{old('phone')}}" placeholder="شماره ثابت">
                                    <code class="text-danger"><i class=" mx-3 fas fa-exclamation-triangle"></i>شماره را همراه کد شهر وارد کنید.</code>
                                </div>
                            </div>

                            <div class="w-50 form-group d-flex flex-column">
                                <label for="cellphone_number" class="col-form-label">شماره تلفن موبایل:</label>
                                <input class="form-control" type="text" id="cellphone_number" name="cellphone_number"
                                       value="{{old('cellphone_number')}}" placeholder="شماره موبایل را وارد کنید.">
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary">
                                    اضافه کردن آدرس
                                </button>
                                <a role="btn" class="btn" href="{{route('profile')}}">برگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
