<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    //
    const CACHE_TIME = 900;
    public function index(Request $request)
    {
        $id = $request->id;
        Cache::tags(['tags1', 'tags2'])->put('user_name', 'dat_do', 20);
        Cache::tags(['tags1', 'tags3'])->put('age', '20', 20);
        $product = cache()->remember("product_$id", self::CACHE_TIME, function () use ($id) {
            return Products::find($id);
        });
        return $product;
    }
    public function forgetCache(Request $request)
    {
        $id = $request->id;
        return Cache::forget("product_$id");
    }
}
