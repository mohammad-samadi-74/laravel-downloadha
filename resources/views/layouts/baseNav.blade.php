<header class="shadow-md bg-white" id="fixed-navigation-menu">
    <div class="container-lg px-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white rtl py-0" id="secondNav">
            <button class="navbar-toggler mx-4" type="button" data-toggle="collapse" data-target="#baseNav" aria-controls="baseNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>

            <div class="d-lg-flex d-none collapse navbar-collapse px-0" id="baseNavTop">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 pr-0">
                    <li class="nav-item border-right dropdown animate slideIn">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" id="topSoftCategoryMenu"><i class="fab fa-windows"></i>نرم افزار</a>
                        <div class="category-dropdown dropdown-menu p-4" aria-labelledby="topSoftCategoryMenu">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="categories-title"><a href="?category=سیستم عامل"><i class="fab fa-linux"></i>سیستم عامل</a></div>
                                    @foreach(\App\Models\Category::where('name','سیستم عامل')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach

                                    <div class="categories-title"><a href="?category=نرم افزار اینترنت"><i class="fab fa-chrome"></i>نرم افزار اینترنت</a></div>
                                    @foreach(\App\Models\Category::where('name','نرم افزار اینترنت')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-lg-2">
                                    <div class="categories-title"><a href="?category=نرم افزار امنیتی"><i class="fas fa-lock"></i>نرم افزار امنیتی</a></div>
                                    @foreach(\App\Models\Category::where('name','نرم افزار امنیتی')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach

                                    <div class="categories-title"><a href="?category=نرم افزار مالتی مدیا"><i class="fab fa-microsoft"></i>نرم افزار مالتی مدیا</a></div>
                                    @foreach(\App\Models\Category::where('name','نرم افزار مالتی مدیا')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-lg-2">
                                    <div class="categories-title"><a href="?category=سایر نرم افزار ها"><i class="fas fa-paint-brush"></i>سایر نرم افزار ها</a></div>
                                    @foreach(\App\Models\Category::where('name','سایر نرم افزار ها')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach

                                    <div class="categories-title"><a href="?category=نرم افزار گرافیک"><i class="fas fa-lock"></i>نرم افزار گرافیک</a></div>
                                    @foreach(\App\Models\Category::where('name','نرم افزار گرافیک')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-lg-4">
                                    <div class="categories-title"><a href="?category=نرم افزار کاربردی"><i class="fas fa-tools"></i>نرم افزار کاربردی</a></div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','نرم افزار کاربردی')->first()->categories->chunk(10) as $categories)
                                        <div class="w-50">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item border-right dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" id="topMobileCategoryMenu"><i class="fas fa-mobile-alt"></i>موبایل</a>
                        <div class="category-dropdown dropdown-menu p-4" aria-labelledby="topMobileCategoryMenu">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="categories-title"><a href="?category=نرم افزار اندروید"><i class="fab fa-android"></i>نرم افزار اندروید</a></div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','نرم افزار اندروید')->first()->categories->chunk(10) as $categories)
                                        <div class="w-50">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="categories-title"><a href="?category=بازی اندروید"><i class="fas fa-dice"></i>بازی اندروید</a></div>

                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','بازی اندروید')->first()->categories->chunk(8) as $categories)
                                        <div class="w-50">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="categories-title"><a href="?category=سایر سیستم عامل ها"><i class="fab fa-microsoft"></i>سایر سیستم عامل ها</a></div>
                                    @foreach(\App\Models\Category::where('name','سایر سیستم عامل ها')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach

                                    <div class="categories-title"><a href="?category=مالتی مدیا"><i class="fas fa-photo-video"></i>مالتی مدیا</a></div>
                                    @foreach(\App\Models\Category::where('name','مالتی مدیا')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item border-right dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" id="topGameCategoryMenu"><i class="fab fa-playstation"></i>بازی</a>
                        <div class="category-dropdown dropdown-menu p-4" aria-labelledby="topGameCategoryMenu">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="categories-title"><a href="?category=بازی کامپیوتر"><i class="fas fa-chess-queen"></i>بازی کامپیوتر</a></div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','بازی کامپیوتر')->first()->categories->chunk(10) as $categories)
                                        <div class="w-33">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="categories-title"><a href="?category=بازی سایر سیستم ها"><i class="fab fa-linux"></i>بازی سایر سیستم ها</a></div>
                                    @foreach(\App\Models\Category::where('name','بازی سایر سیستم عامل ها')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <div class="categories-title"><a href="?category=بازی کنسول"><i class="fab fa-playstation"></i>بازی کنسول</a></div>
                                    @foreach(\App\Models\Category::where('name','بازی کنسول')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item border-right dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" id="topMediaCategoryMenu"><i class="fas fa-photo-video"></i>مالتی مدیا</a>
                        <div class="category-dropdown dropdown-menu p-4" aria-labelledby="topMediaCategoryMenu">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="categories-title"><a href="?category=صوتی"><i class="fas fa-music"></i>صوتی</a></div>
                                    @foreach(\App\Models\Category::where('name','صوتی')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <div class="categories-title"><a href="?category=تصویری"><i class="fas fa-film"></i>تصویری</a></div>
                                    @foreach(\App\Models\Category::where('name','تصویری')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <div class="categories-title"><a href="?category=آموزشی"><i class="fas fa-graduation-cap"></i>آموزشی</a></div>
                                    @foreach(\App\Models\Category::where('name','آموزش')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <div class="categories-title"><a href="?category=گرافیک"><i class="fas fa-brush"></i>گرافیک</a></div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','گرافیک')->first()->categories as $category)
                                        <div class="ml-4"><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                        @endforeach
                                    </div>

                                    <div class="categories-title"><a href="?category=ابزار فتوشاپ"><i class="fas fa-pen-square"></i>ابزار فتوشاپ</a></div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','ابزار فتوشاپ')->first()->categories->chunk(3) as $categories)
                                        <div class="d-flex flex-column">
                                            @foreach($categories as $category)
                                            <div class="mr-3">
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="categories-title"><a href="?category=ابزار طراحی"><i class="fas fa-ruler-combined"></i>ابزار طراحی</a></div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','ابزار طراحی')->first()->categories->chunk(5) as $categories)
                                        <div class="d-flex flex-column">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- change them and search box --}}
            <div class="mx-4 d-none" id="search-section">
                <div id="changeThem">
                    <section>
                        <div>
                            <input id="changeThemInput" type="checkbox">
                            <label for="changeThemInput"><i class="fas fa-sun"></i></label>
                        </div>
                    </section>
                </div>
                <div id="searchBox">
                    <form method="get" class="d-flex justify-content-center align-items-center pl-0" id="searchForm">
                        <input type="text" id="search-input" name="search" placeholder="جستجو..." value="{{request('search') ?? ''}}">
                        <a role="button" onclick="event.preventDefault();document.getElementById('searchForm').submit()"><i class="fas fa-search my-1"></i></a>
                    </form>
                </div>
            </div>
            {{-- change them and search box --}}

            {{-- categories dropdown-menu --}}
            <div class="collapse navbar-collapse px-0 d-lg-none" id="baseNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 pr-0">
                    <li class="nav-item border-right dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" id="SoftCategoryMenu"><i class="fab fa-windows"></i>نرم افزار</a>
                        <div class="category-dropdown dropdown-menu p-4" aria-labelledby="SoftCategoryMenu">
                            <div class="row">
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fab fa-linux"></i>سیستم عامل</div>
                                    @foreach(\App\Models\Category::where('name','سیستم عامل')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach

                                    <div class="categories-title"><i class="fab fa-chrome"></i>نرم افزار اینترنت</div>
                                    @foreach(\App\Models\Category::where('name','نرم افزار اینترنت')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-lock"></i>نرم افزار امنیتی</div>
                                    @foreach(\App\Models\Category::where('name','نرم افزار امنیتی')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach

                                    <div class="categories-title"><i class="fab fa-microsoft"></i>نرم افزار مالتی مدیا
                                    </div>
                                    @foreach(\App\Models\Category::where('name','نرم افزار مالتی مدیا')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-paint-brush"></i>سایر نرم افزار ها
                                    </div>
                                    @foreach(\App\Models\Category::where('name','سایر نرم افزار ها')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach

                                    <div class="categories-title"><i class="fas fa-lock"></i>نرم افزار گرافیک</div>
                                    @foreach(\App\Models\Category::where('name','نرم افزار گرافیک')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-tools"></i>نرم افزار کاربردی</div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','نرم افزار کاربردی')->first()->categories->chunk(10) as $categories)
                                        <div class="w-50">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item border-right dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" id="MobileCategoryMenu"><i class="fas fa-mobile-alt"></i>موبایل</a>
                        <div class="category-dropdown dropdown-menu p-4" aria-labelledby="MobileCategoryMenu">
                            <div class="row">
                                <div class="col-md-5 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fab fa-android"></i>نرم افزار اندروید</div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','نرم افزار اندروید')->first()->categories->chunk(10) as $categories)
                                        <div class="w-50">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-dice"></i>بازی اندروید</div>

                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','بازی اندروید')->first()->categories->chunk(8) as $categories)
                                        <div class="w-50">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fab fa-microsoft"></i>سایر سیستم عامل ها
                                    </div>
                                    @foreach(\App\Models\Category::where('name','سایر سیستم عامل ها')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach

                                    <div class="categories-title"><i class="fas fa-photo-video"></i>مالتی مدیا</div>
                                    @foreach(\App\Models\Category::where('name','مالتی مدیا')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item border-right dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" id="GameCategoryMenu"><i class="fab fa-playstation"></i>بازی</a>
                        <div class="category-dropdown dropdown-menu p-4" aria-labelledby="GameCategoryMenu">
                            <div class="row">
                                <div class="col-md-5 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-chess-queen"></i>بازی کامپیوتر</div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','بازی کامپیوتر')->first()->categories->chunk(10) as $categories)
                                        <div class="w-33">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fab fa-linux"></i>بازی سایر سیستم ها</div>
                                    @foreach(\App\Models\Category::where('name','بازی سایر سیستم عامل ها')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fab fa-playstation"></i>بازی کنسول</div>
                                    @foreach(\App\Models\Category::where('name','بازی کنسول')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item border-right dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" id="MediaCategoryMenu"><i class="fas fa-photo-video"></i>مالتی مدیا</a>
                        <div class="category-dropdown dropdown-menu p-4" aria-labelledby="MediaCategoryMenu">
                            <div class="row">
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-music"></i>صوتی</div>
                                    @foreach(\App\Models\Category::where('name','صوتی')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-2 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-film"></i>تصویری</div>
                                    @foreach(\App\Models\Category::where('name','تصویری')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-graduation-cap"></i>آموزشی</div>
                                    @foreach(\App\Models\Category::where('name','آموزش')->first()->categories as $category)
                                    <div><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                    @endforeach
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="categories-title"><i class="fas fa-brush"></i>گرافیک</div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','گرافیک')->first()->categories as $category)
                                        <div class="ml-4"><a href="/home?category={{$category->name}}">{{$category->name}}</a></div>
                                        @endforeach
                                    </div>

                                    <div class="categories-title"><i class="fas fa-pen-square"></i>ابزار فتوشاپ</div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','ابزار فتوشاپ')->first()->categories->chunk(3) as $categories)
                                        <div class="d-flex flex-column">
                                            @foreach($categories as $category)
                                            <div class="mr-3">
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="categories-title"><i class="fas fa-ruler-combined"></i>ابزار طراحی</div>
                                    <div class="d-flex">
                                        @foreach(\App\Models\Category::where('name','ابزار طراحی')->first()->categories->chunk(5) as $categories)
                                        <div class="d-flex flex-column">
                                            @foreach($categories as $category)
                                            <div>
                                                <a href="/home?category={{$category->name}}">{{$category->name}}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            {{-- categories dropdown-menu --}}
        </nav>

    </div>
</header>