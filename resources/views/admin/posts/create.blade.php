@component('admin.layouts.content',['title'=>'ایجاد پست جدید'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده پست ها')
            <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">صفحه پست ها</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ایجاد پست جدید</li>
    @endslot

    @slot('script')
        <script>
            $('#categories').select2({placeholder:'دسته بندی ها را انتخاب کنید.'})
            $('textarea').focus(function(){
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
            <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf

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
                           placeholder="عنوان پست را وارد کنید." value="{{old('title')}}">
                </div>
                <!-- title filed -->

                <!-- type filed -->
                <div class="form-group">
                    <label for="type">نوع پست</label>
                    <select class="form-control" name="type" id="type" value="{{old('type')}}">
                        <option value="نرم افزار" {{old('type') === 'نرم افزار' ? 'selected' : ''}}>نرم افزار</option>
                        <option value="بازی" {{old('type') === 'بازی' ? 'selected' : ''}}>بازی</option>
                        <option value="موبایل" {{old('type') === 'موبایل' ? 'selected' : ''}}>موبایل</option>
                        <option value="مالتی مدیا" {{old('type') === 'مالتی مدیا' ? 'selected' : ''}}>مالتی مدیا</option>
                    </select>
                </div>
                <!-- type filed -->

                <!-- content fields -->
                <div class="form-group mb-4">
                    <label for="first_content">متن اول پست</label>
                    <textarea class="form-control" name="first_content" id="first_content" placeholder="متن پست را وارد کنید.">{{old('first_content')}}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="second_content">متن دوم پست</label>
                    <textarea class="form-control" name="second_content" id="second_content" placeholder="متن دوم پست را وارد کنید.">{{old('second_content')}}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="third_content">متن سوم پست</label>
                    <textarea class="form-control" name="third_content" id="third_content" placeholder="متن  سوم پست را وارد کنید.">{{old('third_content')}}</textarea>
                </div>
                <!-- content fields -->

                <!-- wallpaper filed -->
                <div class="form-group">
                    <label for="wallpaper">تصویراصلی پست</label>
                    <input type="file" class="form-control" name="wallpaper" id="wallpaper" placeholder="تصویر اصلی پست را انتخاب کنید." value="{{old('wallpaper')}}">
                </div>
                <!-- wallpaper filed -->

                <!-- gallery filed -->
                <div class="form-group">
                    <label for="images">گالری تصاویر پست</label>
                    <input type="file" class="form-control" name="images[]" id="images" placeholder="تصاویر پست را انتخاب کنید." value="{{old('wallpaper')}}" multiple>
                </div>
                <!-- gallery filed -->

                <!-- icon filed -->
                <div class="form-group p-2 bg-light rounded">
                    <label for="icon">آیکون پست</label>
                    <input type="file" class="form-control" name="icon" id="icon" placeholder="آیکون پست را انتخاب کنید." value="{{old('icon')}}">

                    <!-- icon-caption filed -->
                    <div class="form-group">
                        <label for="caption">عنوان آیکون</label>
                        <input type="text" class="form-control" name="caption" id="caption" placeholder="عنوان آیکون را وارد کنید." value="{{old('caption')}}">
                    </div>
                    <!-- icon-caption filed -->

                    <!-- icon-content filed -->
                    <div class="form-group">
                        <label for="content">متن آیکون</label>
                        <input type="text" class="form-control" name="content" id="content" placeholder="متن آیکون را وارد کنید." value="{{old('content')}}">
                    </div>
                    <!-- icon-content filed -->
                </div>
                <!-- icon filed -->




                <!-- categories filed -->
                <div class="form-group">
                    <label for="categories">دسته بندی ها</label>
                    <select class="form-control" name="categories[]" id="categories" multiple>
                        @foreach(\App\Models\Category::where('parent_id','>','0')->get() as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- categories filed -->

                <!-- info field -->
                <div class="form-group mb-4">
                    <label for="info">توضیحات انگلیسی پست</label>
                    <textarea class="form-control" name="info" id="info" placeholder="توضیحات انگلیسی پست را وارد کنید.">{{old('info')}}</textarea>
                </div>
                <!-- info field -->

                <!-- system_l field -->
                <div class="form-group mb-4">
                    <label for="system_l">حداقل سیستم مورد نیاز</label>
                    <textarea class="form-control" name="system_l" id="system_l" placeholder="حداقل سیستم مورد نیاز را وارد کنید.">{{old('system_l')}}</textarea>
                </div>
                <!-- system_l field -->

                <!-- system_b field -->
                <div class="form-group mb-4">
                    <label for="system_b">سیستم پیشنهادی</label>
                    <textarea class="form-control" name="system_b" id="system_b" placeholder="سیستم پیشنهادی را وارد کنید.">{{old('system_b')}}</textarea>
                </div>
                <!-- system_b field -->

                <!-- files_setup filed -->
                <div class="form-group mb-4">
                    <label for="files_setup">توضیحات نصب</label>
                    <textarea class="form-control" name="files_setup" id="files_setup" placeholder="توضیحات نصب را وارد کنید.توضیحات را با ویرگول جدا کنید.">{{old('files_setup')}}</textarea>
                </div>
                <!-- files_setup filed -->

                <!-- files_info filed -->
                <div class="form-group mb-4">
                    <label for="files_info">توضیحات فایل ها</label>
                    <textarea class="form-control" name="files_info" id="files_info" placeholder="توضیحات را با ویرگول جدا کنید.اطلاعات فایل هارا را وارد کنید.">{{old('files_info')}}</textarea>
                </div>
                <!-- files_info filed -->

                <!-- download filed -->
                <div class="form-group mb-4">
                    <label for="download">لینک های دانلود</label>
                    <textarea class="form-control" name="download" id="download" placeholder="لینک های دانلود را وارد کنید.">{{old('download')}}</textarea>
                </div>
                <!-- download filed -->

                <!-- tags filed -->
                <div class="form-group">
                    <label for="tags">تگ های پست</label>
                    <input type="text" class="form-control" name="tags" id="tags"
                           placeholder="تگ های پست را وارد کنید.تگ هارا با ویرگول از هم جدا کنید." value="{{old('title')}}">
                </div>
                <!-- tags filed -->


                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ایجاد پست</button>
                    <a href="{{route('admin.posts.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

