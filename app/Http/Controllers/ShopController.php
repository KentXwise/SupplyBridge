<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        // Correct column name for sorting
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        return view('shop', compact('products'));
    }

    public function product_details($product_slug)
    {
        // Fetch the product details
        $product = Product::where('slug', $product_slug)->first();
        
        // Fetch related products
        $related_products = Product::where('slug', '<>', $product_slug)->take(8)->get();

        return view('details', compact('product', 'related_products'));
    }
}
