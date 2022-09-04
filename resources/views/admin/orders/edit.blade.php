@component('admin.layouts.content',['title'=>'ایجاد سفارش جدید'])

    @slot('breadCrumb')
        <li class="breadcrumb-item"><a href="{{route('admin')}}">صفحه ادمین</a></li>
        @can('مشاهده سفارش ها')
            <li class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">صفحه سفارش ها</a></li>
        @endcan
        <li class="breadcrumb-item active">صفحه ویرایش سفارش</li>
    @endslot


    <div class="card" id="admin-orders">
        <!-- /.card-header -->
        <div class="card-body px-4">
            <form action="{{route('admin.orders.update',$order->id)}}" method="post">
            @csrf
            @method('PATCH')

            <!-- errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger shadow-sm border-0">{{ $error }}</div>
                    @endforeach
                @endif
            <!-- errors -->

                <!-- order_id filed -->
                <div class="form-group">
                    <label for="id">شماره سفارش</label>
                    <input type="number" class="form-control" name="id" id="id" value="{{old('id',$order->id)}}" disabled>
                </div>
                <!-- order_id filed -->

                <!--price filed -->
                <div class="form-group">
                    <label for="price">هزینه سفارش</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{old('price',$order->price)}}" disabled>
                </div>
                <!--price filed -->

                <!-- status filed -->
                <div class="form-group">
                    <label for="status">وضعیت سفارش</label>
                    <select class="form-control" name="status" id="status" value="{{old('status',$order->status)}}">
                        @php $status = ['unpaid','paid','preparation','canceled','posted','received']; @endphp
                        @foreach($status as $s)
                            <option value="{{$s}}" {{old('status',$order->status) == $s ? 'selected' : ''}}>{{showOrderStatus($s)}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- status filed -->

                <!-- tracking_serial filed -->
                <div class="form-group">
                    <label for="tracking_serial">پسوورد سفارش</label>
                    <input type="string" class="form-control" name="tracking_serial" id="tracking_serial"
                           placeholder="کد پیگیری را وارد کنید." value="{{old('tracking_serial',$order->tracking_serial)}}">
                </div>
                <!-- tracking_serial filed -->



                <div class="d-flex justify-content-between my-4">
                    <button class="btn btn-sm btn-success " type="submit">ویرایش سفارش</button>
                    <a href="{{route('admin.orders.index')}}" class="btn btn-sm btn-secondary">بازگشت</a>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>


@endcomponent

