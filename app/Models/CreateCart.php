<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateCart extends Model
{
    use HasFactory;
    public $products = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($cart = new Collection())
    {
        if ($cart) {
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
        }
    }
    
    
    public function createItemCart($product, $id)
    {
        
        $newProduct = [
            'quantity' => 0,
            'price' => $product->price,
            'product_info' => $product
        ];
        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quantity']++;
        $newProduct['price'] = $newProduct['quantity'] * $product->price;
        $this->products[$id] = $newProduct;
        $this->totalPrice += $product->price;
        $this->totalQuantity++;
    }

    public function deleteItemCart($idProduct)
    {
        $this->totalQuantity -= $this->products[$idProduct]['quantity'];
        $this->totalPrice -= $this->products[$idProduct]['price'];
        unset($this->products[$idProduct]);
    }

    public function updateCart($idProduct, $action)
    {
        if ($this->products) {
            $getProduct = $this->products[$idProduct];
            if ($action == 'up') {
                $getProduct['quantity']++;
                $getProduct['price'] = $getProduct['quantity'] * $getProduct['product_info']->price;
                $this->products[$idProduct] = $getProduct;
                $this->totalQuantity++;
                $this->totalPrice += $getProduct['product_info']['price'];
                // dd($getProduct);
            } else {
                if ($getProduct['quantity'] > 1) {
                    $getProduct['quantity']--;
                    $getProduct['price'] = $getProduct['quantity'] * $getProduct['product_info']->price;
                    $this->products[$idProduct] = $getProduct;
                    $this->totalQuantity--;
                    $this->totalPrice -= $getProduct['product_info']['price'];
                }
            }
        }
    }

    public function insertCartToDB($order_code)
    {
        $totalPrice = $this->totalPrice;
        $cart = Cart::create([
            'order_code' => $order_code,
            'user_id' => session()->get('id')
        ]);
        foreach ($this->products as $item) {
            DetailCart::create([
                'product_id' => $item['product_info']->id,
                'quantity' => $item['quantity'],
                'total' => $item['price'],
                'cartId' => $cart->id
            ]);
        }
    }
}
