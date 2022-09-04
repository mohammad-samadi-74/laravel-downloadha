@component('admin.layouts.content',['title'=>'ویرایش کامنت '])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده کامنت ها')
            <li class="breadcrumb-item"><a href="{{route('admin.comments.index')}}">صفحه کامنت های تایید شده</a></li>
        @endcan
        @can('تایید کامنت')
            <li class="breadcrumb-item"><a href="{{route('admin.comments.unapproved')}}">صفحه کامنت های تایید نشده</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ویرایش کامنت</li>
    @endslot


    <div class="card" id="admin-comments">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ویرایش کامنت</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body px-4">
            <form action="{{route('admin.comments.update',$comment->id)}}" method="post">
            @csrf
            @method('PATCH')

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                    @endforeach
                @endif
            <!-- errors -->

                <!-- comment filed -->
                <div class="form-group">
                    <label for="comment">متن کامنت</label>
                    <input type="text" class="form-control" name="comment" id="comment" placeholder="متن کامنت را وارد کنید." value="{{old('comment',$comment->comment)}}">
                </div>

                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ویرایش کامنت</button>
                    <a href="{{route('admin.comments.unapproved')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

