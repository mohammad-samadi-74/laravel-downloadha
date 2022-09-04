@component('admin.layouts.content',['title'=>'ایجاد کاربر جدید'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده کاربران')
            <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">صفحه کاربر ها</a></li>
        @endcan
        <li class="breadcrumb-item active"><a>صفحه ویرایش مقام کاربر</a></li>

    @endslot

    @slot('script')
        <script>
            $('#permissions').select2({placeholder:'لطفا دسترسی ها را انتخاب کنید.'});
        </script>
    @endslot


    <div class="card" id="admin-users">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ویرایش مقام کاربر </h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body px-4">
            <form action="{{route('admin.rules.editRule',$user->id)}}" method="post">
            @csrf
            @method('PATCH')

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                @endforeach
            @endif
            <!-- errors -->

                <!-- rule filed -->
                <div class="form-group">
                    <label for="rule">مقام</label>
                    <select class="form-control" name="rule" id="rule">
                        <option value="">هیچکدام</option>
                        @foreach(\App\Models\Rule::all() as $rule)
                            <option value="{{$rule->id}}">{{$rule->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- rule filed -->

                <!-- permissions filed -->
                <div class="form-group">
                    <label for="permissions">دسترسی ها</label>
                    <select class="form-control" name="permissions[]" id="permissions" multiple>
                        @foreach(\App\Models\Permission::all() as $permission)
                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- permissions filed -->



                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ویرایش مقام</button>
                    <a href="{{route('admin.rules.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

