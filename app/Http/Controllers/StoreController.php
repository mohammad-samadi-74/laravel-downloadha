<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        //seo
        $this->seo()->setTitle('فروشگاه');

        $games = Product::query();
        $softs = Product::query();
        $games = $games->where('name','LIKE','%بازی%')->orWhere('name','LIKE','%game%')->paginate(16);
        $softs = $softs->where('name','LIKE','%نرم افزار%')->orWhere('name','LIKE','%soft%')->paginate(16);
        return view('store',compact(['games','softs']));
    }

    public function singleProduct(Product $product){
        //seo
        $this->seo()->setTitle('فروشگاه');
        $product->update(['views',++$product->views]);
        return view('StoreSingleProduct',compact('product'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function likeProduct(Request $request){
        $productId = $request->get('productId') ?? null;

        $product = Product::find((int)$productId);
        if($product){
            $product->update([
                'likes' => ++$product->likes
            ]);
        }

        return response()->json($product);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function dislikeProduct(Request $request){
        $productId = $request->get('productId') ?? null;

        $product = Product::find((int)$productId);
        if($product){
            $product->update([
                'dislikes' => ++$product->dislikes
            ]);
        }

        return response()->json($product);
    }

}
