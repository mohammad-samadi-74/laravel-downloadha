<header id="navigation" class="bg-nav">
    <div class="container-lg px-0">
        <nav class="navbar navbar-expand-md navbar-light bg-nav rtl justify-content-between">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_navigation"
                    aria-controls="main_navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>

            <div class="collapse navbar-collapse" id="main_navigation">
                <ul class="navbar-nav mr-auto mt-1 pr-1">
                    <li class="nav-item">
                        <a class="nav-link {{is_route(['home'])}}" href="{{route('home')}}">خانه</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{is_route(['store'])}}" href="{{route('store')}}">فروشگاه</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{is_route(['angoman'])}}" href="{{route('angoman')}}">انجمن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{is_route(['tablighat'])}}" href="{{route('tablighat')}}">تبلیغات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{is_route(['contact-us'])}}" href="{{route('contact-us')}}">تماس با ما</a>
                    </li>
                </ul>
            </div>

            <button id="socials_btn_toggle" class="d-lg-none btn text-white" type="button" data-toggle="collapse"
                    data-target="#socials_down_navigation" aria-expanded="false"
                    aria-controls="socials_down_navigation">
                شبکه های اجتماعی
            </button>

            <div class="collapse navbar-collapse justify-content-end " id="socials_navigation">
                <ul class=" navbar-nav mt-1 pr-1">
                    <li class="nav-item "><a class="nav-link" href="https://www.facebook.com"><i
                                class="fab fa-facebook"></i></a></li>
                    <li class="nav-item "><a class="nav-link" href="https://www.twitter.com"><i
                                class="fab fa-twitter"></i></a></li>
                    <li class="nav-item "><a class="nav-link" href="https://www.instagram.com"><i
                                class="fab fa-instagram"></i></a></li>
                    <li class="nav-item "><a class="nav-link" href="http://feed.downloadha.com/downloadha-feed/"><i
                                class="fas fa-rss"></i></a></li>
                    <li class="nav-item "><a class="nav-link" href="https://support.google.com/accounts"><i
                                class="fab fa-google-plus"></i></a></li>
                </ul>
            </div>

        </nav>


        <div class="collapse bg-dark d-lg-none" id="socials_down_navigation">
            <ul class="d-flex justify-content-center mb-0">
                <li class="nav-item "><a class="nav-link" href="#"><i class="fab fa-facebook"></i></a></li>
                <li class="nav-item "><a class="nav-link" href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="nav-item "><a class="nav-link" href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="nav-item "><a class="nav-link" href="#"><i class="fas fa-rss"></i></a></li>
                <li class="nav-item "><a class="nav-link" href="#"><i class="fab fa-google-plus"></i></a></li>
            </ul>
        </div>

    </div>

</header>

<!-- profile navigation -->
<div id="profile-navigation" class="container-fluid">
    <div class="container d-flex">
        @guest
            <div><a class="border-left border-light" href="{{route('login')}}">ورود</a></div>
            <div><a class="border-left border-light" href="{{route('register')}}">ثبت نام</a></div>
        @endguest
        @auth
                @if(auth()->user()->rules->count())
                    <div><a class="border-left border-light" href="{{route('admin')}}">پنل مدیریت</a></div>
                @endif
                <div><a class="border-left border-light" href="{{route('profile')}}">پروفایل</a></div>
                <div>
                    <form action="{{route('logout')}}" method="post" id="logout" class="d-none">
                        @csrf
                    </form>
                    <a class="border-left border-light" href="" onclick="event.preventDefault();document.getElementById('logout').submit()">خروج</a>
                </div>
        @endauth
        <div class="d-flex justify-content-center align-items-center"><a href="{{route('cart')}}"><i class="text-white fas fa-shopping-cart"></i></a></div>
    </div>
</div>
<!-- profile navigation -->

