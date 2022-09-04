<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @param Request $request
     * @param int $int
     * @return Application|Factory|View
     */
    public function index(Request $request,$int=10)
    {
            //seo
        $this->seo()->setTitle('مرجع دانلود برنامه ,بازی, فیلم و سریال');
        $posts = Post::query();

        if($category = $request['category']){
            if($category = Category::where('name',$request['category'])->first()){
                if($category->parent_id == 0){
                    $posts = Post::search_parent_category_posts($category->name);
                }else{
                    $id_array = $category->posts()->pluck('id');
                    $posts = $posts->whereIn('id',$id_array);
                }
            }else{
                $posts = $posts->orderBy('id','DESC')->paginate($int);
                return view('home',compact('posts'));
            }
        }

        if($request['search']){
            $posts->where('title','LIKE',"%{$request['search']}%")->orWhere('first_content','LIKE',"%{$request['search']}%")->orWhere('second_Content','LIKE',"%{$request['search']}%")->orWhere('third_content','LIKE',"%{$request['search']}%");
        }

        if($request['tags']){
            $posts->where('tags','LIKE',"%{$request['tags']}%");
        }

        $posts = $posts->orderBy('id','DESC')->paginate($int);
        return view('home',compact('posts'));
    }

    /**
     * @param Post $post
     * @return Application|Factory|View
     */
    public function singlePost(Post $post)
    {
        //seo
        $this->seo()->setTitle('مرجع دانلود برنامه , فیلم و سریال');
        $post->update(['views',++$post->views]);
        return view('singlePost',compact('post'));
    }

    /**
     * @param Request $request
     * @param int $int
     * @return JsonResponse
     */
    public function changeSoftSlider(Request $request,$int=16){
        $category = $request->get('category');
        $posts = [];
        switch ($category){
            case 'نرم افزار':
                $posts = Post::where('type','نرم افزار')->take($int)->get()->each(function($post){
                    $icon = $post->icon;
                    $post->icon = $icon;
                    return $post;
                });break;
            case 'نرم افزار اندروید':
                $posts = Post::search_parent_category_posts('نرم افزار اندروید')->orderBy('id','DESC')->take($int)->get()->each(function($post){
                    $icon = $post->icon;
                    $post->icon = $icon;
                    return $post;
                });break;
            case 'نرم افزار آنتی ویروس':
                $posts = Category::where('name','نرم افزار آنتی ویروس')->first()->posts()->orderBy('id','DESC')->take($int)->get()->each(function($post){
                    $icon = $post->icon;
                    $post->icon = $icon;
                    return $post;
                });break;
        }

        return response()->json(['posts'=>$posts]);
    }

    /**
     * @param Request $request
     * @param int $int
     * @return JsonResponse
     */
    public function changeLastSofts(Request $request,$int=16){
        $category = $request->get('category');
        switch ($category){
            case 'نرم افزار های ویژه':
                $posts = Post::where('type','نرم افزار')->orderBy('id','DESC')->take($int)->get();break;
            case 'موبایل':
                $posts = Post::where('type','موبایل')->orderBy('id','DESC')->take($int)->get();break;
            case 'فیلم و سریال':
                $posts = Post::search_parent_category_posts('تصویری')->orderBy('id','DESC')->take($int)->get();break;
            case 'بازی':
                $posts = Post::where('type','بازی')->take($int)->get();break;
            case 'کاربردی':
                $posts = Post::search_parent_category_posts('نرم افزار کاربردی')->orderBy('id','DESC')->take($int)->get();
        }

        return response()->json(['posts'=>$posts]);
    }

    public function likePost(Request $request){
        $postId = $request->get('postId') ?? null;

        $post = Post::find((int)$postId);
        if($post){
            $post->update([
                'likes' => ++$post->likes
            ]);
        }

        return response()->json($post);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function dislikePost(Request $request){
        $postId = $request->get('postId') ?? null;

        $post = Post::find((int)$postId);
        if($post){
            $post->update([
                'dislikes' => ++$post->dislikes
            ]);
        }

        return response()->json($post);
    }

    public function searchPostsByDate(Request $request){
        if (!$request['date'] || !in_array($request['date'],['day','month','year']))
            return \response()->json(['status'=>'error']);
        switch ($date = $request['date']){
            case 'day':{
                $posts = Post::orderBy('views')->get()->filter( function($post){return Carbon::make($post->created_at)->toDateString() == Carbon::now()->toDateString(); })->take(10);break;
            }
            case 'month':{
                $posts = Post::orderBy('views')->get()->filter( function($post){return Carbon::make($post->created_at)->format('m') == Carbon::now()->format('m'); })->take(10);break;
            }
            case 'year':{
                $posts = Post::orderBy('views')->get()->filter( function($post){return Carbon::make($post->created_at)->format('Y') == Carbon::now()->format('Y'); })->take(10);break;
            }
        }
        return \response()->json(['status'=>'success','posts'=>$posts->values()]);
    }

}
