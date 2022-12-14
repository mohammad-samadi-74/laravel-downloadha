<div class="bg-light" id="posts">
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
                           href="#">{{$post->title}}</a>
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
                <div class="rate"><span>{{$rate}}/5</span><span class="mx-1">({{$post->likes}} <i>???????????? </i>)</span></div>
            </div>
        </div>
        <!-- views -->

        <!-- wallpaper -->
        <div class="post-wallpaper row">
            <div class="mx-auto">
                <img src="/{{$post->wallpaper}}" class="img-fluid" alt="wallpaper">
            </div>
        </div>
        <!-- wallpaper -->

        <!-- first_content -->
        <div class="first-content">
            <p>{!! $post->first_content !!}</p>
        </div>
        <!-- first_content -->

    @if($post->second_content)
        <!-- second_content -->
            <div class="first-content">
                <p>{!! $post->second_content !!}</p>
            </div>
            <!-- second_content -->
    @endif

    @if($post->third_content)
        <!-- third_content -->
            <div class="first-content">
                <p>{!! $post->third_content !!}</p>
            </div>
            <!-- third_content -->
    @endif


    <!-- gallery -->
        <div class="row px-4 justify-content-center">
            @foreach($post->images as $image)
                <img src="/{{$image->image}}" class="ml-2 mb-2" height="105" alt="wallpaper">
            @endforeach
        </div>
        <!-- gallery -->

    @if($post->info)
        <!-- info -->
            <div class="d-flex flex-column post-info shadow-md  rounded mb-4">
                <h5 class=" title text-white rounded-top"><i class="mx-2 fas fa-info-circle"></i>info</h5>
                <div class="content px-3 py-2">{!! $post->info !!}</div>
            </div>
            <!-- info -->
    @endif

    @if($post->system_l || $post->system_b)
        <!-- system -->
            <div class="d-flex flex-column post-system shadow-md  rounded mb-4">
                <h5 class=" title text-white rounded-top px-4"><i class="fas fa-desktop mx-2"></i>?????????? ???????? ????????</h5>
                <div class="content px-3 py-2">
                    @if($post->system_l)
                        <h6>?????????? ?????????? ???????? ????????:</h6>
                        <div>{!! $post->system_l !!}</div>
                    @endif
                    @if($post->system_b)
                        <h6>?????????? ????????????????:</h6>
                        <div>{!! $post->system_b !!}</div>
                    @endif
                </div>
            </div>
            <!-- system -->
    @endif

    @if($post->files_setup)
        <!-- system -->
            <div class="d-flex flex-column post-files-setup shadow-md  rounded mb-4">
                <h5 class=" title text-white rounded-top px-4"><i class="fas fa-question-circle mx-2"></i>?????????????? ?????? :
                </h5>
                <div class="content px-3 py-2">
                    {!! $post->files_setup !!}
                </div>
            </div>
            <!-- system -->
    @endif

    @if($post->files_info)
        <!-- system -->
            <div class="d-flex flex-column post-files-info shadow-md  rounded mb-4">
                <h5 class=" title text-white rounded-top px-4"><i class="fas fa-info-circle mx-2"></i>?????????????? ???????? :
                </h5>
                <div class="content rounded-bottom post-files-info-content">
                    {!! $post->files_info !!}
                </div>
            </div>
            <!-- system -->
    @endif

        <!-- password -->
        <div class="d-flex flex-column post-password shadow-md  rounded mb-4">
            <h5 class="title text-white rounded px-4 m-0"><i class="fas fa-lock mx-2"></i>?????? ????????: www.downloadha.com
            </h5>
        </div>
        <!-- password -->

        <!-- operator -->
        <div class="d-flex flex-column operator shadow-md  rounded mb-4">
            <h5 class="title text-white rounded px-4 m-0"><i class="fas fa-phone-alt mx-2"></i>???????? ???????????????? ??????????
                ????????????</h5>
            <div class="content panel-body px-3 py-2">
                <p style="text-align:justify">???? ??????????&zwnj;???? ?????????? ???????????? ???? ?????? ????????????&zwnj;???? ???? ?????????? ??????????????????
                    ?????????? ???????????? ?????????? ??????????&zwnj;???????? ?????????????? ?????????????? ?????? ????&zwnj;????????. ???????? ???? ???????? ???????? ???????? ?? ????????
                    ???? ???? ?????????? <span style="color:#ff0000"><strong>9099070345</strong></span></p>
                <p style="text-align:justify">???? ??????????&zwnj;???? ???? ???? ?????????? ?????????????????? ???? ???? ???????????? ???????? ?????????????? ???? <a
                        href="http://hamrahpc.ir/" rel="nofollow sponsored noopener" target="_blank">???????????? ??????????
                        ????????????</a> ???????????? ????????.</p>
            </div>
        </div>
        <!-- operator -->

    @if($post->download)
        <!-- download -->
            <div class="d-flex flex-column post-download shadow-md  rounded mb-3">
                <h5 class=" title text-white rounded-top px-4"><i class="fas fa-download mx-2"></i>???????? ?????? ???????????? :
                </h5>
                <div class="content px-3 py-2">
                    {!! $post->download !!}
                </div>
                <div class="buttons d-flex justify-content-center bg-light py-3">
                    <a class="btn shadow-sm text-white" href="#">???????? ?????? ??????????</a>
                    <a class="btn shadow-sm text-white" href="#">?????????????? ????????????</a>
                    <a class="btn shadow-sm text-white" href="#">?????????? ??????????</a>
                    <a class="btn shadow-sm text-white" href="#">?????????? ???????? ????????</a>
                </div>
            </div>
            <!-- download -->
        @endif


        <div class="post-more d-flex justify-content-between">
            <div class="more-info d-flex">
                <div class="created_time"><i class="fas fa-clock"></i>{{$post->created_at}}</div>
                <div class="writer"><span>???????? </span><a class="writer-name"
                                                         href="?writer={{$post->user->name}}">{{$post->user->name}}</a>
                </div>
                <div class="views"><i class="fas fa-eye"></i>{{$post->views}} ????????????</div>
                <div class="comments"><i class="fas fa-comments"></i>0 ??????</div>
            </div>
        </div>
        <hr>
        <div class="post-tags text-black-50">
            <p><i class="fas fa-tags"></i> ?????????? ???? :</p>
            <div>
                @if($post->tags)
                    @foreach(explode(',',$post->tags) as $tag)
                        <a class="text-decoration-none text-title-blue" href="{{route('home')}}?tags={{$tag}}">{{$tag}}</a>,
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>

