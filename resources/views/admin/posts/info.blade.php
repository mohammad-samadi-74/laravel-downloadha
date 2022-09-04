@component('admin.layouts.content',['title'=>'اطلاعات پست'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده پست ها')
            <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">صفحه پست ها</a></li>
        @endcan
        @can('ایجاد پست')
            <li class="breadcrumb-item"><a href="{{route('admin.posts.create')}}">صفحه ایجاد پست جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه اطلاعات پست</li>
    @endslot


    <div class="card" id="admin-posts">
        <div class="card-header">
            <h3 class="card-title">اطلاعات پست </h3>
            <div class="card-tools">

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

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped posts-table">

                <tr class="bg-secondary"><td class="pl-1">خصوصیت</td><td>مقدار</td></tr>

                <!-- id -->
                <tr><td>id</td><td>{{$post->id}}</td></tr>

                <!-- title -->
                <tr><td>عنوان</td><td>{{$post->title}}</td></tr>

                <!-- type -->
                <tr><td>نوع پست</td><td>{{$post->type}}</td></tr>

                <!-- categories -->
                <tr>
                    <td>دسته بندی ها</td>
                    <td>
                        @if(empty($post->categories->pluck('name')->toArray()))
                            <p> ندارد </p>
                        @else
                            @foreach($post->categories->pluck('name')->toArray() as $cat)
                                <span class="m-1 badge badge-warning p-2 font-weight-bold font-10">{{$cat}}</span>
                            @endforeach
                        @endif
                    </td>
                </tr>

                <!-- tags -->
                <tr><td>تگ ها</td><td>{{!empty($post->tags) ? $post->tags : 'ندارد'}}</td></tr>

                <!-- writer -->
                <tr><td>نویسنده</td><td>{{$post->user->name}}</td></tr>

                <!-- views -->
                <tr><td>بیننده ها</td><div class="d-flex"><td class="font-v"><span class="views">{{$post->views}}</span></td></div></tr>

                <!-- likes -->
                <tr><td>لایک ها</td><td class="font-v"><span class="likes">{{$post->likes}}</span></td></tr>

                <!-- dislikes -->
                <tr><td>دیسلایک ها</td><td class="font-v"><span class="dislikes">{{$post->dislikes}}</span></td></tr>

                @can('مشاهده کامنت ها')
                    <!-- comments  -->
                        <tr>
                            <td>کامنت ها</td>
                            <td class="font-v"><span class="comments">{{$post->comments->count()}}</span>
                                <a class="mx-4 btn btn-sm btn-success py-1 px-2 font-12" href="{{route('admin.posts.comments.info',$post->id)}}">مشاهده کامنت ها</a>
                            </td>
                        </tr>
                @endcan

                <!-- downloads -->
                <tr>
                    <td>دانلود ها</td>
                    <td class="font-v"><span class="downloads">0</span></td>
                </tr>

                <!-- wallpaper -->
                @if($post->wallpaper && file_exists(public_path($post->wallpaper)))
                    <tr>
                        <td>تصویر</td>
                        <td class="d-flex flex-column image-show">
                            <img src="/{{$post->wallpaper}}" alt="wallpaper" class="w-20 img-fluid">
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>ندارد</td>
                    </tr>
                @endif

            <!-- images -->
                @if($post->images()->count() >= 1 )
                    <tr>
                        <td>گالری</td>
                        <td>
                            @foreach($post->images as $image)
                                <img class="w-10 m-1" src="/{{$image->image}}" alt="image">
                            @endforeach
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>گالری</td>
                        <td>تصویری وجود ندارد</td>
                    </tr>
                @endif

            <!-- content -->
                <tr>
                    <td>متن اول</td>
                    <td>{!! $post->first_content !!}</td>
                </tr>
                <!-- id -->
                <tr>
                    <td>متن دوم</td>
                    <td>{!! $post->second_content ?? 'ندارد' !!}</td>
                </tr>
                <!-- id -->
                <tr>
                    <td>متن سوم</td>
                    <td>{!! $post->third_content ?? 'ندارد' !!}</td>
                </tr>

            </table>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
