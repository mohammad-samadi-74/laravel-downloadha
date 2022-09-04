@component('admin.layouts.content',['title'=>'پرداخت ها'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        <li class="breadcrumb-item active">صفحه پرداخت ها</li>
    @endslot


    <div class="card" id="admin-payment s">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">جدول پرداخت ها</h3>

            <div class="d-flex card-tools justify-content-center">
                <form class="form-inline ml-3 search">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar text-center" type="search" placeholder="جستجو"
                               name="search" aria-label="Search" value="{{request('search') ?? ''}}">
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
            <table class="table table-hover table-striped payments-table">
                <thead>
                    <tr class="bg-secondary">
                    <th>آی دی سفارش</th>
                    <th>آی دی پرداخت</th>
                    <th>کاربر</th>
                    <th>نحوه پرداخت</th>
                    <th>وضعیت پرداخت</th>
                    <th>پست</th>
                    <th>شماره سفارش</th>
                    <th>وضعیت سفارش</th>
                    <th>بیشتر</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($payments as $payment )
                        <tr class="border-bottom">
                            <td>{{$payment->order->id}}</td>
                            <td>{{$payment->id}}</td>
                            <td>{{$payment->order->user->name}}</td>
                            <td>{{$payment->payment_method}}</td>
                            <td>{{$payment->status ? 'پرداخت شده' : 'پرداخت نشده'}}</td>
                            <td>{{$payment->post_method}}</td>
                            <td>{{$payment->resNumber ?? ''}}</td>
                            <td>{{showOrderStatus($payment->order->status)}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#payemnt-{{$payment->id}}-modal">
                                    <i class="font-20 text-white fas fa-info-circle"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="payemnt-{{$payment->id}}-modal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <table class="border table table-striped">
                                                    <tr>
                                                        <td>آی دی سفارش</td>
                                                        <td>{{$payment->order->id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>آی دی پرداخت</td>
                                                        <td>{{$payment->id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>کاربر</td>
                                                        <td>{{$payment->order->user->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>نحوه پرداخت</td>
                                                        <td>{{$payment->payment_method}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>وضعیت پرداخت</td>
                                                        <td>{{$payment->status ? 'پرداخت شده' : 'پرداخت نشده'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>پست</td>
                                                        <td>{{$payment->post_method}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>تاریخ پست</td>
                                                        <td>{{jdate($payment->post_date)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>شماره سفارش</td>
                                                        <td>{{$payment->resNumber ?? ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>وضعیت سفارش</td>
                                                        <td>{{showOrderStatus($payment->order->status)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>تاریخ ایجاد</td>
                                                        <td>{{jdate($payment->created_at)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>تاریخ آپدیت</td>
                                                        <td>{{jdate($payment->updated_at)}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>


            <div class="d-flex justify-content-start px-4 py-2">
                {{$payments->appends(['search'=>request('search'),'type'=>request('type')])->render("pagination::bootstrap-4")}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
