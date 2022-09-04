@component('admin.layouts.content',['title'=>'کاربران'])

    @slot('breadCrumb')
        <li class="breadcrumb-item active">صفحه کاربران</li>
        @can('ایجاد کاربر')
            <li class="breadcrumb-item"><a href="{{route('admin.users.create')}}">صفحه ایجاد کاربر جدید</a></li>
        @endcan
    @endslot


    <div class="card" id="admin-users">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول کاربران</h3>

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

                    @can('ایجاد کاربر')
                    <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-secondary">ایجاد کاربر جدید</a>
                    @endcan
                </div>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped users-table">
                <thead>
                <tr class="bg-secondary">
                    <th>شماره</th>
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>شماره تلفن</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr class="border-bottom">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number ?? 'ندارد'}}</td>
                        <td>
                            <!-- info page -->
                            <a class="btn btn-sm btn-warning text-white" href="{{route('admin.users.info',$user->id)}}">توضیحات</a>

                            <!-- edit role/permission page -->
                            @can('ویرایش مقام')
                                <a class="btn btn-sm btn-info" href="{{route('admin.rules.setRule',$user->id)}}">ویرایش مقام</a>
                            @endcan

                            <!-- edit page -->
                            @can('ویرایش کاربر')
                                <a class="btn btn-sm btn-primary" href="{{route('admin.users.edit',$user->id)}}">ویرایش</a>
                            @endcan

                            <!-- delete page -->
                            @can('حذف کاربر')
                                <form class="d-none" action="{{route('admin.users.destroy',$user->id)}}" method="post"
                                      id="delete-user-{{$user->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger"
                                        onclick="document.getElementById('delete-user-{{$user->id}}').submit()">حذف
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-start px-4 py-2">
                {{$users->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
