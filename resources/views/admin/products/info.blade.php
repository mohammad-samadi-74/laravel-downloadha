@component('admin.layouts.content',['title'=>'اطلاعات محصول'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده محصولات')
            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">صفحه محصول ها</a></li>
        @endcan
        @can('ایجاد محصول')
            <li class="breadcrumb-item"><a href="{{route('admin.products.create')}}">صفحه ایجاد محصول جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه اطلاعات محصول</li>
    @endslot


    <div class="card" id="admin-products">
        <div class="card-header">
            <h3 class="card-title">اطلاعات محصول </h3>
            <div class="card-tools">

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

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped products-table">

                <tr class="bg-secondary">
                    <td class="pl-1">خصوصیت</td>
                    <td>مقدار</td>
                </tr>

                <!-- id -->
                <tr>
                    <td>id</td>
                    <td>{{$product->id}}</td>
                </tr>

                <!-- name -->
                <tr>
                    <td>نام</td>
                    <td>{{$product->name}}</td>
                </tr>

                <!-- price -->
                <tr>
                    <td>قیمت</td>
                    <td>{{$product->price}} تومان </td>
                </tr>

                <!-- inventory -->
                <tr>
                    <td>موجودی</td>
                    <td>{{$product->inventory}}</td>
                </tr>

                <!-- created_at -->
                <tr>
                    <td>تاریخ ایجاد</td>
                    <td>{{jdate($product->created_at)}}</td>
                </tr>

                <!-- updated_at -->
                <tr>
                    <td>تاریخ آپدیت</td>
                    <td>{{jdate($product->updated_at)}}</td>
                </tr>

                <!-- description -->
                <tr>
                    <td>توضیحات</td>
                    <td>{!! $product->description !!}</td>
                </tr>


                <!-- categories -->
                <tr>
                    <td>دسته بندی ها</td>
                    <td>
                        @if(empty($product->categories->pluck('name')->toArray()))
                            <p> ندارد </p>
                        @else
                            @foreach($product->categories->pluck('name')->toArray() as $cat)
                                <span class="m-1 badge badge-warning p-2 font-weight-bold font-10">{{$cat}}</span>
                            @endforeach
                        @endif
                    </td>
                </tr>

                <!-- tags -->
                <tr>
                    <td>تگ ها</td>
                    <td>{{!empty($product->tags) ? $product->tags : 'ندارد'}}</td>
                </tr>

                <!-- writer -->
                <tr>
                    <td>نویسنده</td>
                    <td>{{$product->user->name}}</td>
                </tr>

                <!-- views -->
                <tr>
                    <td>بیننده ها</td>
                    <div class="d-flex">
                        <td class="font-v"><span class="views">{{$product->views}}</span></td>
                    </div>
                </tr>

                <!-- likes -->
                <tr>
                    <td>لایک ها</td>
                    <td class="font-v"><span class="likes">{{$product->likes}}</span></td>
                </tr>

                <!-- dislikes -->
                <tr>
                    <td>دیسلایک ها</td>
                    <td class="font-v"><span class="dislikes">{{$product->dislikes}}</span></td>
                </tr>

                <!-- comments  -->
                <tr>
                    <td>کامنت ها</td>
                    <td class="font-v"><span class="comments">{{$product->comments->count()}}</span>
                        @can('مشاهده کامنت ها')
                            <a class="mx-4 btn btn-sm btn-success py-1 px-2 font-12" href="{{route('admin.products.comments.info',$product->id)}}">مشاهده کامنت ها</a>
                        @endcan
                    </td>
                </tr>


                <!-- wallpaper -->
                @if($product->wallpaper && file_exists(public_path($product->wallpaper)))
                    <tr>
                        <td>تصویر</td>
                        <td class="d-flex flex-column image-show">
                            <img src="/{{$product->wallpaper}}" alt="wallpaper" class="w-20 img-fluid">
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>ندارد</td>
                    </tr>
                @endif

            <!-- images -->
                @if($product->images()->count() >= 1 )
                    <tr>
                        <td>گالری</td>
                        <td>
                            @foreach($product->images as $image)
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

            </table>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
