<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Providers\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{

    public function show(){
        //seo
        $this->seo()->setTitle('سبد خرید');
        return view('cart');
    }

    public function addToCart(Product $product){
        if (! Cart::has($product)){
            Cart::put([
                'id'=>$product->id,
                'quantity'=> 1,
                'price'=>$product->price
            ],$product);
        }
        return redirect()->back();
    }

    public function changeQuantity(Request $request , Product $product){

        $quantity = $request->validate([
            'quantity'=>['required',Rule::in(range(1,$product->inventory))]
        ]);

        if (Cart::has($product)){
           Cart::update($product,$quantity);
           return response(['status'=>'success']);
        }

        return response(['status'=>'error'],404);
    }

    public function delete(Product $product){
        if (Cart::has($product)){
            Cart::delete($product);
        }
        return back();
    }

    public function empty(){
        Cart::empty();
        return back();
    }
}
