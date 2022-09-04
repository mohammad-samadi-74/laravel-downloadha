@component('admin.layouts.content',['title'=>'ایجاد دسترسی جدید'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده دسترسی ها')
            <li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}">صفحه دسترسی ها</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ایجاد دسترسی جدید</li>
    @endslot

    <div class="card" id="admin-permissions">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ایجاد دسترسی جدید</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body px-4">
            <form action="{{route('admin.permissions.store')}}" method="post">
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
                    <label for="name">عنوان دسترسی</label>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder="عنوان دسترسی را وارد کنید." value="{{old('name')}}">
                </div>
                <!-- name filed -->

                <!-- label filed -->
                <div class="form-group">
                    <label for="label">توضیحات دسترسی</label>
                    <textarea type="text" class="form-control" name="label" id="label"
                           placeholder="توضیحات دسترسی را وارد کنید.">{{old('label')}}</textarea>
                </div>
                <!-- label filed -->

                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ایجاد دسترسی</button>
                    <a href="{{route('admin.permissions.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

