@component('admin.layouts.content',['title'=>'کامنت ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        <li class="breadcrumb-item active">صفحه کامنت ها</li>
    @endslot


    <div class="card" id="admin-comments">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول کامنت های تایید شده</h3>

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
            </div>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped comments-table">
                <thead>
                    <tr class="bg-secondary">
                        <th>شماره</th>
                        <th>نویسنده کامنت</th>
                        <th>متن کامنت</th>
                        <th>تعداد جواب ها</th>
                        <th>عملیات</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($comments as $comment)
                    <tr class="border-bottom">
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->comments->count()}}</td>
                        <td>
                            <!-- edit comment -->
                            @can('ویرایش کامنت')
                                <a class="btn btn-sm btn-primary" href="{{route('admin.comments.edit',$comment->id)}}">ویرایش</a>
                            @endcan
                            @can('تایید کامنت')
                                @if(! $comment->approved)
                                    <!-- approved comment -->
                                    <a class="btn btn-sm btn-warning" href="{{route('admin.comments.approved',$comment->id)}}">تایید</a>
                                @endif
                            @endcan
                            @can('حذف کامنت')
                                <!-- delete comment -->
                                <form class="d-none" action="{{route('admin.comments.destroy',$comment->id)}}" method="post" id="delete-comment-{{$comment->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger" onclick="document.getElementById('delete-comment-{{$comment->id}}').submit()">حذف</button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-start px-4 py-2">
                {{$comments->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
