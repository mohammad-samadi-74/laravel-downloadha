@extends('layouts.app')

@section('script')
    <script>
        $(document).ready(function () {
            $('.store-caption-slider').slick({
                arrows: false,
                dots: false,
                autoplay: true,
                fade: true,
                autoplaySpeed: 10000,
                speed: 1000,
                slidesToShow: 1,
                slidesToScroll: 1,
            });
            $('.store-games-slider').slick({
                dots: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 1500,
                speed: 700,
                slidesToShow: 5,
                slidesToScroll: 1,
                centerMode: 'true',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            $('.store-softs-slider').slick({
                dots: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 1500,
                speed: 1000,
                slidesToShow: 6,
                slidesToScroll: 1,
                centerMode: 'true',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        })
    </script>
@endsection

@section('content')
    <div class="container-fluid" id="store">

        <!-- captions -->
        <div class="store-caption-slider container">
            <div class="caption caption-1">
                <div class="row mx-0">
                    <div class="col-sm-3 offset-2 py-2"><img src="{{asset('images/store/games/games.png')}}" class="img-fluid" alt="games"></div>
                    <div class="col-sm-5  offset-1">
                        <p>سایت دانلود ها مرجع فروش بازی های اورجینال تمامی سیستم ها و پلتفرم ها</p>
                    </div>
                </div>
            </div>
            <div class="caption caption-2">
                <div class="row mx-0">
                    <div class="col-sm-3 offset-2 py-2"><img src="{{asset('images/store/softs/softs.png')}}" class="img-fluid" alt="games"></div>
                    <div class="col-sm-5  offset-1">
                        <p>با عضویت در دانلود ها امکان خرید تمامی نرم افزار های مورد نیازتان را با قیمت مناسب و پشتیبانی ویژه ماداشته باشید</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- !captions -->

        <!-- game slider -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="store-games-slider">
                        <div><a href="#"><img src="{{asset('images/store/games/game (1).jpg')}}" alt=""></a></div>
                        <div><a href="#"><img src="{{asset('images/store/games/game (2).jpg')}}" alt=""></a></div>
                        <div><a href="#"><img src="{{asset('images/store/games/game (3).jpg')}}" alt=""></a></div>
                        <div><a href="#"><img src="{{asset('images/store/games/game (4).jpg')}}" alt=""></a></div>
                        <div><a href="#"><img src="{{asset('images/store/games/game (5).jpg')}}" alt=""></a></div>
                        <div><a href="#"><img src="{{asset('images/store/games/game (6).jpg')}}" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- !game slider -->

        <!-- games -->
        @if($games->count())
            <div class="container" id="store-games">
                <div class="row">
                    @foreach($games as $game)
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header"><h4>{{$game->name}}</h4></div>
                                <div class="card-body">
                                    <div class="wallpaper">
                                        <img src="{{$game->wallpaper}}" class="img-fluid" alt="image">
                                        <div class="description">{!! $game->description !!}</div><span>...</span>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <form class="d-none" action="{{route('addToCart',$game->id)}}" method="post" id="add-to-cart-{{$game->id}}">
                                        @csrf
                                    </form>
                                    <a href="#" onclick="event.preventDefault();document.getElementById('add-to-cart-{{$game->id}}').submit()" class="btn btn-success btn-sm px-3"><i class="font-16 fas fa-cart-plus"></i></a>
                                    <a href="{{route('singleProduct',$game->id)}}" class="btn btn-warning btn-sm px-3">بیشتر</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row pagination">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 mt-4">
                        {{$games->appends(['search'=>request('search') , 'category'=>request('category')])->links()}}
                    </div>
                </div>
            </div>
        @endif
        <!-- !games -->

        <!-- softs slider -->
        <div class="container-fluid bg-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="store-softs-slider">
                            <div><a href="#"><img src="{{asset('images/store/softs/soft-1.png')}}" alt=""></a></div>
                            <div><a href="#"><img src="{{asset('images/store/softs/soft-2.png')}}" alt=""></a></div>
                            <div><a href="#"><img src="{{asset('images/store/softs/soft-3.png')}}" alt=""></a></div>
                            <div><a href="#"><img src="{{asset('images/store/softs/soft-4.png')}}" alt=""></a></div>
                            <div><a href="#"><img src="{{asset('images/store/softs/soft-5.png')}}" alt=""></a></div>
                            <div><a href="#"><img src="{{asset('images/store/softs/soft-6.png')}}" alt=""></a></div>
                            <div><a href="#"><img src="{{asset('images/store/softs/soft-7.png')}}" alt=""></a></div>
                            <div><a href="#"><img src="{{asset('images/store/softs/soft-8.png')}}" alt=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- !softs slider -->

        <!-- softs -->
        @if($softs->count())
            <div class="container" id="store-softs">
                <div class="row">
                    @foreach($softs as $soft)
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header"><h4>{{$soft->name}}</h4></div>
                                <div class="card-body">
                                    <div class="wallpaper">
                                        <img src="{{$soft->wallpaper}}" class="img-fluid" alt="image">
                                        <div class="description">{!! $soft->description !!}</div><span>...</span>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <form class="d-none" action="{{route('addToCart',$soft->id)}}" method="post" id="add-to-cart-{{$soft->id}}">
                                        @csrf
                                    </form>
                                    <a href="#" onclick="event.preventDefault();document.getElementById('add-to-cart-{{$soft->id}}').submit()" class="btn btn-success btn-sm px-3"><i class="font-16 fas fa-cart-plus"></i></a>
                                    <a href="{{route('singleProduct',$soft->id)}}" class="btn btn-warning btn-sm px-3">بیشتر</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row pagination">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 mt-4">
                        {{$softs->appends(['search'=>request('search') , 'category'=>request('category')])->links()}}
                    </div>
                </div>
            </div>
        @endif
        <!-- !softs -->
    </div>

@endsection
