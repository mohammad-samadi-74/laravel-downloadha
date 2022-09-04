@component('admin.layouts.content',['title'=>'ویرایش دسته بندی '])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده دسته بندی ها')
            <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">صفحه دسته بندی ها</a></li>
        @endcan
        @can('ایجاد دسته بندی')
            <li class="breadcrumb-item"><a href="{{route('admin.categories.create')}}">صفحه ایجاد دسته بندی جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ویرایش دسته بندی</li>
    @endslot

    @slot('script')
        <script>
            $('#children-cats').select2({placeholder:'زیر مجموعه ها را انتخاب کنید.'})
        </script>
    @endslot

    <div class="card" id="admin-categories">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ایجاد دسته بندی جدید</h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body px-4">
            <form action="{{route('admin.categories.update',$category->id)}}" method="post">
            @csrf
            @method('PATCH')

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                    @endforeach
                @endif
            <!-- errors -->

                <!-- name filed -->
                <div class="form-group">
                    <label for="name">نام دسته بندی</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="عنوان دسته بندی را وارد کنید." value="{{old('name',$category->name)}}">
                </div>

                <!-- دسته بندی مادر -->
                <div class="form-group">
                    <label for="parent-cat">دسته بندی مادر</label>
                    <select class="form-control" name="parent-cat" id="parent-cat">
                        <option class="bg-warning" value="">دسته اصلی</option>
                        @foreach(\App\Models\Category::all() as $cat)
                            <option value="{{$cat->id}}" {{ isset($category->parent_category->name) && $cat->name === $category->parent_category->name ? 'selected' : ''}}>{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- زیرمجموعه ها -->
                <div class="form-group">
                    <label for="children-cats">زیرمجموعه ها</label>
                    <select class="form-control" name="children-cats[]" id="children-cats" multiple>
                        @foreach(\App\Models\Category::all() as $cat)
                            <option value="{{$cat->id}}" {{ in_array($cat->name,$category->categories()->pluck('name')->toArray()) ? 'selected' : ''}}>{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ویرایش دسته بندی</button>
                    <a href="{{route('admin.categories.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

