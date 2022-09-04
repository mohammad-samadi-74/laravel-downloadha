@extends('layouts.app')

@section('script')
    <script>
        function changeQuantity(event, id) {
            console.log(event.target.value)
            $.ajaxSetup({
                headers: {
                    'X-CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-type': 'application/json'
                }
            })

            $.ajax({
                'url': `/cart/${id}/changeQuantity`,
                'type': 'POST',
                'data': JSON.stringify({
                    '_method': 'patch',
                    'quantity': event.target.value,
                    'id': id
                }),
                'success': function (res) {
                    location.reload()
                }
            })
        }
    </script>
@endsection

@section('content')

    <div class="container" id="cart">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>سبد خرید</h5>
                <div>
                    <a class="btn btn-sm btn-secondary" href="{{route('profile')}}">پروفایل</a>
                    <a class="btn btn-sm btn-primary" href="{{route('store')}}">ادامه خرید</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">نام محصول</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">قیمت واحد</th>
                        <th scope="col">قیمت</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(Cart::all()->count())
                        @foreach(Cart::all() ?? collect([]) as $cartProduct)
                            @php
                                $product = $cartProduct['product'];
                            @endphp
                            <tr>
                                <td class="border d-flex align-items-center" scope="row">
                                    <img src="{{$product->wallpaper}}" class="ml-4" height="60" alt="wallpaper"><p>{{$product->name}}</p>
                                </td>
                                <td class="border text-center">
                                    <form action="{{route('changeQuantity',$product->id)}}" method="post"
                                          id="change-quantity-{{$product->id}}">
                                        @csrf
                                        @method('patch')

                                        <select class="form-control" name="quantity" id="quantity"
                                                onchange="changeQuantity(event,{{$product->id}})">
                                            @foreach(range(1,$product->inventory) as $value)
                                                <option
                                                    value="{{$value}}" {{$cartProduct['quantity'] == $value ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="border text-center">{{$product->price}}<span>تومان</span></td>
                                <td class="border text-center">{{$product->price * $cartProduct['quantity']}}
                                    <span>تومان</span>
                                </td>
                                <td class="border text-center">
                                    <form action="{{route('deleteCartItem',$product->id)}}" method="post" id="deleteCartItem-{{$product->id}}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <a class="d-block" href="#" onclick="event.preventDefault();document.getElementById('deleteCartItem-{{$product->id}}').submit()"><i class="font-24 text-danger fas fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center bg-light py-4">محصولی در سبد خرید وجود ندارد.</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0">
                            @php
                                $total_price = Cart::all()->sum(function($product){
                                    return $product['product']->price * $product['quantity'];
                                })
                            @endphp
                            <div class="p-3 badge badge-light border"><span>قیمت کل :</span>{{$total_price}}
                                <span>تومان</span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a class="btn btn-success btn-sm" href="{{route('createOrder')}}">پرداخت و ثبت سفارش</a>
                <a class="btn btn-danger btn-sm" href="{{route('emptyCart')}}">خالی کردن سبد خرید</a>
            </div>
        </div>
    </div>
@endsection
