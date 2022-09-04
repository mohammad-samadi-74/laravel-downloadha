<div class="comment d-flex flex-column" commentWriter="{{$comment->user->name}}" comment_id="{{$comment->id}}">
    <p class="title"><b>{{$comment->user->name}}</b> - <span> {{$comment->created_at}}</span></p>
    <div class="content border-bottom shadow-sm">
        <p>{{$comment->comment}}</p>
        <div class="reply"><i class="fas fa-reply"></i><a href="#" comment-replied="{{$comment->id}}" class="reply-this-comment"> پاسخ </a><i class="fas fa-pen-alt"></i></div>
    </div>
    @if($comment->comments)
        @foreach($comment->comments as $comment)
            <div class="py-0 px-4 reply-comment">
                @include('layouts.components.comment')
            </div>
        @endforeach
    @endif
</div>
