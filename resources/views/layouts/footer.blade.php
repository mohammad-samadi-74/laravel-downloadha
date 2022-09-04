<footer class="footer" id="footer">

    <div id="footer-navigation">
        <nav class="container-fluid border-top border-bottom">
            <div class="nav nav-tabs container border-0" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-software-tab" data-toggle="tab" data-target="#nav-software"
                        type="button" role="tab" aria-controls="nav-software" aria-selected="true">نرم افزار
                </button>
                <button class="nav-link" id="nav-mobile-tab" data-toggle="tab" data-target="#nav-mobile" type="button"
                        role="tab" aria-controls="nav-mobile" aria-selected="false">موبایل
                </button>
                <button class="nav-link" id="nav-game-tab" data-toggle="tab" data-target="#nav-game" type="button"
                        role="tab" aria-controls="nav-game" aria-selected="false">بازی
                </button>
                <button class="nav-link" id="nav-media-tab" data-toggle="tab" data-target="#nav-media" type="button"
                        role="tab" aria-controls="nav-media" aria-selected="false">مالتی مدیا
                </button>
            </div>
        </nav>
        <div class="tab-content container" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-software" role="tabpanel" aria-labelledby="nav-software-tab">
                <ul>
                    <li><a href="{{route('home')}}?category=سیستم عامل ویندوز">سیستم عامل ویندوز</a></li>
                    <li><a href="{{route('home')}}?category=نرم افزار مدیریت دانلود"> نرم افزار اینترنت</a></li>
                    <li><a href="{{route('home')}}?category=نرم افزار امنیتی">نرم افزار امنیتی</a></li>
                    <li><a href="{{route('home')}}?category=نرم افزار مالتی مدیا">نرم افزار مالتی مدیا</a></li>
                    <li><a href="{{route('home')}}?category=نرم افزار گرافیک">نرم افزار گرافیک</a></li>
                    <li><a href="{{route('home')}}?category=نرم افزار کاربردی">نرم افزار کاربردی</a></li>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-mobile" role="tabpanel" aria-labelledby="nav-mobile-tab">
                <ul>
                    <li><a href="{{route('home')}}?category=نرم افزار اندروید">نرم افزار اندروید</a></li>
                    <li><a href="{{route('home')}}?category=بازی اندروید">بازی اندروید</a></li>
                    <li><a href="{{route('home')}}?category=سایر سیستم عامل ها">سایر سیستم عامل ها</a></li>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-game" role="tabpanel" aria-labelledby="nav-game-tab">
                <ul>
                    <li><a href="{{route('home')}}?category=بازی کامپیوتر">بازی کامپیوتر</a></li>
                    <li><a href="{{route('home')}}?category=بازی سایر سیستم عامل ها">بازی سایر سیستم عامل ها</a></li>
                    <li><a href="{{route('home')}}?category=بازی کنسول">بازی کنسول</a></li>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-media" role="tabpanel" aria-labelledby="nav-media-tab">
                <ul>
                    <li><a href="{{route('home')}}?category=صوتی">صوتی</a></li>
                    <li><a href="{{route('home')}}?category=تصویری">تصویری</a></li>
                    <li><a href="{{route('home')}}?category=آموزشی">آموزشی</a></li>
                    <li><a href="{{route('home')}}?category=گرافیک">گرافیک</a></li>
                    <li><a href="{{route('home')}}?category=ابزار فتوشاپ">ابزار فتوشاپ</a></li>
                    <li><a href="{{route('home')}}?category=ابزار طراحی">ابزار طراحی</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="site-info" class="bg-white">
        <div class="row container mx-auto">
            <div class="col-3">
                <div class="info">
                    <h4><span>آمار سایت</span></h4>
                    <ul>
                        <li><i class="fas fa-pencil-alt"></i>تعداد مطالب: <span>{{\App\Models\Post::all()->count()}}</span>
                        </li>
                        <li><i class="fas fa-comments"></i>تعداد نظرات:<span>{{\App\Models\Comment::all()->count()}}</span>
                        </li>
                        <li><i class="fas fa-users"></i>افراد آنلاین:</li>
                        <li><i class="fas fa-street-view"></i>بازدید امروز:</li>
                        <li><i class="fas fa-street-view"></i>بازدید دیروز:</li>
                    </ul>
                </div>
                <div>
                    <h4><span>حمایت از دانلودها</span></h4>
                </div>
            </div>
            <div class="col-4">
                <div class="footerMenu">
                    <h4><span>منوی سایت</span></h4>
                    <div class="d-flex w-100">
                        <div class="w-50">
                            <div><a href="">خانه</a></div>
                            <div><a href="">تبلیغات</a></div>
                        </div>
                        <div class="w-50">
                            <div><a href="">انجمن</a></div>
                            <div><a href="">تماس با ما</a></div>
                        </div>
                    </div>
                </div>
                <div class="footerSocials d-flex flex-column">
                    <h4><span>شبکه های اجتماعی</span></h4>
                    <div class="d-flex justify-content-start">
                        <a class="facebook" href="https://www.facebook.com"><div><i class="fab fa-facebook-f"></i></div></a>
                        <a class="twitter" href="https://www.twitter.com"><div><i class="fab fa-twitter"></i></div></a>
                        <a class="instagram" href="https://www.instagram.com"><div><i class="fab fa-instagram"></i></div></a>
                        <a class="rss" href="http://feed.downloadha.com/downloadha-feed/"><div><i class="fas fa-rss"></i></div></a>
                        <a class="googlePlus" href="https://support.google.com/accounts"><div><i class="fab fa-google-plus-g"></i></div></a>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="news">
                    <h4><span>خبر نامه</span></h4>
                    <p>جهت دریافت آخرین مطالب سایت در ایمیل خود ، در خبرنامه عضو شوید.</p>
                    <form action="">
                        <div class="form-group">
                            <label for="news-email">ایمیل خود را وارد کنید.</label>
                            <input class="float w-100 py-3 px-2 ltr text-center" type="email" name="email" id="news-email">
                        </div>
                    </form>
                </div>
                <div class="contact-us">
                    <h4><span>تماس با ما</span></h4>
                    <p>جهت سفارش آگهی به صفحه <a href="{{route('tablighat')}}">تبلیغات</a> مراجعه نمایید.
                        برای طرح سوال یا رفع اشکال در مورد نرم افزارها از صفحه <a href="{{route('contact-us')}}">تماس با ما</a> اقدام کنید.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright container-fluid">
        <div class="container"><p class="no-space">تمامی حقوق مادی و معنوی متعلق به دانلودها میباشد.</p></div>
    </div>
</footer>
