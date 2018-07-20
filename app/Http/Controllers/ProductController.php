<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function get()
    {
        $products = Product::where('productID','fdksjnfdofsn87dsnsd')->paginate(10);

        return self::respond(['products' => $products], HttpCode::OK);
    }
}
