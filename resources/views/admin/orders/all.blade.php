@component('admin.layouts.content',['title'=>'سفارش ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        <li class="breadcrumb-item active">صفحه سفارش ها</li>
    @endslot


    <div class="card" id="admin-orders">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول سفارش ها</h3>

            <div class="d-flex card-tools justify-content-center">

                <form class="form-inline ml-3 search" id="order-type-search">
                    <div class="input-group input-group-sm">
                        <select name="type" id="type"onchange="document.getElementById('order-type-search').submit()">
                            <option value="" {{request('type') == '' ? 'selected' : ''}}>همه سفارش ها</option>
                            <option value="unpaid" {{request('type') == 'unpaid' ? 'selected' : ''}}>پرداخت نشده</option>
                            <option value="paid" {{request('type') == 'paid' ? 'selected' : ''}}>پرداخت شده</option>
                            <option value="preparation" {{request('type') == 'preparation' ? 'selected' : ''}}>در حال آماده سازی</option>
                            <option value="posted" {{request('type') == 'all' ? 'posted' : ''}}>پست شده</option>
                            <option value="canceled" {{request('type') == 'all' ? 'canceled' : ''}}>کنسل شده</option>
                        </select>
                        <input class="mr-1 form-control form-control-navbar text-center" type="search" placeholder="جستجو" name="search" aria-label="Search" value="{{request('search') ?? ''}}">
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
            <table class="table table-hover table-striped orders-table">
                <thead>
                <tr class="bg-secondary">
                    <th>آی دی</th>
                    <th>کاربر</th>
                    <th>قیمت</th>
                    <th>وضعیت سفارش</th>
                    <th>تاریخ ثبت</th>
                    <th>آخرین آپدیت</th>
                    <th>اقدامات</th>
                </tr>
                </thead>

                <tbody>
                @foreach($orders as $order)
                    <tr class="border-bottom">
                        <td>{{$order->id}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->price}} تومان</td>
                        <td>{{showOrderStatus($order->status)}}</td>
                        <td>{{jdate($order->created_at)}}</td>
                        <td>{{jdate($order->updated_at)}}</td>
                        <td>
                            <!-- info page -->
                            <a class="btn btn-sm btn-warning text-white"
                               href="{{route('admin.orders.info',$order->id)}}">توضیحات</a>

                            <!-- edit page -->
                            @can('ویرایش سفارش')
                                <a class="btn btn-sm btn-primary" href="{{route('admin.orders.edit',$order->id)}}">ویرایش</a>
                            @endcan

                        <!-- delete page -->
                            @can('حذف سفارش')
                                <form class="d-none" action="{{route('admin.orders.destroy',$order->id)}}" method="post"
                                      id="delete-order-{{$order->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger"
                                        onclick="document.getElementById('delete-order-{{$order->id}}').submit()">حذف
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-start px-4 py-2">
                {{$orders->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
