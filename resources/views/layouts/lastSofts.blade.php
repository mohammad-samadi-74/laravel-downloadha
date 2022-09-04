<section>
    <div id="last-softs">
        <div class="d-flex flex-column">
            <div class="top-navigation d-flex rtl">
                <div category="نرم افزار های ویژه" class="item active d-flex flex-column px-3 py-2 font-14"><i class="my-2 font-24 w-100 fas fa-desktop mx-1"></i>نرم افزارهای ویژه</div>
                <div category="موبایل" class="item d-flex flex-column px-3 py-2 font-14"><i class="my-2 font-20 w-100 fas fa-mobile-alt mx-1"></i>موبایل</div>
                <div category="فیلم و سریال" class="item d-flex flex-column px-3 py-2 font-14"><i class="my-2 font-20 w-100 fas fa-file-video mx-1"></i>فیلم وسریال</div>
                <div category="بازی" class="item d-flex flex-column px-3 py-2 font-14"><i class="my-2 font-20 w-100 fas fa-gamepad mx-1"></i>بازی</div>
                <div category="کاربردی" class="item d-flex flex-column px-3 py-2 font-14"><i class="my-2 font-20 w-100 fas fa-tools mx-1"></i>کاربردی</div>
            </div>
            <div class="d-flex flex-column bg-white shadow-md mb-4 py-3 px-2 last-softs-list">
                @php $posts = \App\Models\Post::where('type','نرم افزار')->orderBy('id','DESC')->take(16)->get() @endphp
                @if(!empty($posts))
                    @foreach($posts as $post)
                        <div class="last-softs-item"><a class="nav-link" href="{{route('singlePost',$post->id)}}"><i class="fas fa-chevron-left mx-2"></i>{{$post->title}}</a></div>
                    @endforeach
                @else
                    <div class="last-softs-item"><a class="nav-link" >پستی با این دسته بندی یافت نشد.</a></div>
                @endif
            </div>
        </div>
    </div>
</section>
