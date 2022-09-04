<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:مشاهده کامنت ها')->only(['index','unapproved']);
        $this->middleware('can:ویرایش کامنت')->only(['edit', 'update']);
        $this->middleware('can:حذف کامنت')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه کامنت ها');
        $comments = Comment::query();
        if ($keyword = request('search'))
            $comments->where('approved','!=',0)->where('comment','LIKE',"%{$keyword}%")->orWhere('id',"{$keyword}");
        else
            $comments->where('approved','!=',0);
        $comments = $comments->orderBy('id','DESC')->paginate(20);
        return view('admin.comments.all',compact('comments'));
    }

    public function unapproved()
    {
        $this->seo()->setTitle('صفحه کامنت ها');
        $comments = Comment::query();
        if ($keyword = request('search'))
            $comments->where('approved',0)->where('comment','LIKE',"%{$keyword}%")->orWhere('id',"{$keyword}");
        else
            $comments->where('approved',0);
        $comments = $comments->orderBy('id','DESC')->paginate(20);
        return view('admin.comments.all',compact('comments'));
    }

    public function store(Request $request,Post $post,User $user){
        $data = $request->validate([
            'post'=>'required|exists:posts,id',
            'comment'=>'required|string',
            'parent_id'=>'nullable|exists:comments,id',
        ]);

        $data['parent_id'] = isset($data['parent_id']) && !is_null($data['parent_id']) ? $data['parent_id']  : 0;
        $user = User::findOrFail($user->id);
        $post->comments()->create(array_merge($data,['user_id'=>$user->id]));
        alert()->success('کامنت با موفقیت ثبت شد.');
        return redirect(route('singlePost',$post->id).'#comments-bookmark');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        $this->seo()->setTitle('صفحه ویرایش کامنت');
        return view('admin.comments.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    public function update(Request $request,Comment $comment)
    {
        $validData = $request->validate([
            'comment'=>'required'
        ]);

        $comment->update($validData);
        alert()->success('کامنت با موفقیت ویرایش شد.');
        return back();
    }

    public function approved(Request $request,Comment $comment)
    {
        $comment->update(['approved'=>1]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        alert()->success('کامنت با موفقیت حذف شد.');
        return back();
    }
}
