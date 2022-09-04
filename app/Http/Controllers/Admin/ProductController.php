<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\PostGallery;
use App\Models\PostIcon;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:مشاهده محصولات')->only('index');
        $this->middleware('can:ایجاد محصول')->only(['create','store']);
        $this->middleware('can:ویرایش محصول')->only(['edit','update']);
        $this->middleware('can:حذف محصول')->only('destroy');
        //$this->middleware('can:مشاهده کامنت ها')->only('commentsInfo');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه محصولات');
        $products = Product::query();
        if ($keyword = request('search'))
            $products->where('name','LIKE',"%{$keyword}%")->orWhere('description','LIKE',"%{$keyword}%")->orWhere('id',"{$keyword}");

        $products = $products->orderBy('id','DESC')->paginate(20);
        return view('admin.products.all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->seo()->setTitle('صفحه ایجاد محصول جدید');
        return view('admin.products.create');
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
            'name' => 'required|min:3|string',
            'description' => 'min:10',
            'inventory' => 'integer',
            'price' => 'nullable|integer',
            'tags' => 'nullable|min:3',
            'wallpaper' => 'required|mimes:jpg,gif,png,bmp|max:10240',
            'images.*' => 'nullable|mimes:jpg,gif,png,bmp|max:10240',
            'categories' => 'required|array|exists:categories,id',
            'attributes' => 'array'
        ]);

        //create product

        $product = auth()->user()->products()->create($validData);

        //add wallpaper
        $this->add_image($product, $request, 'wallpaper', $validData);

        //add gallery images
        if (isset($validData['images']) && !empty($validData['images'])) {
            $this->add_gallery($validData, $product, $request);
        }

        //add categories
        if (isset($validData['categories']) && !empty($validData['categories']))
            $product->categories()->sync($validData['categories']);

        //attributes
        $this->attachAttributesOfProduct($validData['attributes'], $product);

        alert()->success('محصول با موفقیت ایجاد شد.');
        return redirect(route('admin.products.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $this->seo()->setTitle('صفحه ویرایش محصول');
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        $validData = $request->validate([
            'name' => 'required|min:3|string',
            'description' => 'min:10',
            'inventory' => 'integer',
            'price' => 'nullable|integer',
            'tags' => 'nullable|min:3',
            'categories' => 'required|array|exists:categories,id',
            'attributes' => 'required'
        ]);

        if ($request->file('wallpaper')) {
            $wallpaper = $request->validate(['wallpaper' => 'mimes:jpg,gif,png,bmp|max:10240']);
            //delete old wallpaper
            if ($product->wallpaper) {
                if (file_exists(public_path($product->wallpaper))) {
                    File::delete(public_path($product->wallpaper));
                }
                //add new wallpaper
                $this->add_image($product, $request, 'wallpaper', $wallpaper);
            }
        }

        if ($request->file('images') && !empty($request->file('images'))) {
            $images = $request->validate(['images.*' => 'nullable|mimes:jpg,gif,png,bmp|max:10240',]);
            //delete old images
            $product->images->each(function ($image) {

                File::delete(public_path($image->image));
            });
            $product->images()->delete();
            //add new images
            $this->add_gallery($images, $product, $request);
        }

        //attributes
        $product->attributes()->detach();
        $this->attachAttributesOfProduct($validData['attributes'], $product);

        $product->update($validData);

        //update categories
        $product->categories()->sync($validData['categories']);

        alert()->success('محصول با موفقیت ایجاد شد.');
        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //delete folder
        File::deleteDirectory(public_path("images/products/product-{$product->id}"));
        $product->delete();
        alert()->success('محصول با موفقیت حذف شد.');
        return redirect(route('admin.products.index'));
    }

    /**
     * @param Product $product
     * @return Application|Factory|View
     */
    public function info(Product $product)
    {
        return view('admin.products.info', compact('product'));
    }

    /**
     * @param $product
     * @param Request $request
     * @param $filedName
     * @param $data
     * @return void
     */
    protected function add_image($product, Request $request, $filedName, $data)
    {
        $picture_path = "images/products/product-{$product->id}/$filedName/";
        $picture_name = $request->file($filedName)->getClientOriginalName();
        $data[$filedName] = $picture_path . $picture_name;

        if ($filedName === 'wallpaper') {
            $product->update([$filedName => $picture_path . $picture_name]);
        } elseif ($filedName === 'icon') {
            $product->icon()->delete();
            $product->icon()->save(new PostIcon($data));
        }
        $request->file($filedName)->move(public_path($picture_path), $picture_name);
    }

    /**
     * @param $images
     * @param $product
     * @param Request $request
     */
    protected function add_gallery($images, $product, Request $request): void
    {
        collect($images['images'])->each(function ($image) use ($product, $request) {
            $image_path = "images/products/product-{$product->id}/gallery/";
            $image_name = $image->getClientOriginalName();
            $image->move(public_path($image_path), $image_name);
            $product->images()->save(new ProductGallery(['image' => $image_path . $image_name]));
        });
    }

    public function attribute_values(Request $request){
        $name = $request->validate(['name'=>'required']);
        if($attr = Attribute::where('name',$name)->first()){
            return response(['status'=>'success','attributes'=>$attr->values()->pluck('value')]);
        }
        return response(['status'=>'error']);
    }

    /**
     * @param $attributes1
     * @param Product $product
     */
    protected function attachAttributesOfProduct($attributes1, Product $product): void
    {
        $attributes = collect($attributes1);
        $attributes->each(function ($item) use ($product) {
            if (is_null($item['name']) || is_null($item['value'])) return;

            $attr = Attribute::firstOrCreate(['name' => $item['name']]);
            $attr_value = $attr->values()->firstOrCreate(['value' => $item['value']]);

            $product->attributes()->attach($attr->id, ['value_id' => $attr_value->id]);
        });
    }

}
