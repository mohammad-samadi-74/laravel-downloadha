<section>
    <div id="soft-slider">
        <div class="container">
            <div class="d-flex flex-column">
                <div class="top-navigation d-flex rtl">
                    <div category="نرم افزار" class="item active d-flex flex-column px-3 py-2 font-14"><i class="my-2 font-24 w-100 fas fa-desktop mx-1"></i>نرم افزار</div>
                    <div category="نرم افزار اندروید" class="item d-flex flex-column px-3 py-2 font-14"><i class="my-2 font-24 w-100 fas fa-mobile-alt mx-1"></i>نرم افزار کاربردی موبایل</div>
                    <div category="نرم افزار آنتی ویروس" class="item d-flex flex-column px-3 py-2 font-14"><i class="my-2 font-24 w-100 fas fa-shield-alt mx-1"></i>آنتی ویروس</div>
                </div>
                <div class="soft-slider bg-white px-2 shadow-md">
                    @foreach(\App\Models\Post::where('type','نرم افزار')->orderBy('views')->take(16)->get() as $post)
                        <div class="soft-slider-item">
                            <a href="{{route('singlePost',$post->id)}}" class="d-flex flex-column py-2 text-decoration-none mt-4">
                                <div class="d-flex justify-content-center">
                                    @if(isset($post->icon->icon))
                                        <img class="mb-3" src="{{asset($post->icon->icon)}}" width="75" height="75" alt="picture">
                                    @else
                                        <img class="mb-3" src="{{asset('images/software-icon-30-300x300.png')}}" width="75" height="75" alt="picture">
                                    @endif
                                </div>

                                @if(isset($post->icon->caption))
                                    <h4 class="soft-slider-item-title text-center">
                                        {{$post->icon->caption}}
                                    </h4>
                                @endif

                                @if(isset($post->icon->content))
                                    <h6 class="soft-slider-item-description text-center">
                                        {{$post->icon->content}}
                                    </h6>
                                @endif

                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
