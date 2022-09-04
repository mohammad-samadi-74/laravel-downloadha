@component('admin.layouts.content',['title'=>'ایجاد کاربر جدید'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده کاربران')
            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">صفحه کاربر ها</a></li>
        @endcan
        @can('ایجاد کاربر')
            <li class="breadcrumb-item"><a href="{{route('admin.users.create')}}">صفحه ایجاد کاربر جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ویرایش آدرس کاربر</li>
    @endslot

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
    <div class="card" id="admin-users">
        <!-- /.card-header -->
        <div class="card-body px-4">
            <form method="post" action="{{ route('address.update',$address->id) }}">
            @csrf
            @method('PATCH')

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                    @endforeach
                @endif

                <div class="form-group d-flex flex-column">
                    <label for="state" class="col-form-label">استان:</label>
                    <select class="w-50 mr-4 form-control" name="state" id="state" onchange="addCities(event);">
                        @php
                            $cities = \Illuminate\Support\Facades\DB::table('cities')->where('parent','0')->get()->pluck('title');
                        @endphp

                        @foreach($cities as $city)
                            <option value="{{$city}}" {{old('state',$address->state) == $city ? 'selected' : ''}}>{{$city}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="user_id" value="{{$user_id}}">

                <div class="form-group d-flex flex-column">
                    <label for="city" class="col-form-label">شهر یا شهرستان:</label>
                    <select class="w-50 mr-4 form-control" name="city" id="city">
                        <option value="{{old('city',$address->city) != '' ? old('city',$address->city) : ''}}" {{old('city',$address->city) == '' ? 'selected' : ''}}>{{old('city',$address->city) != '' ? old('city',$address->city) : ''}}</option>
                    </select>
                </div>

                <div class="form-group d-flex flex-column">
                    <label for="address" class="col-form-label">آدرس:</label>
                    <textarea class=" w-75 mx-4 form-control" name="address" id="address" placeholder="آدرس را وارد کنید.">{{old('address',$address->address)}}</textarea>
                </div>

                <div class=" form-group d-flex flex-column">
                    <label for="phone" class="col-form-label">شماره تلفن ثابت:</label>
                    <div class="d-flex">
                        <input class="mx-4 w-50 form-control" type="text" id="phone" name="phone"
                               value="{{old('phone',$address->phone)}}" placeholder="شماره ثابت">
                        <code class="text-danger"><i class=" mx-3 fas fa-exclamation-triangle"></i>شماره را همراه کد شهر
                            وارد کنید.</code>
                    </div>
                </div>

                <div class="w-50 form-group d-flex flex-column">
                    <label for="cellphone_number" class="col-form-label">شماره تلفن موبایل:</label>
                    <input class="mx-4 form-control" type="text" id="cellphone_number" name="cellphone_number" value="{{old('cellphone_number',$address->cellphone_number)}}" placeholder="شماره موبایل را وارد کنید.">
                </div>

                <div class="d-flex my-4">
                    <button type="submit" class="btn btn-sm  btn-primary mr-4 ml-2">
                        ویرایش آدرس
                    </button>
                    <a role="btn" class="btn-info btn btn-sm" href="{{route('admin.users.info',$user_id)}}">برگشت</a>
                </div>
            </form>

        </div>

    </div>
    <!-- /.card-body -->
    </div>


@endcomponent

