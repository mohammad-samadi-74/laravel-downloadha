@component('admin.layouts.content',['title'=>'ایجاد کاربر جدید'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده کاربران')
            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">صفحه کاربر ها</a></li>
        @endcan
        @can('ایجاد کاربر')
            <li class="breadcrumb-item"><a href="{{route('admin.users.create')}}">صفحه ایجاد کاربر جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ویرایش کاربر</li>
    @endslot


    <div class="card" id="admin-users">
        <!-- /.card-header -->
        <div class="card-body px-4">
            <form action="{{route('admin.users.update',$user->id)}}" method="post">
            @csrf
            @method('PATCH')

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                @endforeach
            @endif
            <!-- errors -->

                <!-- name filed -->
                <div class="form-group">
                    <label for="name">نام کاربر</label>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder="نام کاربر را وارد کنید." value="{{old('name',$user->name)}}">
                </div>
                <!-- name filed -->

                <!-- email filed -->
                <div class="form-group">
                    <label for="email">ایمیل کاربر</label>
                    <input type="email" class="form-control" name="email" id="email"
                           placeholder="ایمیل کاربر را وارد کنید." value="{{old('email',$user->email)}}">
                </div>
                <!-- email filed -->

                <!-- phone_number filed -->
                <div class="form-group">
                    <label for="phone_number">شماره موبایل کاربر</label>
                    <input type="text" class="form-control" name="phone_number" id="phone_number"
                           placeholder="شماره موبایل کاربر را وارد کنید." value="{{old('phone_number',$user->phone_number)}}">
                </div>
                <!-- phone_number filed -->

                <!-- password filed -->
                <div class="form-group">
                    <label for="password">پسوورد کاربر</label>
                    <input type="password" class="form-control" name="password" id="password"
                           placeholder="پسوورد کاربر را وارد کنید." value="{{old('password')}}">
                </div>
                <!-- password filed -->

                <!-- confirm_password filed -->
                <div class="form-group">
                    <label for="password_confirmation">تکرار پسوورد کاربر</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                           placeholder="تکرار پسوورد کاربر را وارد کنید." value="{{old('password_confirmation')}}">
                </div>
                <!-- confirm_password filed -->

                <!-- super_user and staff filed -->
{{--                {{dd(old('is_superuser',$user->is_superuser))}}--}}
                <div class="form-check px-0">
                    <input type="checkbox" class="mx-2"  name="is_superuser" id="is_superuser" {{old('is_superuser',$user->is_superuser) ? 'checked' : ''}}>
                    <label for="is_superuser">سوپر یوزر</label>
                </div>

                <div class="form-check px-0">
                    <input type="checkbox" class="mx-2" name="is_staff" id="is_staff" {{old('is_superuser',$user->is_staff) ? 'checked' : ''}}>
                    <label for="is_staff">کارمند سایت</label>
                </div>

                <!-- super_user and staff filed -->

                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ویرایش کاربر</button>
                    <a href="{{route('admin.users.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

