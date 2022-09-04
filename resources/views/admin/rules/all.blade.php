@component('admin.layouts.content',['title'=>'مقام ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        <li class="breadcrumb-item active">صفحه مقام ها</li>
        @can('ایجاد مقام')
            <li class="breadcrumb-item"><a href="{{route('admin.rules.create')}}">صفحه ایجاد مقام جدید</a></li>
        @endcan
    @endslot


    <div class="card" id="admin-rules">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول مقام ها</h3>

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

                @can('ایجاد مقام')
                    <div class="d-flex card-tools">
                        <a href="{{route('admin.rules.create')}}" class="btn btn-sm btn-secondary">ایجاد مقام جدید</a>
                    </div>
                @endcan
            </div>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped rules-table">
                <thead>
                <tr class="bg-secondary">
                    <th>شماره</th>
                    <th>عنوان مقام</th>
                    <th>توضیحات مقام</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($rules as $rule)
                    <tr class="border-bottom">
                        <td>{{$rule->id}}</td>
                        <td>{{$rule->name}}</td>
                        <td>{{ empty($rule->label) ? '-----' : $rule->label}}</td>
                        <td>{{$rule->created_at}}</td>
                        <td>
                            <!-- info page -->
                            <a class="btn btn-sm btn-warning" href="{{route('admin.rules.info',$rule->id)}}">دسترسی ها</a>
                            @can('ویرایش مقام')
                                <!-- edit page -->
                                <a class="btn btn-sm btn-primary" href="{{route('admin.rules.edit',$rule->id)}}">ویرایش</a>
                            @endcan
                            @can('حذف مقام')
                                <!-- delete page -->
                                <form class="d-none" action="{{route('admin.rules.destroy',$rule->id)}}" method="post" id="delete-rule-{{$rule->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger" onclick="document.getElementById('delete-rule-{{$rule->id}}').submit()">حذف</button>
                            @endcan

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-start px-4 py-2">
                {{$rules->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
