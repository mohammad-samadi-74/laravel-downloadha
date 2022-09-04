@component('admin.layouts.content',['title'=>'پست ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        <li class="breadcrumb-item active">صفحه پست ها</li>
        @can('ایجاد پست')
            <li class="breadcrumb-item"><a href="{{route('admin.posts.create')}}">صفحه ایجاد پست جدید</a></li>
        @endcan
    @endslot


    <div class="card" id="admin-posts">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول پست ها</h3>

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

                @can('ایجاد پست')
                    <div class="d-flex card-tools">
                        <a href="{{route('admin.posts.create')}}" class="btn btn-sm btn-secondary">ایجاد پست جدید</a>
                    </div>
                @endcan
            </div>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped posts-table">
                <thead>
                <tr class="bg-secondary">
                    <th>شماره</th>
                    <th>عنوان پست</th>
                    <th>نویسنده</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($posts as $post)
                    <tr class="border-bottom">
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>
                            <!-- info page -->
                            <a class="btn btn-sm btn-warning" href="{{route('admin.posts.info',$post->id)}}">توضیحات</a>

                            <!-- edit page -->
                            @can('ویرایش پست')
                                <a class="btn btn-sm btn-primary" href="{{route('admin.posts.edit',$post->id)}}">ویرایش</a>
                            @endcan

                            <!-- delete page -->
                            @can('حذف پست')
                                <form class="d-none" action="{{route('admin.posts.destroy',$post->id)}}" method="post"
                                      id="delete-post-{{$post->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger"
                                        onclick="document.getElementById('delete-post-{{$post->id}}').submit()">حذف
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-start px-4 py-2">
                {{$posts->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
