<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(8);
        $carts = session()->get('cart');
        return view('client.index',[
            'products' => $products,
            'carts' => $carts
        ]);
    }
    
    public function detailProduct($id)
    {
        $product = Product::where('id',$id)->first();
        $latestProduct = Product::latest()->take(4)->get();
        return view('client.product', [
            'idProduct' => $id,
            'product' => $product,
            'latest_product' => $latestProduct
        ]);
    }
}
