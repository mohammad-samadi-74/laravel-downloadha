@component('admin.layouts.content',['title'=>'محصول ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        <li class="breadcrumb-item active">صفحه محصول ها</li>
        @can('ایجاد محصول')
            <li class="breadcrumb-item"><a href="{{route('admin.products.create')}}">صفحه ایجاد محصول جدید</a></li>
        @endcan
    @endslot


    <div class="card" id="admin-products">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول محصول ها</h3>

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

                @can('ایجاد محصول')
                    <div class="d-flex card-tools">
                        <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-secondary">ایجاد محصول جدید</a>
                    </div>
                @endcan
            </div>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped products-table">
                <thead>
                <tr class="bg-secondary">
                    <th>شماره</th>
                    <th>عنوان محصول</th>
                    <th>نویسنده</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr class="border-bottom">
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->user->name}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>
                            <!-- info page -->
                            <a class="btn btn-sm btn-warning" href="{{route('admin.products.info',$product->id)}}">توضیحات</a>

                            <!-- edit page -->
                            @can('ویرایش محصول')
                                <a class="btn btn-sm btn-primary" href="{{route('admin.products.edit',$product->id)}}">ویرایش</a>
                            @endcan

                            <!-- delete page -->
                            @can('حذف محصول')
                                <form class="d-none" action="{{route('admin.products.destroy',$product->id)}}" method="post"
                                      id="delete-product-{{$product->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger"
                                        onclick="document.getElementById('delete-product-{{$product->id}}').submit()">حذف
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-start px-4 py-2">
                {{$products->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
