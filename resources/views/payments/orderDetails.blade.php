@extends('layouts.app')

@section('script')
    <script>

        document.querySelector('input[name="payment_method"]').checked = true;

        $('input[name="payment_method"]').change(function (event) {
            let paymentsTab = $('#payments-tab')

            if (event.target.value == 'پرداخت در محل') {
                paymentsTab.removeClass('d-block').addClass('d-none');
            }

            if (event.target.value == 'پرداخت آنلاین') {
                paymentsTab.removeClass('d-none').addClass('d-block');
            }
        })
    </script>
@endsection

@section('content')

    <div class="container" id="orderDitails">
        <div class="row">
            <div class="col-sm-4">
                <div class="items">
                    <h4>لیست کالا های سفارش</h4>
                    <div class="d-flex flex-column">
                        @foreach($order->products as $product)
                            <div class="item">
                                <h6 class="p-2 bg-light d-flex flex-column justify-content-between">
                                    <span>{{$product->name}}</span><span><i class="my-2 font-16 badge badge-warning">تعداد : {{$product['pivot']['quantity']}}</i></span>
                                </h6>
                                <div class="d-flex flex-column justify-content-center">
                                    <img class="img-fluid" src="/{{$product->wallpaper}}" alt="wallpaper">
                                    <ul>
                                        @foreach($product->attributes as $attr)
                                            @php
                                                $value = \App\Models\AttributeValue::find($attr['pivot']['value_id']);
                                            @endphp
                                            @if($attr->name == 'رنگ')
                                                <li><span>{{$attr->name}}</span> : <i class="fas fa-circle"
                                                                                      style="color: {{$value->value}}"></i>
                                                </li>
                                            @else
                                                <li><span>{{$attr->name}}</span> : <span>{{$value->value}}</span></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-sm-8 pr-0">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif
                <form action="{{route('payment',$order->id)}}" method="post">
                    @csrf
                    <div class="d-flex flex-column">
                        <!-- address -->
                        <div class="address">
                            <h5><i class="mx-3 font-20 fas fa-search-location"></i>انتخاب آدرس ارسال</h5>
                            <div class="show_address">
                                @if(auth()->user()->addresses)
                                    <div class="d-flex flex-column">
                                        @foreach(auth()->user()->addresses  as $address)
                                                <label for="{{$loop->index}}-address_id" class="mx-3 l-radio">
                                                    <input type="radio" id="{{$loop->index}}-address_id" name="address_id"
                                                           value="{{$address->id}}" tabindex="{{$loop->index+1}}" @if($loop->index == 0) checked @endif>
                                                    <span>{{$address->address}}</span>
                                                </label>
                                        @endforeach
                                    </div>

                                    <a href="{{route('address.create')}}" class="mx-3 my-4  btn btn-sm btn-info">ثبت
                                        آدرس جدید</a>

                                @else
                                    <div class="p-3 m-2 bg-light">آدرسی برای شما ثبت نشده است. لطفا ابتدا آدرس خود را
                                        برای سفارش وارد کنید.
                                    </div>
                                    <a href="{{route('address.create')}}" class="mx-3 my-4  btn btn-sm btn-info">ثبت
                                        آدرس جدید</a>
                                @endif
                            </div>
                        </div>
                        <!-- address -->

                        <!-- post method -->
                        <div class="post-methods">
                            <h5><i class="mx-3 font-20 fas fa-mail-bulk"></i>انتخاب نحوه ارسال</h5>
                            <div class="show_methods my-3">
                                <label for="1-post_method" class="mx-3 l-radio">
                                    <input type="radio" id="1-post_method" name="post_method" value="پست معمولی" tabindex="1" checked >
                                    <span>پست معمولی</span>
                                </label>
                                <label for="2-post_method" class="mx-3 l-radio">
                                    <input type="radio" id="2-post_method" name="post_method" value="پست پیشتاز" tabindex="2">
                                    <span>پست پیشتاز</span>
                                </label>
                            </div>
                        </div>
                        <!-- post method -->

                        <!-- post date -->
                        <div class="post-date my-3">
                            <h5><i class="mx-3 font-20 fas fa-calendar-week"></i>انتخاب تاریخ ارسال</h5>
                            <div class="show_dates">
                                @php $today = \Carbon\Carbon::now()->nextWeekday()->toDateString(); @endphp
                                @for($i=1 ; $i<6 ; $i++)
                                    @php $date = \Illuminate\Support\Carbon::now()->addDay(2+$i); @endphp
                                    <label for="{{$i}}-post_date" class="mx-3 l-radio">
                                        <input type="radio" id="{{$i}}-post_date" name="post_date"
                                               value="{{$date}}" tabindex="1">
                                        <span>{{jdate($date)->format('l Y/m/d')}}</span>
                                    </label>
                                @endfor
                            </div>
                        </div>
                        <!-- post date -->

                        <!-- payment method -->
                        <div class="payment my-3 ">
                            <h5><i class="mx-3 font-20 fas fa-coins"></i>انتخاب نحوه پرداخت</h5>
                            <label for="1-payment_method" class="mx-3 l-radio">
                                <input type="radio" id="1-payment_method" name="payment_method" value="پرداخت در محل" tabindex="1" checked>
                                <span>پرداخت در محل</span>
                            </label>
                            <label for="2-payment_method" class="mx-3 l-radio">
                                <input type="radio" id="2-payment_method" name="payment_method" value="پرداخت آنلاین" tabindex="2">
                                <span>پرداخت آنلاین</span>
                            </label>

                            <div id="payments-tab" class="d-none">
                                <h6 class="text-success font-18 my-2 px-4">درگاه مورد نظر را انتخاب کنید.</h6>
                                <div class="payments d-flex m-2 border rounded p-3">

                                    <div class="mx-2 payping w-20 d-flex flex-column">
                                        <img src="/images/store/payments/payping.jpg" class="img-fluid" alt="payping">
                                        <label for="1-payment" class="mx-3 l-radio">
                                            <input type="radio" id="1-payment" name="payment" value="payping" tabindex="1">
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="mx-2 parsian w-20 d-flex flex-column">
                                        <img src="/images/store/payments/parsian.png" class="img-fluid" alt="parsian">
                                        <label for="2-payment" class="mx-3 l-radio">
                                            <input type="radio" id="2-payment" name="payment" value="parsian" tabindex="2">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- payment method -->

                        <div class="shadow-md">
                            <table class="table table-striped">
                                <tr>
                                    <td>قیمت کالا ها:</td>
                                    <td>{{$order->price}} تومان</td>
                                </tr>
                                <tr>
                                    <td>تخفیف کالا ها:</td>
                                    <td>0 تومان</td>
                                </tr>
                                <tr>
                                    <td>قیمت مجموع:</td>
                                    <td>{{$order->price}} تومان</td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-center pb-2 ">
                                <button type="submit" class="mx-2 btn btn-sm btn-success">ثبت نهایی سفارش</button>
                                <a href="{{route('profile').'/3'}}" class="mx-2 btn btn-sm btn-secondary">لیست سفارش
                                    ها</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
