<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:مشاهده دسته بندی ها')->only(['index']);
        $this->middleware('can:ایجاد دسته بندی')->only(['create','store']);
        $this->middleware('can:ویرایش دسته بندی')->only(['edit', 'update']);
        $this->middleware('can:حذف دسته بندی')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه دسته بندی ها');
        $categories = Category::query();
        if ($keyword = request('search'))
            $categories->where('name','LIKE',"%{$keyword}%")->orWhere('id',"{$keyword}");

        $categories = $categories->orderBy('id','DESC')->paginate(20);
        return view('admin.categories.all',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->seo()->setTitle('صفحه ایجاد دسته بندی جدید');
        return view('admin.categories.create');
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
            'name'=>'required|string|min:2|unique:categories',
            'parent-cat'=>'nullable|exists:categories,id',
            'children-cats'=>'array|exists:categories,id'
        ]);

        $category = Category::create([
            'name'=>$validData['name'],
            'parent_id'=> $validData['parent-cat'] ?? 0,
        ]);

        if(!empty($validData['children-cats'])){
            collect($validData['children-cats'])->each(function($cat_id) use ($category){
                Category::find($cat_id)->update(['parent_id'=>$category->id]);
            });
        }

        alert()->success('دسته بندی با موفقیت ایجاد شد.');
        return redirect(route('admin.categories.create'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        $this->seo()->setTitle('صفحه ویرایش دسته بندی');
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function update(Request $request, Category $category)
    {
        $validData = $request->validate([
            'name'=>['required','string','min:2',Rule::unique('categories')->ignore($category->id)],
            'parent-cat'=>'nullable|exists:categories,id',
            'children-cats'=>'array|exists:categories,id'
        ]);

        $category->update([
            'name'=>$validData['name'],
            'parent_id'=> $validData['parent-cat'] ?? 0,
        ]);

        //delete old children
        $category->categories()->each(function($cat){
            $cat->update(['parent_id'=>0]);
        });

        //add new children
        if(!empty($validData['children-cats'])){
            collect($validData['children-cats'])->each(function($cat_id) use ($category){
                Category::find($cat_id)->update(['parent_id'=>$category->id]);
            });
        }

        alert()->success('دسته بندی با موفقیت ویرایش شد.');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        alert()->success('دسته بندی با موفقیت حذف شد.');
        return redirect(route('admin.categories.index'));
    }
}
