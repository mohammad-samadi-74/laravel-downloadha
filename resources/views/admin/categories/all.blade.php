@component('admin.layouts.content',['title'=>'دسته بندی ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        <li class="breadcrumb-item active">صفحه دسته بندی ها</li>
        @can('ایجاد دسته بندی')
            <li class="breadcrumb-item"><a href="{{route('admin.categories.create')}}">صفحه ایجاد دسته بندی جدید</a>
            </li>
        @endcan
    @endslot


    <div class="card" id="admin-categorys">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول دسته بندی ها</h3>

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

                @can('ایجاد دسته بندی')
                    <div class="d-flex card-tools">
                        <a href="{{route('admin.categories.create')}}" class="btn btn-sm btn-secondary">ایجاد دسته بندی
                            جدید</a>
                    </div>
                @endcan
            </div>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped categorys-table">
                <thead>
                <tr class="bg-secondary">
                    <th>شماره</th>
                    <th>عنوان دسته بندی</th>
                    <th>زیرمجموعه ها</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($categories as $category)
                    <tr class="border-bottom">
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            @php
                                $cats = $category->categories()->pluck('name');
                                if($cats->count() > 3){
                                    $cats = $cats->take(3)->merge(['...'])->toArray();
                                }elseif($cats->count() == 3){
                                    $cats = $cats->take(3)->toArray();
                                }else{
                                    $cats = $cats->toArray();
                                }
                            @endphp
                            @foreach($cats as $categoryName)
                                @if($loop->last)
                                    <span class="badge badge-pill badge-success p-2">{{$categoryName}}</span>
                                    @break
                                @endif
                                <span class="badge badge-pill badge-success p-2">{{$categoryName}}</span>
                            @endforeach
                        </td>
                        <td>
                            <!-- edit page -->
                            @can('ویرایش دسته بندی')
                                <a class="btn btn-sm btn-primary"
                                   href="{{route('admin.categories.edit',$category->id)}}">ویرایش</a>
                            @endcan
                        <!-- delete page -->
                            @can('حذف دسته بندی')
                                <form class="d-none" action="{{route('admin.categories.destroy',$category->id)}}"
                                      method="post" id="delete-category-{{$category->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger"
                                        onclick="document.getElementById('delete-category-{{$category->id}}').submit()">
                                    حذف
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-start px-4 py-2">
                {{$categories->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
