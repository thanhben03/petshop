<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Cart;
use App\Models\CreateCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiProductController extends Controller
{
    public function addProduct(Request $request)
    {

        $product = Product::where('id', $request->id)->first();
        // dd($product);
        if ($product != null) {
            $oldCart = session()->get('cart') ? session()->get('cart') : null;
            $newCart = new CreateCart($oldCart);
            $newCart->createItemCart($product, $request->id);
            session()->put('cart', $newCart);
        }
        return response([
            'msg' => 'Thêm sản phẩm thành công !',
            'status' => 'success'
        ]);
    }



    public function deleteProduct($idProduct)
    {
        $oldCart = session()->get('cart') ? session()->get('cart') : null;
        $newCart = new CreateCart($oldCart);
        $newCart->deleteItemCart($idProduct);
        if (Count($newCart->products) > 0) {
            session()->put('cart', $newCart);
        } else {
            session()->forget('cart');
        }

        return response([
            'msg' => 'Xóa sản phẩm thành công !',
            'status' => 'success'
        ]);
    }

    public function updateProduct($idProduct, $action)
    {
        $oldCart = session()->get('cart') ? session()->get('cart') : null;
        $newCart = new CreateCart($oldCart);
        $newCart->updateCart($idProduct, $action);
        session()->put('cart', $newCart);
        return response([
            'msg' => 'Thành công !',
            'status' => 'success'
        ]);
    }

    // public function confirmCart()
    // {
    //     if (!session()->get('confirm_address')) {
    //         return response([
    //             'msg' => 'Chưa có thông tin nhận hàng !',
    //             'status' => 'error'
    //         ]);
    //     }
    //     $oldCart = session()->get('cart') ? session()->get('cart') : null;
    //     $newCart = new CreateCart($oldCart);
    //     $newCart->insertCartToDB();
    //     session()->forget('cart');

    //     return response([
    //         'msg' => 'Đặt hàng thành công !',
    //         'status' => 'success'
    //     ]);
    // }
    public function wishProduct($idProduct)
    {
        if (Product::find($idProduct)) {
            DB::table('wishlists')->updateOrInsert(
                ['id' => $idProduct],
                [
                    'uid' => session()->get('id'),
                    'product_id' => $idProduct
                ]
            );
        }

        return response([
            'status' => 'success',
            'msg' => 'Thành công !'
        ]);
    }
}
