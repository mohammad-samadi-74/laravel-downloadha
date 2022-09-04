@component('admin.layouts.content',['title'=>'اطلاعات سفارش'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده سفارش ها')
            <li class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">صفحه سفارش ها</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه اطلاعات سفارش</li>
    @endslot


    <div class="card" id="admin-orders">
        <div class="card-header">
            <h3 class="card-title">اطلاعات سفارش </h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr class="bg-secondary text-white px-4">
                    <td class="border-0" colspan="2">جزییات سفارش</td>
                </tr>
                <tr>
                    <td>آیدی سفارش</td>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <td>سفارش دهنده</td>
                    <td>{{$order->user->name}}</td>
                </tr>
                <tr>
                    <td>تاریخ ثبت</td>
                    <td>{{jdate($order->created_at)}}</td>
                </tr>
                <tr>
                    <td>آخرین تاریخ آپدیت</td>
                    <td>{{jdate($order->updated_at)}}</td>
                </tr>
                <tr>
                    <td>قیمت</td>
                    <td>{{$order->price}} <span>تومان</span></td>
                </tr>
                <tr>
                    <td>وضعیت سفارش</td>
                    <td>{{showOrderStatus($order->status)}}</td>
                </tr>
                <tr>
                    <td>کد رهگیری</td>
                    <td>{{$order->tracking_serial ?? 'ندارد'}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            @foreach($order->products as $product)
                                <div class="col-sm-2 my-2 d-flex flex-column">
                                    <img src="/{{$product->wallpaper}}"
                                         class="img-fluid" alt="wallpaper">
                                    <div class="my-1 p-1 bg-white">
                                        <div>
                                            <span class="mx-1">تعداد:</span><span>2</span>
                                        </div>
                                        <div>
                                            <span class="mx-1">{{$product->price * $product->pivot->quantity}}</span>تومان
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">پرداخت ها</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="table font-12">
                            @php $payments = $order->payments()->orderBy('id','DESC')->get() @endphp
                            <table class="shadow-md w-100 table table-striped mb-0 mt-4">
                                <thead class="font-14 bg-secondary text-white">
                                    <td>آیدی</td>
                                    <td>آیدی سفارش</td>
                                    <td>تاریخ ثبت پرداخت</td>
                                    <td>متد پست</td>
                                    <td>تاریخ دریافت</td>
                                    <td>متد پرداخت</td>
                                    <td>وضعیت پرداخت</td>
                                    <td>قیمت نهایی</td>
                                </thead>
                                @if(! $payments->count())
                                    <tr><td class="text-center py-3" colspan="8">هنوز پرداختی ثبت نشده است.</td></tr>
                                @endif
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->id}}</td>
                                        <td>{{$payment->order->id}}</td>
                                        <td>{{jdate($payment->created_at)}}</td>
                                        <td>{{$payment->post_method}}</td>
                                        <td>{{jdate($payment->post_date)->format('Y/m/d')}}</td>
                                        <td>{{$payment->payment_method}}</td>
                                        <td>{{$payment->status == 0 ? 'پرداخت نشده' : 'پرداخت شده'}}</td>
                                        <td>{{$payment->order->price}} تومان</td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
