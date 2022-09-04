<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostGallery;
use App\Models\PostIcon;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:مشاهده پست ها')->only('index');
        $this->middleware('can:ایجاد پست')->only(['create','store']);
        $this->middleware('can:ویرایش پست')->only(['edit','update']);
        $this->middleware('can:حذف پست')->only('destroy');
        $this->middleware('can:مشاهده کامنت ها')->only('commentsInfo');
    }

    public function adminPanel()
    {
        $this->seo()->setTitle('پنل ادمین');
        return view('admin.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه پست ها');
        $posts = Post::query();
        if ($keyword = request('search'))
            $posts->where('title','like',"%{$keyword}%")->orWhere('id',"{$keyword}");

        $posts = $posts->orderBy('id','DESC')->paginate(20);
        return view('admin.posts.all',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->seo()->setTitle('صفحه ایجاد پست جدید');
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'title'=>'required|min:6|string',
            'type'=>'required|string',Rule::in(['نرم افزار','بازی','مالتی مدیا','موبایل']),
            'first_content'=>'required|min:10',
            'second_content'=>'nullable|min:10',
            'third_content'=>'nullable|min:10',
            'info'=>'nullable|min:10',
            'system_l'=>'nullable|min:10',
            'system_b'=>'nullable|min:10',
            'files_setup'=>'nullable|min:10',
            'files_info'=>'nullable|min:10',
            'download'=>'nullable|min:10',
            'tags'=>'nullable|min:5',
            'wallpaper'=>'required|mimes:jpg,gif,png,bmp|max:10240',
            'images.*'=>'nullable|mimes:jpg,gif,png,bmp|max:10240',
            'categories'=>'required|array|exists:categories,id',
            'icon'=>'nullable|mimes:jpg,gif,png,bmp|max:5120',
            'caption'=>'nullable|string|min:3',
            'content'=>'nullable|string|min:3',
        ]);

        //create post
        $post = auth()->user()->posts()->create($validData);

        //add wallpaper
            $this->add_image($post, $request,'wallpaper',$validData);

        //add icon
        if(isset($validData['icon'])){
            $this->add_image($post, $request,'icon',$validData);
        }

        //add gallery images
        if(isset($validData['images']) && !empty($validData['images'])){
            $this->add_gallery($validData, $post, $request);
        }

        //add categories
        if(isset($validData['categories']) && !empty($validData['categories']))
            $post->categories()->sync($validData['categories']);

        alert()->success('پست با موفقیت ایجاد شد.');
        return redirect(route('admin.posts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $this->seo()->setTitle('صفحه ویرایش پست');
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        $validData = $request->validate([
            'title'=>'required|min:6|string',
            'type'=>'required|string',Rule::in(['نرم افزار','بازی','مالتی مدیا','موبایل']),
            'first_content'=>'required|min:10',
            'categories'=>'required|array|exists:categories,id',
            'second_content'=>'nullable|min:10',
            'third_content'=>'nullable|min:10',
            'info'=>'nullable|min:10',
            'system_l'=>'nullable|min:10',
            'system_b'=>'nullable|min:10',
            'files_setup'=>'nullable|min:10',
            'files_info'=>'nullable|min:10',
            'download'=>'nullable|min:10',
            'tags'=>'nullable|min:5',
            'caption'=>'nullable|string|min:3',
            'content'=>'nullable|string|min:3',
        ]);

        if($request->file('wallpaper')){
            $wallpaper = $request->validate(['wallpaper'=>'required|mimes:jpg,gif,png,bmp|max:10240']);
            //delete old wallpaper
            if($post->wallpaper){
                if(file_exists(public_path($post->wallpaper))){
                    File::delete(public_path($post->wallpaper));
                }
                //add new wallpaper
                $this->add_image($post, $request,'wallpaper',$wallpaper);
            }
        }

        if($request->file('icon')){
            $icon = $request->validate(['icon'=>'nullable|mimes:jpg,gif,png,bmp|max:5120']);
            $icon = array_merge($icon,$validData);
            //delete old icon
            if(file_exists(public_path($post->icon->icon))){
                File::delete(public_path($post->icon->icon));
            }
            //add new icon
            $this->add_image($post, $request,'icon',$icon);
        }

        if($request->file('images') && !empty($request->file('images'))){
            $images = $request->validate(['images.*'=>'nullable|mimes:jpg,gif,png,bmp|max:10240',]);
            //delete old images
            $post->images->each(function ($image){

                File::delete(public_path($image->image));
            });
            $post->images()->delete();
            //add new images
            $this->add_gallery($images, $post, $request);
        }

        $post->update($validData);

        //update categories
        $post->categories()->sync($validData['categories']);

        alert()->success('پست با موفقیت ایجاد شد.');
        return redirect(route('admin.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        //delete folder
            File::deleteDirectory(public_path("images/posts/post-{$post->id}"));
        $post->delete();
        alert()->success('پست با موفقیت حذف شد.');
        return redirect(route('admin.posts.index'));
    }

    /**
     * @param Post $post
     * @return Application|Factory|View
     */
    public function info(Post $post)
    {
        $this->seo()->setTitle('صفحه اطلاعات پست');
        return view('admin.posts.info',compact('post'));
    }

    /**
     * @param Post $post
     * @return Application|Factory|View
     */
    public function commentsInfo(Post $post)
    {
        $this->seo()->setTitle('صفحه کامنت های پست');
        $comments = $post->comments()->where('parent_id',0)->paginate(20);
        return view('admin.posts.comments',compact(['comments','post']));
    }

    /**
     * @param $post
     * @param Request $request
     * @param $filedName
     * @param $data
     * @return void
     */
    protected function add_image($post, Request $request,$filedName,$data)
    {
        $picture_path = "images/posts/post-{$post->id}/$filedName/";
        $picture_name = $request->file($filedName)->getClientOriginalName();
        $data[$filedName] = $picture_path.$picture_name;

        if ($filedName === 'wallpaper'){
            $post->update([ $filedName => $picture_path.$picture_name]);
        }elseif($filedName === 'icon'){
            $post->icon()->delete();
            $post->icon()->save(new PostIcon($data));
        }
        $request->file($filedName)->move(public_path($picture_path), $picture_name);
    }

    /**
     * @param $images
     * @param $post
     * @param Request $request
     */
    protected function add_gallery($images, $post, Request $request): void
    {
        collect($images['images'])->each(function ($image) use ($post, $request) {
            $image_path = "images/posts/post-{$post->id}/gallery/";
            $image_name = $image->getClientOriginalName();
            $image->move(public_path($image_path), $image_name);
            $post->images()->save(new PostGallery(['image' => $image_path . $image_name]));
        });
    }


}
