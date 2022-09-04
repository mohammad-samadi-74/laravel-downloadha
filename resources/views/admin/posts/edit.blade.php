@component('admin.layouts.content',['title'=>'ویرایش پست '])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده پست ها')
            <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">صفحه پست ها</a></li>
        @endcan
        @can('ایجاد پست')
            <li class="breadcrumb-item"><a href="{{route('admin.posts.create')}}">صفحه ایجاد پست جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ویرایش پست</li>
    @endslot

    @slot('script')
        <script>
            $('#categories').select2({placeholder: 'دسته بندی ها را انتخاب کنید.'})
            $('textarea').focus(function () {
                let id = $(this).attr('id')
                CKEDITOR.replace(id)
            })
        </script>
    @endslot


    <div class="card" id="admin-posts">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ایجاد پست جدید</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body px-4">
            <form action="{{route('admin.posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                @endforeach
            @endif
            <!-- errors -->

                <!-- title filed -->
                <div class="form-group">
                    <label for="title">عنوان پست</label>
                    <input type="text" class="form-control" name="title" id="title"
                           placeholder="عنوان پست را وارد کنید." value="{{old('title',$post->title)}}">
                </div>
                <!-- title filed -->

                <!-- type filed -->
                <div class="form-group">
                    <label for="type">نوع پست</label>
                    <select class="form-control" name="type" id="type">
                        <option value="نرم افزار" {{old('type',$post->type) === 'نرم افزار' ? 'selected' : ''}}>نرم
                            افزار
                        </option>
                        <option value="بازی" {{old('type',$post->type) === 'بازی' ? 'selected' : ''}}>بازی</option>
                        <option value="موبایل" {{old('type',$post->type) === 'موبایل' ? 'selected' : ''}}>موبایل
                        </option>
                        <option value="مالتی مدیا" {{old('type',$post->type) === 'مالتی مدیا' ? 'selected' : ''}}>مالتی
                            مدیا
                        </option>
                    </select>
                </div>
                <!-- type filed -->

                <!-- content fields -->
                <div class="form-group mb-4">
                    <label for="first_content">متن اول پست</label>
                    <textarea class="form-control" name="first_content" id="first_content"
                              placeholder="متن پست را وارد کنید.">{{old('first_content',$post->first_content)}}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="second_content">متن دوم پست</label>
                    <textarea class="form-control" name="second_content" id="second_content"
                              placeholder="متن دوم پست را وارد کنید.">{{old('second_content',$post->second_content)}}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="third_content">متن سوم پست</label>
                    <textarea class="form-control" name="third_content" id="third_content"
                              placeholder="متن  سوم پست را وارد کنید.">{{old('third_content',$post->third_content)}}</textarea>
                </div>
                <!-- content fields -->

                <!-- wallpaper filed -->
                <div class="form-group">
                    <label for="wallpaper">تصویر پست</label>
                    @if($post->wallpaper && file_exists(public_path($post->wallpaper)))
                        <div class="row ">
                            <div class="col-2 my-1 bg-light shadow-md p-2 mx-2">
                                <img src="/{{$post->wallpaper}}" class="img-fluid" alt="تصویر">
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control" name="wallpaper" id="wallpaper"
                           placeholder="تصویر پست را انتخاب کنید." value="{{old('wallpaper',$post->wallpaper)}}">
                </div>
                <!-- wallpaper filed -->

                <!-- gallery filed -->
                <div class="form-group">
                    <label for="images">گالری تصاویر پست</label>
                    @if($images = $post->images)
                        <div class="row bg-light shadow-sm">
                            @foreach($images as $image)
                                @if(file_exists(public_path($image->image)))
                                    <div class="col-2 p-2">
                                        <img src="/{{$image->image}}" class="img-fluid" alt="تصویر">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <input type="file" class="form-control" name="images[]" id="images"
                           placeholder="تصاویر پست را انتخاب کنید." value="{{old('wallpaper')}}" multiple>
                </div>
                <!-- gallery filed -->

                <!-- icon filed -->
                <div class="form-group bg-light rounded p-2">
                    <label for="icon">آیکون پست</label>
                    @if($post->icon && file_exists(public_path($post->icon->icon)))
                        <div class="row ">
                            <div class="col-1 my-1 bg-light shadow-md p-2 mx-2">
                                <img src="/{{$post->icon->icon}}" class="img-fluid" alt="تصویر">
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control" name="icon" id="icon"
                           placeholder="آیکون پست را انتخاب کنید." value="{{old('icon')}}">

                    <!-- icon-caption filed -->
                    <div class="form-group">
                        <label for="caption">عنوان آیکون</label>
                        <input type="text" class="form-control" name="caption" id="caption"
                               placeholder="عنوان آیکون را وارد کنید."
                               value="{{old('caption') ?? $post->icon->caption ?? ''}}">
                    </div>
                    <!-- icon-caption filed -->

                    <!-- icon-content filed -->
                    <div class="form-group">
                        <label for="content">متن آیکون</label>
                        <input type="text" class="form-control" name="content" id="content"
                               placeholder="متن آیکون را وارد کنید."
                               value="{{old('content') ?? $post->icon->content ?? ''}}">
                    </div>
                    <!-- icon-content filed -->
                </div>
                <!-- icon filed -->


                <!-- categories filed -->
                <div class="form-group">
                    <label for="categories">دسته بندی ها</label>
                    <select class="form-control" name="categories[]" id="categories" multiple>
                        @foreach(\App\Models\Category::where('parent_id','>','0')->get() as  $cat)
                            <option
                                value="{{$cat->id}}" {{in_array($cat->id,$post->categories()->pluck('id')->toArray()) ? 'selected' : ''}}>{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- categories filed -->

                <!-- info field -->
                <div class="form-group mb-4">
                    <label for="info">توضیحات انگلیسی پست</label>
                    <textarea class="form-control" name="info" id="info"
                              placeholder="توضیحات انگلیسی پست را وارد کنید.">{{old('info',$post->info)}}</textarea>
                </div>
                <!-- info field -->

                <!-- system_l field -->
                <div class="form-group mb-4">
                    <label for="system_l">حداقل سیستم مورد نیاز</label>
                    <textarea class="form-control" name="system_l" id="system_l"
                              placeholder="حداقل سیستم مورد نیاز را وارد کنید.">{{old('system_l',$post->system_l)}}</textarea>
                </div>
                <!-- system_l field -->

                <!-- system_b field -->
                <div class="form-group mb-4">
                    <label for="system_b">سیستم پیشنهادی</label>
                    <textarea class="form-control" name="system_b" id="system_b"
                              placeholder="سیستم پیشنهادی را وارد کنید.">{{old('system_b',$post->system_b)}}</textarea>
                </div>
                <!-- system_b field -->

                <!-- files_setup filed -->
                <div class="form-group mb-4">
                    <label for="files_setup">توضیحات نصب</label>
                    <textarea class="form-control" name="files_setup" id="files_setup"
                              placeholder="توضیحات نصب را وارد کنید.توضیحات را با ویرگول جدا کنید.">{{old('files_setup',$post->files_setup)}}</textarea>
                </div>
                <!-- files_setup filed -->

                <!-- files_info filed -->
                <div class="form-group mb-4">
                    <label for="files_info">توضیحات فایل ها</label>
                    <textarea class="form-control" name="files_info" id="files_info"
                              placeholder="توضیحات را با ویرگول جدا کنید.اطلاعات فایل هارا را وارد کنید.">{{old('files_info',$post->files_info)}}</textarea>
                </div>
                <!-- files_info filed -->

                <!-- download filed -->
                <div class="form-group mb-4">
                    <label for="download">لینک های دانلود</label>
                    <textarea class="form-control" name="download" id="download"
                              placeholder="لینک های دانلود را وارد کنید.">{{old('download',$post->download)}}</textarea>
                </div>
                <!-- download filed -->

                <!-- tags filed -->
                <div class="form-group">
                    <label for="tags">تگ های پست</label>
                    <input type="text" class="form-control" name="tags" id="tags"
                           placeholder="تگ های پست را وارد کنید.تگ هارا با ویرگول از هم جدا کنید."
                           value="{{old('title',$post->tags)}}">
                </div>
                <!-- tags filed -->

                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ویرایش پست</button>
                    <a href="{{route('admin.posts.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

