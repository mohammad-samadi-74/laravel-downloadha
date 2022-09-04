<div class="bg-slider-dark my-5" id="media-slider">
    <div class="container">

        <div class="media-slider-title d-flex justify-content-center py-3">
            <a href="?category=تصویری" class="nav-link">
                <p class="text-white font-20">فیلم های منتخب
                    (<span class="text-success font-16"> فیلم های بیشتر... </span>)
                </p>
            </a>
        </div>

        <div class="media-slider">
            @php
                $slider_posts = \App\Models\Post::query();
                $id_array = \App\Models\Category::where('parent_id',\App\Models\Category::where('name','تصویری')->first()->id)->get()->map(function($cat){
                    return $cat->posts()->get()->pluck('id');
                })->collapse();
                $slider_posts = $slider_posts->whereIn('id',$id_array);
            @endphp
            @foreach($slider_posts->orderBy('id','DESC')->take(18)->get() as $post)
                <div>
                    <a href="{{route('singlePost',$post->id)}}">
                        <div class="slider-post-box position-relative">
                            <img src="/{{$post->wallpaper}}" class="img-fluid" alt="wallpaper">
                            <div class="post-description position-absolute px-2 d-flex flex-column">
                                <p class="title text-center font-18">E3-2021</p>
                                <p class="content text-right font-14 text-center">نمایشگاه سرگرمی های الکترونیکی
                                    2021</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

