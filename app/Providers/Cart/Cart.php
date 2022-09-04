<?php

namespace App\Providers\Cart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\Types\Collection;

/**
 * class Cart
 * @package App\Providers\Cart
 * @method static put(array $data,Model $obj = null)
 * @method static bool has(string|Collection $key)
 * @method static Collection|null get(string|Collection $key)
 * @method static Collection all()
 * @method static Collection delete(Model $product)
 * @method static Collection empty()
 */

class Cart extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
