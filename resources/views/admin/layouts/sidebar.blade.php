<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3">
                <div class="rounded bg-light py-4 d-flex justify-content-center">
                    <img class="w-75" src="/images/logo.png" alt="logo">
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    @can('مشاهده کاربران')
                        <!-- users -->
                        <li class="nav-item has-treeview {{is_route(['admin.users.index','admin.users.create','admin.users.edit','admin.users.info','address.edit'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['admin.users.index','admin.users.create','admin.users.edit','admin.users.info','address.edit'])}}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                کاربران
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}" class="nav-link {{is_route(['admin.users.index'])}}">
                                    <i class="nav-icon text-danger far fa-circle"></i>
                                    <p>لیست کاربران</p>
                                </a>
                            </li>
                            @can('ایجاد کاربر')
                                <li class="nav-item">
                                    <a href="{{route('admin.users.create')}}" class="nav-link {{is_route(['admin.users.create'])}}">
                                        <i class="text-warning far fa-circle nav-icon"></i>
                                        <p>ایجاد کاربر جدید</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('مشاهده پست ها')
                    <!-- posts -->
                    <li class="nav-item has-treeview {{is_route(['admin.posts.index','admin.posts.create','admin.posts.edit','admin.posts.info'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['admin.posts.index','admin.posts.create','admin.posts.edit','admin.posts.info'])}}">
                            <i class="nav-icon fa fa-paper-plane"></i>
                            <p>
                                پست ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.posts.index')}}" class="nav-link {{is_route(['admin.posts.index'])}}">
                                    <i class="nav-icon text-danger far fa-circle"></i>
                                    <p>لیست پست ها</p>
                                </a>
                            </li>
                            @can('ایجاد پست')
                                <li class="nav-item">
                                    <a href="{{route('admin.posts.create')}}" class="nav-link {{is_route(['admin.posts.create'])}}">
                                        <i class="text-warning far fa-circle nav-icon"></i>
                                        <p>ایجاد پست جدید</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('مشاهده محصولات')
                    <!-- products -->
                    <li class="nav-item has-treeview {{is_route(['admin.products.index','admin.products.create','admin.products.edit','admin.products.info'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['admin.products.index','admin.products.create','admin.products.edit','admin.products.info'])}}">
                            <i class="nav-icon fab fa-product-hunt"></i>
                            <p>
                                محصولات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.products.index')}}" class="nav-link {{is_route(['admin.products.index'])}}">
                                    <i class="nav-icon text-danger far fa-circle"></i>
                                    <p>لیست محصولات</p>
                                </a>
                            </li>
                            @can('ایجاد محصول')
                                <li class="nav-item">
                                    <a href="{{route('admin.products.create')}}" class="nav-link {{is_route(['admin.products.create'])}}">
                                        <i class="text-warning far fa-circle nav-icon"></i>
                                        <p>ایجاد محصول جدید</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('مشاهده دسته بندی ها')
                    <!-- categories -->
                    <li class="nav-item has-treeview {{is_route(['admin.categories.index','admin.categories.create','admin.categories.edit'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['admin.categories.index','admin.categories.create','admin.categories.edit'])}}">
                            <i class="nav-icon fa fa-archive"></i>
                            <p>
                                دسته بندی ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.categories.index')}}" class="nav-link {{is_route(['admin.categories.index'])}}">
                                    <i class="text-danger far fa-circle nav-icon"></i>
                                    <p>لیست دسته بندی ها</p>
                                </a>
                            </li>
                            @can('ایجاد دسته بندی')
                                <li class="nav-item">
                                    <a href="{{route('admin.categories.create')}}" class="nav-link {{is_route(['admin.categories.create'])}}">
                                        <i class="text-warning far fa-circle nav-icon"></i>
                                        <p>ایجاد دسته بندی جدید</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('مشاهده سفارش ها')
                    <!-- orders -->
                    <li class="nav-item has-treeview {{is_route(['admin.orders.index','admin.orders.edit'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['admin.orders.index','admin.orders.edit'])}}">
                            <i class="nav-icon fa fa-archive"></i>
                            <p>
                                سفارش ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.orders.index').'?type='}}" class="nav-link {{in_array(\Illuminate\Support\Facades\Route::currentRouteName() , ['admin.orders.index']) && (!request('type') || request('type') == '') ? 'active' : ''}}">
                                    <i class="text-light far fa-circle nav-icon"></i>
                                    <p class="titles-container"><i>لیست سفارش ها</i>
                                        <i class="badge badge-light 10">{{\App\Models\Order::all()->count()}}</i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.orders.index').'?type=unpaid'}}" class="nav-link {{is_orders_route(['admin.orders.index'],'active','unpaid')}}">
                                    <i class="text-danger far fa-circle nav-icon"></i>
                                    <p class="titles-container"><i>پرداخت نشده ها</i>
                                        <i class="badge badge-danger 10">{{\App\Models\Order::where('status','unpaid')->count()}}</i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.orders.index').'?type=paid'}}" class="nav-link {{is_orders_route(['admin.orders.index'],'active','paid')}}">
                                    <i class="text-success far fa-circle nav-icon"></i>
                                    <p class="titles-container"><i>پرداخت شده ها</i>
                                        <i class="badge badge-success 10">{{\App\Models\Order::where('status','paid')->count()}}</i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.orders.index').'?type=preparation'}}" class="nav-link {{is_orders_route(['admin.orders.index'],'active','preparation')}}">
                                    <i class="text-warning far fa-circle nav-icon"></i>
                                    <p class="titles-container"><i>در حال آماده سازی</i>
                                        <i class="badge badge-warning 10">{{\App\Models\Order::where('status','preparation')->count()}}</i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.orders.index').'?type=posted'}}" class="nav-link {{is_orders_route(['admin.orders.index'],'active','posted')}}">
                                    <i class="text-info far fa-circle nav-icon"></i>
                                    <p class="titles-container"><i>پست شده</i>
                                        <i class="badge badge-info 10">{{\App\Models\Order::where('status','posted')->count()}}</i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.orders.index').'?type=canceled'}}" class="nav-link {{is_orders_route(['admin.orders.index'],'active','canceled')}}">
                                    <i class="text-primary far fa-circle nav-icon"></i>
                                    <p class="titles-container"><i>کنسل شده</i>
                                        <i class="badge badge-primary 10">{{\App\Models\Order::where('status','primary')->count()}}</i>
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endcan

                    @can('مشاهده پرداخت ها')
                    <!-- peyments -->
                    <li class="nav-item has-treeview {{is_route(['payments.index'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['payments.index'])}}">
                            <i class="nav-icon fab fa-product-hunt"></i>
                            <p>
                                پرداخت ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('payments.index')}}" class="nav-link {{is_route(['payments.index'])}}">
                                    <i class="nav-icon text-danger far fa-circle"></i>
                                    <p>لیست پرداخت ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    @can('مشاهده کامنت ها')
                    <!-- comments -->
                    <li class="nav-item has-treeview {{is_route(['admin.comments.index','admin.comments.unapproved','admin.comments.edit'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['admin.comments.index','admin.comments.unapproved','admin.comments.edit'])}}">
                            <i class="nav-icon fa fa-comments"></i>
                            <p>
                                کامنت ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.comments.index')}}" class="nav-link {{is_route(['admin.comments.index'])}}">
                                    <i class="text-danger far fa-circle nav-icon"></i>
                                    <p> تایید شده ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.comments.unapproved')}}" class="nav-link {{is_route(['admin.comments.unapproved'])}}">
                                    <i class="text-warning far fa-circle nav-icon"></i>
                                    <p>تایید نشده ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    @can('مشاهده دسترسی ها')
                    <!-- permissions -->
                    <li class="nav-item has-treeview {{is_route(['admin.permissions.index','admin.permissions.create','admin.permissions.edit'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['admin.permissions.index','admin.permissions.create','admin.permissions.edit'])}}">
                            <i class="nav-icon fa fa-tools "></i>
                            <p>
                                دسترسی ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.permissions.index')}}" class="nav-link {{is_route(['admin.permissions.index'])}}">
                                    <i class="text-danger far fa-circle nav-icon"></i>
                                    <p>دسترسی ها</p>
                                </a>
                            </li>
                            @can('ایجاد دسترسی')
                                <li class="nav-item">
                                    <a href="{{route('admin.permissions.create')}}" class="nav-link {{is_route(['admin.permissions.create'])}}">
                                        <i class="text-warning far fa-circle nav-icon"></i>
                                        <p>ایجاد دسترسی جدید</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('مشاهده مقام ها')
                    <!-- rules -->
                    <li class="nav-item has-treeview {{is_route(['admin.rules.index','admin.rules.create','admin.rules.edit','admin.rules.info'],'menu-open')}}">
                        <a href="#" class="nav-link {{is_route(['admin.rules.index','admin.rules.create','admin.rules.edit','admin.rules.info'])}}">
                            <i class="nav-icon fa fa-user-tag"></i>
                            <p>
                                مقام ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.rules.index')}}" class="nav-link {{is_route(['admin.rules.index'])}}">
                                    <i class="text-danger far fa-circle nav-icon"></i>
                                    <p>مقام ها</p>
                                </a>
                            </li>
                            @can('ایجاد مقام')
                                <li class="nav-item">
                                    <a href="{{route('admin.rules.create')}}" class="nav-link {{is_route(['admin.rules.create'])}}">
                                        <i class="text-warning far fa-circle nav-icon"></i>
                                        <p>ایجاد مقام جدید</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
