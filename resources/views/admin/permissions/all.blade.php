@component('admin.layouts.content',['title'=>'دسترسی ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        <li class="breadcrumb-item active">صفحه دسترسی ها</li>
        @can('ایجاد دسترسی')
            <li class="breadcrumb-item"><a href="{{route('admin.permissions.create')}}">صفحه ایجاد دسترسی جدید</a></li>
        @endcan
    @endslot


    <div class="card" id="admin-permissions">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول دسترسی ها</h3>

            <div class="d-flex card-tools justify-content-center">
                <form class="form-inline ml-3 search">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar text-center" type="search" placeholder="جستجو" name="search" aria-label="Search" value="{{request('search') ?? ''}}">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                @can('ایجاد دسترسی')
                    <div class="d-flex card-tools">
                        <a href="{{route('admin.permissions.create')}}" class="btn btn-sm btn-secondary">ایجاد دسترسی جدید</a>
                    </div>
                @endcan
            </div>



        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped permissions-table">
                <thead>
                    <tr class="bg-secondary">
                        <th>شماره</th>
                        <th>عنوان دسترسی</th>
                        <th>توضیحات دسترسی</th>
                        <th>تاریخ ایجاد</th>
                        <th>عملیات</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($permissions as $permission)
                    <tr class="border-bottom">
                        <td>{{$permission->id}}</td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->label}}</td>
                        <td>{{$permission->created_at}}</td>
                        <td>
                            @can('ویرایش دسترسی')
                                <!-- edit page -->
                                    <a class="btn btn-sm btn-primary" href="{{route('admin.permissions.edit',$permission->id)}}">ویرایش</a>
                            @endcan
                            @can('حذف دسترسی')
                                <!-- delete page -->
                                    <form class="d-none" action="{{route('admin.permissions.destroy',$permission->id)}}" method="post" id="delete-permission-{{$permission->id}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button class="btn btn-sm btn-danger" onclick="document.getElementById('delete-permission-{{$permission->id}}').submit()">حذف</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-start px-4 py-2">
                {{$permissions->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
