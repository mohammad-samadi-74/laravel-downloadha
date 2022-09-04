@component('admin.layouts.content',['title'=>'ایجاد مقام جدید'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده مقام ها')
            <li class="breadcrumb-item"><a href="{{route('admin.rules.index')}}">صفحه مقام ها</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ایجاد مقام جدید</li>
    @endslot

    @slot('script')
        <script>
            $('#permissions').select2({placeholder:'دسترسی ها را انتخاب کنید.'})
        </script>
    @endslot

    <div class="card" id="admin-rules">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ایجاد مقام جدید</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body px-4">
            <form action="{{route('admin.rules.store')}}" method="post">
            @csrf

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                @endforeach
            @endif
            <!-- errors -->

                <!-- name filed -->
                <div class="form-group">
                    <label for="name">عنوان مقام</label>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder="عنوان مقام را وارد کنید." value="{{old('name')}}">
                </div>
                <!-- name filed -->

                <!-- label filed -->
                <div class="form-group">
                    <label for="label">توضیحات مقام</label>
                    <textarea type="text" class="form-control" name="label" id="label"
                              placeholder="توضیحات مقام را وارد کنید.">{{old('label')}}</textarea>
                </div>
                <!-- label filed -->

                <!-- label filed -->
                <div class="form-group">
                    <label for="permissions">توضیحات مقام</label>
                    <select class="form-control" name="permissions[]" id="permissions" multiple>
                        @foreach(\App\Models\Permission::all() as $permission)
                            <option
                                value="{{$permission->id}}" {{in_array($permission->name,old('permissions') ?? []) ? 'selected' : ''}}>{{$permission->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- label filed -->


                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ایجاد مقام</button>
                    <a href="{{route('admin.rules.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