<!-- comments -->
<div class="bg-white shadow-md mt-4 p-3" id="comments">
    <div id="create-comment" class="mb-4">
        <h5>?????????? ?????? ????????</h5>

        @auth
            <form action="{{route('admin.store.comment',['post'=>$post->id,'user'=>auth()->user()->id])}}" method="post">
                @csrf

                <input type="hidden" name="post" value="{{$post->id}}">

                @error('comment')
                    <div class="alert alert-danger shadow-sm border-0">{{ $message }}</div>
                @enderror

                <input type="hidden" name="parent_id" value="0">

                <div class="form-group">
                    <label for="comment">?????? ??????</label>
                    <textarea class="float form-control mt-4" name="comment" id="comment" cols="30" rows="3"></textarea>
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="name">?????? ??????</lfloat abel>--}}
{{--                    <input class="float form-control" type="text" name="name" id="name">--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="email">?????????? ??????</label>--}}
{{--                    <input class="float form-control mt-4" type="text" name="email" id="email">--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="website">???? ????????</label>--}}
{{--                    <input class="float form-control mt-4" type="text" name="website" id="website">--}}
{{--                </div>--}}

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-lg px-3 py-2 ml-4 shadow-sm my-3">?????????? ??????</button>
                </div>

            </form>
        @endauth

        @guest
            <div class="alert alert-warning ">???????? ???????? ?????? ?????????? ?????????? ???????? ???????? ????????.
                &nbsp
                <span><a href="{{route('login')}}">????????</a></span> |
                <span><a href="{{route('register')}}">?????? ??????</a></span>
            </div>
        @endguest
    </div>

    <!-- show comments -->
    <div class="show-comments">
        <a id="comments-bookmark"></a>
        <h5 class="border-bottom">???????????? ??????????????</h5>
        @if($post->comments()->count())
            @foreach($comments = $post->comments()->where('parent_id',0)->paginate(10) as $comment)
                @include('layouts.components.comment')
            @endforeach

                <div class="my-4">
                    {{$comments->render()}}
                </div>
        @else
            <div class="alert alert-info ">???????????? ???????? ?????? ?????? ?????? ???????? ??????.</div>
        @endif

    </div>
    <!-- show comments -->
</div>
<!-- comments -->
