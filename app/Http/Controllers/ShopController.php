<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('create_at','DESC')->paginate(12);
        return view('shop',compact('products'));
    }

    public function product_details($product_slug)
    {
        $product = Product::where('slug',$product_slug)->first();
        return view('details', compact('product'));
    }

}
