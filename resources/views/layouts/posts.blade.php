<div id="posts">
    @if(!$posts->count())
        @if(request('category'))
            <div class=" alert alert-warning text-center text-bold py-4">پستی با این دسته بندی یافت نشد.</div>
        @elseif(request('search'))
            <div class=" alert alert-warning text-center text-bold py-4">حاصلی برای این جستجو یافت نشد.</div>
        @elseif(request('tags'))
            <div class=" alert alert-warning text-center text-bold py-4">پستی با این تگ یافت نشد.</div>
        @endif
    @else
        @foreach($posts as $post)

        <!-- title and dir -->
            <div class="post bg-white p-4 shadow-md">
                <div class="row">
                    <div class="col-md-2">
                        <div class="d-flex justify-content-center">
                        <span class="post-logo-container rounded-circle border border-light shadow-sm p-4">
                            <i class="{{get_post_icon($post->type)}} font-50"></i>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="d-flex flex-column">
                            <div class="border-bottom very-light-border py-2">
                                <a class="post-title font-weight-bold text-decoration-none text-title-blue"
                                   href="{{route('singlePost',$post->id)}}">{{$post->title}}</a>
                            </div>
                        </div>
                        <div class="post-dir">
                            <i class="fa text-warning fa-folder-open mr-2"></i>
                            <span class="font-14 text-title-blue">
                            <a href="?type={{$post->type}}">{{$post->type}}</a>
                            @php
                                $post->categories()->first() ?
                                $post->categories()->orderBy('parent_id')->take(3)->get()->each(function($cat){
                                    echo '<span class="text-dark">/</span><a href="?category='.$cat->name.'">'.$cat->name.'</a>';
                                }) : ''
                            @endphp
                        </span>
                        </div>
                    </div>
                </div>
                <!-- title and dir -->

                <!-- views -->
                <div class="post-views d-flex justify-content-end post-views-{{$post->id}} mb-5">
                    <div class="send-rate">
                        <a href="#" class="likePost" postId="{{$post->id}}"><i class="far fa-thumbs-up"></i></a>
                        <a href="#" class="dislikePost" postId="{{$post->id}}"><i class="far fa-thumbs-down"></i></a>
                    </div>
                    <div class="d-flex ">
                        @php
                            $rate = $post->likes+$post->dislikes !== 0 ? floor($post->likes/($post->dislikes + $post->likes)*5) : 0 ;
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
                        <div class="rate"><span>{{$rate}}/5</span><span class="mx-1">({{$post->likes}} <i>امتیاز </i>)</span></div>
                    </div>
                </div>
                <!-- views -->

                <!-- first_content -->
                <div class="first-content ltr">
                    <p>{!! $post->first_content !!}</p>
                </div>
                <!-- first_content -->

                <!-- wallpaper -->
                <div class="post-wallpaper row">
                    <div class="mx-auto">
                        <img src="/{{$post->wallpaper}}" class="img-fluid" alt="wallpaper">
                    </div>
                </div>
                <!-- wallpaper -->

                <div class="post-more d-flex justify-content-between">
                    <div class="more-info d-flex">
                        <div class="created_time"><i class="fas fa-clock"></i>{{$post->created_at}}</div>
                        <div class="writer"><span>توسط </span><a class="writer-name" href="?writer={{$post->user->name}}">{{$post->user->name}}</a></div>
                        <div class="views"><i class="fas fa-eye"></i>{{$post->views}} بازدید</div>
                        <div class="comments"><i class="fas fa-comments"></i>0 نظر</div>
                    </div>
                    <a href="{{route('singlePost',$post->id)}}" class="post-more-button btn btn-sm">ادامه مطلب</a>
                </div>
                <hr>
                <div class="post-tags text-black-50">
                    <p><i class="fas fa-tags"></i> برچسب ها :</p>
                    <div>
                        @if($post->tags)
                            @foreach(explode(',',$post->tags) as $tag)
                                <a class="text-decoration-none text-title-blue" href="?tags={{$tag}}">{{$tag}}</a>,
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
            <br>
        @endforeach

        <div class="p-4">
            {{$posts->appends(['category'=>request('category') , 'search'=>request('search') , 'tags'=>request('tags')])->links("pagination::bootstrap-4")}}
        </div>
    @endif


</div>
