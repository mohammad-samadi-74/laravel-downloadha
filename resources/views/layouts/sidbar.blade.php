<div class="d-flex flex-column" id="sidebar">
    <!-- three-view-sidebar -->
    <div class="three-view-sidebar shadow-md rounded-bottom mb-4" id="best-date-posts">
        <div class="first-title bg-sidebar-blue text-white rounded-top">
            <div>پربازدید ترین ها</div>
        </div>
        <div class="second-title bg-sidebar-lightblue d-flex">
            <div class="flex-fill"><a href="#" date="day" class="text-white nav-link active">روز</a></div>
            <div class="flex-fill"><a href="#" date="month" class="text-white nav-link">ماه</a></div>
            <div class="flex-fill"><a href="#" date="year" class="text-white nav-link">سال</a></div>
        </div>
        <div class="content bg-white overflow-auto">
            @foreach(\App\Models\Post::orderBy('views')->get()->filter( function($post){return \Carbon\Carbon::make($post->created_at)->toDateString() == \Carbon\Carbon::now()->toDateString(); })->take(10) as $post)
                <div class="py-2 px-3 border-bottom"><a class="font-14" href="#"><i class="fa fa-chevron-left"></i>{{$post->title}}</a></div>
            @endforeach
        </div>
    </div>
    <!-- three-view-sidebar -->

    <!-- useful-sidebar -->
    <div class="useful shadow-md rounded-bottom mb-4">
        <div class="first-title bg-white text-dark border-bottom rounded-top">
            <div>تازه های گرافیک</div>
        </div>
        <div class="content bg-white overflow-auto">
            @php $graphic_posts = \App\Models\Post::search_parent_category_posts('نرم افزار گرافیک')->orderBy('id','DESC')->take(10)->get(); @endphp
            @if($graphic_posts->count())
                @foreach($graphic_posts as $post)
                    <div class="py-2 px-3 border-bottom"><a class="font-14" href="{{route('singlePost',$post->id)}}"><i class="fa fa-chevron-left"></i>{{$post->title}}</a></div>
                @endforeach
            @else
                <div class="py-2 px-3 border-bottom"><a class="font-14" >پستی با این دسته بندی یافت نشد.</a></div>
            @endif
        </div>
    </div>
    <!-- useful-sidebar -->

    <!-- graphic-sidebar -->
    <div class="graphic shadow-md rounded-bottom mb-4">
        <div class="first-title bg-white text-dark border-bottom rounded-top">
            <div>تازه های کاربردی</div>
        </div>
        <div class="content bg-white overflow-auto">
        @php $useful_posts = \App\Models\Post::search_parent_category_posts('نرم افزار کاربردی')->orderBy('id','DESC')->take(10)->get(); @endphp
        @if($useful_posts->count())
                @foreach($useful_posts as $post)
                    <div class="py-2 px-3 border-bottom"><a class="font-14" href="{{route('singlePost',$post->id)}}"><i class="fa fa-chevron-left"></i>{{$post->title}}</a></div>
                @endforeach
            @else
                <div class="py-2 px-3 border-bottom"><a class="font-14" >پستی با این دسته بندی یافت نشد.</a></div>
            @endif
        </div>
    </div>
    <!-- graphic-sidebar -->

    <!-- learning-sidebar -->
    <div class="learning shadow-md rounded-bottom mb-4">
        <div class="first-title bg-white text-dark border-bottom rounded-top">
            <div>تازه هی آموزشی</div>
        </div>
        <div class="content bg-white overflow-auto">
            @php $learning_posts = \App\Models\Post::search_parent_category_posts('آموزشی')->orderBy('id','DESC')->take(10)->get(); @endphp
            @if($learning_posts->count())
                @foreach($learning_posts as $post)
                    <div class="py-2 px-3 border-bottom"><a class="font-14" href="{{route('singlePost',$post->id)}}"><i class="fa fa-chevron-left"></i>{{$post->title}}</a></div>
                @endforeach
            @else
                <div class="py-2 px-3 border-bottom"><a class="font-14" >پستی با این دسته بندی یافت نشد.</a></div>
            @endif
        </div>
    </div>
    <!-- learning-sidebar -->

    <!-- security-sidebar -->
    <div class="security shadow-md rounded-bottom mb-4">
        <div class="first-title bg-white text-dark border-bottom rounded-top">
            <div>تازه های امنیتی</div>
        </div>
        <div class="content bg-white overflow-auto">
            @php $security_posts = \App\Models\Post::search_parent_category_posts('نرم افزار امنیتی')->orderBy('id','DESC')->take(10)->get(); @endphp
            @if($security_posts->count())
                @foreach($security_posts as $post)
                    <div class="py-2 px-3 border-bottom"><a class="font-14" href="{{route('singlePost',$post->id)}}"><i class="fa fa-chevron-left"></i>{{$post->title}}</a></div>
                @endforeach
            @else
                <div class="py-2 px-3 border-bottom"><a class="font-14" >پستی با این دسته بندی یافت نشد.</a></div>
            @endif
        </div>
    </div>
    <!-- security-sidebar -->

</div>
