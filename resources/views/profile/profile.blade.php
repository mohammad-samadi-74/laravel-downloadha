@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card shadow-md" id="profile">
            <div class="card-header d-flex justify-content-between">
                <div class="card-tools d-flex justify-content-center align-items-center"><i
                        class="fas fa-user-circle mx-2"></i>پنل کاربری
                </div>
                <div class="card-tools mx-4 font-18 ">
                    <a class="btn btn-sm btn-warning shadow-sm text-white" href="{{route('admin')}}">پنل ادمین</a>
                    <a class="btn btn-sm btn-info shadow-sm" href="{{route('cart')}}"><i
                            class="fas fa-shopping-basket text-white mx-2"></i>سبد خرید</a>
                    <form class="d-none" action="{{route('logout')}}" method="post" id="logout-acount">
                        @csrf
                    </form>
                    <a class="btn btn-sm btn-danger shadow-sm"
                       onclick="event.preventDefault();document.getElementById('logout-acount').submit()">خروج</a>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- profile navigation -->
                <ul class="nav nav-tabs pr-0" id="profile-menu-navigation" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{$tab == 1 ? 'active' : ''}}" id="home-tab" data-toggle="tab"
                                data-target="#profile-info"
                                type="button" role="tab" aria-controls="profile-info"
                                aria-selected="{{$tab == 1 ? 'true' : 'false'}}">اطلاعات حساب
                            کاربری
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{$tab == 2 ? 'active' : ''}}" id="profile-tab" data-toggle="tab"
                                data-target="#two-factor-auth"
                                type="button" role="tab" aria-controls="two-factor-auth"
                                aria-selected="{{$tab == 2 ? 'true' : 'false'}}">احراز
                            هویت دومرحله ای
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{$tab == 3 ? 'active' : ''}}" id="contact-tab" data-toggle="tab"
                                data-target="#orders-list"
                                type="button" role="tab" aria-controls="orders-list"
                                aria-selected="{{$tab == 3 ? 'true' : 'false'}}">سفارشات
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{$tab == 4 ? 'active' : ''}}" id="contact-tab" data-toggle="tab"
                                data-target="#payments-list"
                                type="button" role="tab" aria-controls="payments-list"
                                aria-selected="{{$tab == 4 ? 'true' : 'false'}}">پرداخت ها
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="profileContent">

                    <!-- profile tab -->
                    <div class="tab-pane fade {{$tab == 1 ? 'show active' : ''}}" id="profile-info" role="tabpanel"
                         aria-labelledby="home-tab">
                        @php $user = auth()->user(); @endphp
                        <table class="table table-striped border border shadow-md mb-0 mt-4">

                            <tr>
                                <td class="bg-secondary text-white" colspan="2"><i></i>اطلاعات حساب کاربری</td>
                            </tr>

                            <tr>
                                <td>نام:</td>
                                <td>{{$user->name}}</td>
                            </tr>

                            <tr>
                                <td>آدرس ایمیل:</td>
                                <td>{{$user->email}}</td>
                            </tr>

                            <tr>
                                <td>تاریخ تایید ایمیل:</td>
                                <td>{{$user->email_verified_at ?? 'تایید نشده'}}</td>
                            </tr>

                            <tr>
                                <td>شماره تلفن:</td>
                                <td>{{$user->phone_number ?? 'ثبت نشده'}}</td>
                            </tr>

                            <tr>
                                <td>احراز هویت دو مرحله ای:</td>
                                <td>{{$user->two_factor_auth === 'off' ? 'غیر فعال' : 'فعال'}}</td>
                            </tr>

                            @if($user->two_factor_auth !== 'off')
                                <tr>
                                    <td> نحوه احراز هویت دو مرحله ای:</td>
                                    <td>{{$user->two_factor_auth}}</td>
                                </tr>
                            @endif

                            <tr>
                                <td>تاریخ تایید شماره تلفن:</td>
                                <td>{{$user->phone_verified_at ?? 'تایید نشده'}}</td>
                            </tr>

                            <tr>
                                <td>تاریخ ایجاد کابر:</td>
                                <td>{{$user->created_at}}</td>
                            </tr>

                            <tr>
                                <td>آخرین تاریخ بروزرسانی:</td>
                                <td>{{$user->updated_at}}</td>
                            </tr>

                        </table>

                        <a class="shadow-md btn btn-sm btn-success my-3 mx-4" href="{{route('editProfile')}}">ویرایش
                            پروفایل</a>

                    </div>
                    <!-- profile tab -->

                    <!-- two factor auth tab -->
                    <div class="tab-pane fade {{$tab == 2 ? 'show active' : ''}}" id="two-factor-auth" role="tabpanel"
                         aria-labelledby="profile-tab">
                        <h4 class="font-14 px-4 py-2 mt-4 mb-0 bg-secondary text-white">فرم تایید احراز هویت دو مرحله
                            ای</h4>

                        <form class="shadow-md p-4" action="{{route('active_two_factor_auth')}}" method="post"
                              autocomplete=off>
                            @csrf

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{{$error}}</div>
                                @endforeach
                            @endif
                            <div class="form-group">
                                <label for="type">نوع احراز هویت :</label>
                                <select class="md-selected w-25 d-inline form-control mx-4" name="type" id="type"
                                        required>
                                    <option value="off" {{$user->two_factor_auth === 'off' ? 'selected' : ''}} >غیر
                                        فعال
                                    </option>
                                    <option value="sms" {{$user->two_factor_auth === 'sms' ? 'selected' : ''}} >اس ام
                                        اس
                                    </option>
                                    <option value="email" {{$user->two_factor_auth === 'email' ? 'selected' : ''}}>
                                        ایمیل
                                    </option>
                                </select>
                            </div>

                            <div class="d-none form-group" id="email">
                                <label for="email">آدرس ایمیل:</label>
                                <input class="d-inline w-50 form-control" type="text" name="email"
                                       value="{{old('email',$user->email)}}">
                            </div>

                            <div class="d-none form-group" id="phone">
                                <label for="phone_number">شماره تلفن:</label>
                                <input class="d-inline w-50 form-control" type="text" name="phone_number"
                                       value="{{old('phone_number',$user->phone_number)}}">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success btn-sm shadow-sm" type="submit">ارسال</button>
                            </div>

                        </form>

                    </div>
                    <!-- two factor auth tab -->

                    <!-- orders tab -->
                    <div class="tab-pane fade {{$tab == 3 ? 'show active' : ''}}" id="orders-list" role="tabpanel"
                         aria-labelledby="contact-tab">
                        <table class="shadow-md table table-striped mb-0 mt-4">
                            <thead class="font-14 text-white bg-secondary">
                            <td>آیدی سفارش</td>
                            <td>تاریخ ثبت</td>
                            <td>قیمت</td>
                            <td>وضعیت سفارش</td>
                            <td>کد رهگیری</td>
                            <td>اقدامات</td>
                            </thead>
                            @php $orders = $user->orders()->orderBy('id','DESC')->paginate(20)->withPath(route('profile').'/3'); @endphp
                            @if(! $orders->count())
                                <tr><td class="text-center py-3" colspan="6">هنوز سفارشی ثبت نشده است.</td></tr>
                            @endif
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{jdate($order->created_a)}}</td>
                                    <td>{{$order->price}} <span>تومان</span></td>
                                    <td>{{showOrderStatus($order->status)}}</td>
                                    <td>{{$order->tracking_serial ?? 'ندارد'}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                                data-target="#orderInfoModal"><i class="fas fa-info"></i></button>
                                        <!-- orderInfo Modal -->
                                        <div class="modal" id="orderInfoModal" tabindex="-1"
                                             aria-labelledby="orderInfoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered ">
                                                <div class="modal-content rounded-0 border-0">
                                                    <div class="modal-body p-0">
                                                        <table class="w-100 shadow-md">
                                                            <tr class="bg-secondary text-white px-4">
                                                                <td class="border-0" colspan="2">جزییات سفارش</td>
                                                            </tr>
                                                            <tr>
                                                                <td>آیدی سفارش</td>
                                                                <td>{{$order->id}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>تاریخ ثبت</td>
                                                                <td>{{jdate($order->created_a)}}</td>
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
                                                                            <div
                                                                                class="col-sm-3 my-2 d-flex flex-column">
                                                                                <img src="/{{$product->wallpaper}}"
                                                                                     class="img-fluid" alt="wallpaper">
                                                                                <div class="my-1 p-1 bg-white">
                                                                                    <div>
                                                                                        <span class="mx-1">تعداد:</span><span>2</span>
                                                                                    </div>
                                                                                    <div>
                                                                                        <span
                                                                                            class="mx-1">{{$product->price * $product->pivot->quantity}}</span>تومان
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- orderInfo Modal -->

                                        @if($order->status === 'unpaid' || ($order->status == 'preparation' && $order->hasUnpaidPayment()))
                                            <a class="btn btn-sm btn-primary"
                                               href="{{route('orderDetails',$order->id)}}">پرداخت</a>
                                            <a class="btn btn-sm btn-danger" href="{{route('cancelOrder',$order->id)}}">لغو
                                                سفارش</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div>
                            {{$orders->render()}}
                        </div>
                    </div>
                    <!-- orders tab -->

                    <!-- payments tab -->
                    <div class="tab-pane fade {{$tab == 4 ? 'show active' : ''}}" id="payments-list" role="tabpanel"
                         aria-labelledby="contact-tab">
                        @php $payments = \App\Models\Payment::orderBy('id','DESC')->paginate('20')->withPath(route('profile').'/4'); @endphp
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
                    <!-- payments tab -->

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        two_factor_auth_hide_form($('#type').val())

        $('#type').change(function () {
            two_factor_auth_hide_form($(this).val());
        })

        function two_factor_auth_hide_form(type) {
            let val = type;
            if (val === 'sms') {
                $('#email').addClass('d-none');
                $('#phone').removeClass('d-none');
            } else if (val === 'email') {
                $('#phone').addClass('d-none');
                $('#email').removeClass('d-none');
            } else {
                $('#phone').addClass('d-none');
                $('#email').addClass('d-none');
            }
        }

    </script>
@endsection
