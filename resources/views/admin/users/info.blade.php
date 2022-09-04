@component('admin.layouts.content',['title'=>'اطلاعات کاربر'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده کاربران')
        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">صفحه کاربر ها</a></li>
        @endcan
        @can('ایجاد کاربر')
            <li class="breadcrumb-item"><a href="{{route('admin.users.create')}}">صفحه ایجاد کاربر جدید</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه اطلاعات کاربر</li>
    @endslot


    <div class="card" id="admin-users">
        <div class="card-header">
            <h3 class="card-title">اطلاعات کاربر </h3>
            <div class="card-tools">

                <!-- edit role/permission page -->
                @can('ویرایش مقام')
                    <a class="btn btn-sm btn-info" href="{{route('admin.rules.setRule',$user->id)}}">ویرایش مقام</a>
                @endcan

                <!-- edit page -->
                @can('ویرایش کاربر')
                    <a class="btn btn-sm btn-primary" href="{{route('admin.users.edit',$user->id)}}">ویرایش</a>
                @endcan

            <!-- delete page -->
                @can('حذف کاربر')
                    <form class="d-none" action="{{route('admin.users.destroy',$user->id)}}" method="post"
                          id="delete-user-{{$user->id}}">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button class="btn btn-sm btn-danger"
                            onclick="document.getElementById('delete-user-{{$user->id}}').submit()">حذف
                    </button>
                @endcan

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-hover table-striped users-table">

                <tr class="bg-secondary"><td class="pl-1">خصوصیت</td><td>مقدار</td></tr>

                <!-- id -->
                <tr><td>id</td><td>{{$user->id}}</td></tr>

                <!-- name -->
                <tr><td>نام کاربر</td><td>{{$user->name}}</td></tr>

                <!-- rules -->
                <tr>
                    <td>مقام کاربر</td>
                    <td>
                        @foreach($user->rules()->pluck('name')->toArray() as $rule)
                            <span class="m-1 badge badge-success">{{$rule}}</span>
                        @endforeach
                    </td>
                </tr>

                <!-- permissions -->
                @if($user->permissions->count())
                    <tr>
                        <td>دسترسی ها</td>
                        <td>
                        <td>
                            @foreach($user->permissions()->pluck('name')->toArray() as $permission)
                                <span class="m-1 badge badge-success">{{$permission}}</span>
                            @endforeach
                        </td>
                        </td>
                    </tr>
                @endif




                <!-- email -->
                <tr><td>ایمیل کاربر</td><td>{{$user->email}}</td></tr>

                <!-- email_verified -->
                <tr><td>وضعیت ایمیل کاربر</td><td>{!! $user->email_verified_at ? '<span class="ml-2"> <i class="badge badge-success p-1">تایید شده</i> در تاریخ</span>'.jdate($user->email_verified_at)->format('Y/m/d ساعت: H:i:s') : ' <i class="badge badge-danger p-1">تایید نشده</i>'!!}</td></tr>

                <!-- phone_number -->
                <tr><td>شماره موبایل کاربر</td><td>{{$user->phone_number ?? 'ندارد'}}</td></tr>

                <!-- phone_number_verified -->
                <tr><td>وضعیت شماره موبایل کاربر</td><td>{!! $user->phone_verified_at ? '<span class="ml-2"> <i class="badge badge-success p-1">تایید شده</i> در تاریخ</span>'.jdate($user->phone_verified_at)->format('Y/m/d ساعت: H:i:s') : ' <i class="badge badge-danger p-1">تایید نشده</i>'!!}</td></tr>

                <!-- created_at -->
                <tr><td>تاریخ ایجاد کاربر</td><td>{{jdate($user->created_at)->format('Y/m/d ساعت: H:i:s')}}</td></tr>

                <!-- updated_at -->
                <tr><td>تاریخ آپدیت کاربر</td><td>{{jdate($user->updated_at)->format('Y/m/d ساعت: H:i:s')}}</td></tr>

                <!-- two_factor_auth -->
                <tr><td>وضعیت احراز هویت دو مرحله ای</td><td>{!! $user->two_factor_auth == 'off' ? '<span class="badge badge-danger m-1 font-14">غیرفعال</span>' : "<span class='badge badge-success p-1 font-14'>$user->two_factor_auth</span>"!!}</td></tr>

                <!-- staff -->
                <tr><td>کارمند سایت:</td><td>{!!$user->is_staff == 1 ? '<i class="fas fa-check-circle font-20 text-success"></i>' : '<i class="fas fa-times-circle font-20 text-danger"></i>' !!}</td></tr>

                <!-- super_user -->
                <tr><td>سوپر یوزر:</td><td>{!!$user->is_superuser == 1 ? '<i class="fas fa-check-circle font-20 text-success"></i>' : '<i class="fas fa-times-circle font-20 text-danger"></i>' !!}</td></tr>

                <!-- user addresses -->
                @if($user->addresses->count())
                    <tr><td colspan="2">آدرس ها:</td></tr>
                    <tr style="background-color: #dc3545;box-shadow: 0 0 6px 4px inset #00000096;">
                        <td colspan="2">
                            @foreach($user->addresses as $address)
                                <table class="table table-striped">
                                    <tr><td>آی دی</td><td>{{$address->id}}</td></tr>
                                    <tr><td>استان</td><td>{{$address->state}}</td></tr>
                                    <tr><td>شهر/شهرستان</td><td>{{$address->city}}</td></tr>
                                    <tr><td>آدرس</td><td>{{$address->address}}</td></tr>
                                    <tr><td>کد پستی</td><td>{{'1369719311'}}</td></tr>
                                    <tr><td>تلفن ثابت</td><td>{{$address->phone}}</td></tr>
                                    <tr><td>شماره موبایل</td><td>{{$address->cellphone_number}}</td></tr>
                                    <tr>
                                        <td colspan="2">
                                            @can('ویرایش آدرس')
                                                <a class="btn btn-sm btn-info" href="{{route('address.edit',['address'=>$address->id,'user_id'=>$user->id])}}">ویرایش آدرس</a>
                                            @endcan
                                            @can('حذف آدرس')
                                                <form class="d-none" action="{{route('address.destroy',$address->id)}}" method="post" id="delete-address-{{$address->id}}">
                                                    @csrf
                                                    @method("DELETE")
                                                </form>
                                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-address-{{$address->id}}').submit()">حذف آدرس</button>
                                            @endcan
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        </td>
                    </tr>
                @endif

            </table>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent
