<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    
    
    public function index()
    {
        $address_payment = DB::table('address_payment')->where('uid',session()->get('id'))->first();
        $carts = session()->get('cart') ? session()->get('cart') : null;
        return view('client.cart', [
            'carts' => $carts,
            'address_payment' => $address_payment
        ]);
    }

    
    public function showProductPurchased()
    {
        $uid = session()->get('id');

        $data = Cart::where('user_id', $uid)->with('detailProducts')->get();
        $arr = [];
        foreach ($data as $item) {
            foreach ($item->detailProducts as $product) {
                array_push($arr,$product);
            }
        }
        // dd($arr[0]['product_info']);
        return view('client.purchased', [
            'data' => $arr
        ]);
        
    }
}
