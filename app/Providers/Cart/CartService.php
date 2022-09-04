<?php

namespace App\Providers\Cart;


use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;

class CartService
{
    protected $cart;

    public function __construct()
    {
        $this->cart = session('cart') ?? collect([]);
    }

    public function put(array $data, $obj = null)
    {
        if (!is_null($obj) && $obj instanceof Model) {
            $data = array_merge($data, [
                'id' => Str::random(10),
                'subject_id' => $obj->id,
                'subject_type' => get_class($obj)
            ]);
        }

        $this->cart->put($data['id'], $data);
        session()->put('cart', $this->cart);

        return $this;
    }

    public function has($key)
    {
        return $key instanceof Model ? (! is_null($this->cart->where('subject_id',$key->id)->where('subject_type',get_class($key))->first()))
                                     : (! is_null($this->cart->firstWhere('id',$key)));
    }

    public function get($key,$relation=true){
        $item =  $key instanceof Model ? $this->cart->where('subject_id',$key->id)->where('subject_type',get_class($key))->first()
            : $this->cart->firstWhere('id',$key);

        return $relation ? $this->withRelationIfExists($item) : $item;
    }

    public function all($relation=true){
        $cart = $this->cart->map(function($item) use($relation){
            return $relation ? $this->withRelationIfExists($item) : $item;
        });
        return $cart;
    }

    protected function withRelationIfExists($item)
    {
        if(isset($item['subject_id']) && isset($item['subject_type'])){
            $subject = (new $item['subject_type'])->find($item['subject_id']);
            $item[strtolower(class_basename($subject))] = $subject;
            unset($item['subject_id']);
            unset($item['subject_type']);
            return $item;
        }
    }


    /**
     * @param Product $product
     * @param $quantity
     * @return $this
     */
    public function update(Product $product, $quantity)
    {
        $item = collect($this->get($product,false))->merge(['quantity'=>$quantity['quantity']]);
        $this->put($item->toArray());
        return $this;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function delete(Product $product)
    {
        $item = $this->get($product,false);
        $id = $item['id'];
        unset(($this->cart)[$id]);
        session()->forget("cart.$id");
        return $this;
    }

    /**
     * @return $this
     */
    public function empty()
    {
        if (!empty($this->cart)){
            $this->cart = collect([]);
            session()->forget('cart');
        }
        return $this;
    }


}
