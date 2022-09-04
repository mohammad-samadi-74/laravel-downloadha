<div class="comment d-flex flex-column" commentWriter="{{$comment->user->name}}">
    <p class="title"><b>{{$comment->user->name}}</b> - <span> {{$comment->created_at}}</span></p>
    <div class="content border-bottom shadow-sm">
        <p>{{$comment->comment}}</p>
    </div>
    @if($comment->comments)
        @foreach($comment->comments as $comment)
            <div class="p-4 reply-comment">
                @include('layouts.components.info_comment')
            </div>
        @endforeach
    @endif
</div>
