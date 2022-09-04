@component('admin.layouts.content',['title'=>'محصول ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده محصولات')
            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">صفحه محصولات</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه کامنت های محصول </li>
        <li class="breadcrumb-item"><a href="{{route('admin.products.info',$product->id)}}">صفحه اطلاعات محصول</a></li>
    @endslot


    <div class="card" id="admin-products">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول کامنت ها</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <h5 class="font-16 px-4 py-3"><span class="ml-4">عنوان محصول:</span>{{$product->name}}</h5>

            <!-- comments -->
            <div class="bg-white mt-4 p-3" id="comments">
                <!-- show comments -->
                <div class="comments">
                    @foreach($product->comments()->where('parent_id',0)->get() as $comment)
                        @include('layouts.components.info_comment')
                    @endforeach
                </div>
                <!-- show comments -->
            </div>
            <!-- comments -->

            <div class="d-flex justify-content-start px-4 py-2">
                {{$comments->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
