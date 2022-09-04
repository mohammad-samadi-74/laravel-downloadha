@component('admin.layouts.content',['title'=>'اطلاعات مقام'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده مقام ها')
            <li class="breadcrumb-item"><a href="{{route('admin.rules.index')}}">صفحه مقام ها</a></li>
        @endcan
        @can('ایجاد مقام')
            <li class="breadcrumb-item"><a href="{{route('admin.rules.create')}}">صفحه ایجاد مقام جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه اطلاعات مقام</li>
    @endslot


    <div class="card" id="admin-rules">
        <div class="card-header">
            <h3 class="card-title">اطلاعات مقام </h3>
            <div class="card-tools">
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
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped rules-table">

                <tr class="bg-secondary">
                    <td class="pl-1">خصوصیت</td>
                    <td>مقدار</td>
                </tr>

                <tr>
                    <td>id</td>
                    <td>{{$rule->id}}</td>
                </tr>

                <tr>
                    <td>عنوان مقام</td>
                    <td>{{$rule->name}}</td>
                </tr>

                <tr>
                    <td>توضیحات مقام</td>
                    <td>{{$rule->label}}</td>
                </tr>

                <tr>
                    <td>دسترسی ها</td>
                    <td style="width: 85%">
                        @foreach($rule->permissions->pluck('name') as $permission)
                            <span class="my-1 badge badge-warning p-2 font-14">{{$permission}}</span>
                        @endforeach
                    </td>
                </tr>

            </table>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
