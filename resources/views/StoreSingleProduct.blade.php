@extends('layouts.app')

@section('script')
    <script>
        $(document).ready(function () {

            $('.images').slick({
                fade: true,
                dots: true,
                adaptiveHeight: true,
                arrows:false
            });
        })
    </script>
@endsection

@section('content')
    <div class="container" id="singleProduct">
        <div class="row px-0">
            <div class="col-sm-4">
                <div class="images">
                    <div><img src="{{asset($product->wallpaper)}}" class="img-fluid" alt="image"></div>
                    @foreach($product->images as $image)
                        <div><img src="{{asset($image->image)}}" class="img-fluid" alt="image"></div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-5 info">
                <div><h4>{{$product->name}}</h4></div>
                <div class="categories">
                    <span>دسته بندی ها:</span>
                    @php
                        $product->categories()->count() ?
                        $product->categories()->orderBy('parent_id')->take(3)->get()->each(function($cat,$index){
                            if($index == 0){
                                echo '<a class="category" href="?category='.$cat->name.'">'.$cat->name.'</a>&nbsp';
                            }else{
                                echo '<span class="text-dark">/</span><a class="category" href="?category='.$cat->name.'">'.$cat->name.'</a>';
                            }
                        }) : ''
                    @endphp
                </div>

                <!-- views -->
                <div class="post-views d-flex justify-content-end post-views-{{$product->id}} mt-4 mb-5">
                    <div class="send-rate">
                        <a href="#" class="likeproduct" productId="{{$product->id}}"><i class="far fa-thumbs-up"></i></a>
                        <a href="#" class="dislikeproduct" productId="{{$product->id}}"><i class="far fa-thumbs-down"></i></a>
                    </div>
                    <div class="d-flex ">
                        @php
                            $rate = $product->likes+$product->dislikes !== 0 ? floor($product->likes/($product->dislikes + $product->likes)*5) : 0 ;
                                $stars = '';
                                $rateStars = $rate;
                                for($i=1 ; $i<=5 ; $i++){
                                    if($rateStars<1){
                                        $stars .= '<div class="container"><i class="fas fa-star"></i></div>';
                                    }else{
                                        $stars .= '<div class="container"><i class="fas fa-star"></i><i class="star fas fa-star"></i></div>';
                                        --$rateStars;
                                    }
                                }
                        @endphp
                        <div class="stars d-flex flex-row-reverse">
                            {!! $stars !!}
                        </div>
                        <div class="rate"><span>{{$rate}}/5</span><span class="mx-1">({{$product->likes}} <i>امتیاز </i>)</span></div>
                    </div>
                </div>
                <!-- views -->

                <div class="more">
                    <h5>ویژگی های کالا</h5>
                    <ul class="attributes">
                        @php
                        $values = collect([]);
                            $product->attributes->where('name','رنگ')->each(function($attr) use($values){
                                $values->add(\App\Models\AttributeValue::find($attr->pivot->value_id)->value);
                            });
                        @endphp
                        <li>
                            <p class="d-flex align-items-center m-0">
                                <span class="text-title-blue">رنگ</span> :
                                @foreach($values as $value)
                                    <i class="m-2 rounded-circle d-inline-block  color" style="width:20px;height:20px;background-color: {{$value}}"></i>
                                @endforeach
                            </p>
                        </li>
                        @foreach($product->attributes->where('name','!=','رنگ') as $attribute)
                            <li><p><span class="text-title-blue">{{$attribute->name}}</span> : <span>{{\App\Models\AttributeValue::find($attribute->pivot->value_id)->value}}</span></p></li>
                        @endforeach
                    </ul>
                    <div class="description">{!! $product->description !!}</div>
                    <div class="last-update"><span>آخرین تاریخ بروز رسانی محصول:</span><i>{{$product->updated_at}}</i></div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="order d-flex flex-column">
                    <div><h5>فروشنده:</h5> دانلود ها</div>
                    <div class="warranty badge badge-success p-2 mb-2">گارانتی ۱۸ ماهه دانلود ها</div>
                    <div><h5>موجودی در انبار:</h5><span>{{$product->inventory}}</span></div>
                    <div><h5>روش های ارسال:</h5><br><span>ارسال دانلود ها | پست پیشتاز | پست معمولی</span></div>
                    <div><h5>قیمت فروشنده:</h5><span>{{$product->price}} تومان</span></div>
                    <form class="d-none" action="{{route('addToCart',$product->id)}}" method="post" id="add-to-cart-{{$product->id}}">
                        @csrf
                    </form>
                    <div><a href="#" onclick="event.preventDefault();document.getElementById('add-to-cart-{{$product->id}}').submit()" class="btn btn-danger d-block btn-sm mt-2 text-white">اضافه کردن به سبد خرید</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
