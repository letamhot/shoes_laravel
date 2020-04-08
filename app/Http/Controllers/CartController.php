<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Product;

class CartController extends Controller
{
    public function addCart($id, Request $request)
    {
        $qty = null;
        $product = Product::findOrFail($id);

        // if (request('qty') > request('check_stock')) {
        //     return redirect()->back()->with('toast_error', "You enter an amount that exceeds the allowed limit!");
        // }

        // if (request('quantity') > request('check_quantity')) {
        //     return redirect()->back()->with('toast_error', "This item is sold out, we will import this product soon!");
        // }

        if (request('qty')) {
            $qty = request('qty');
        } else {
            $qty = 1;
        }

        // if (request('size')) {
        //     $size = request('size');
        // } else {
        //     $size = 1;
        // }

        if ($product->promotion_price > 0) {
            $price = $product->promotion_price;
        } else {
            $price = $product->price_input;
        }

        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $price,
            'weight' => 0,
            'taxRate' => 0,
            'options' => [
                'img' => $product->image,
                'size' => 1,
            ]
        ]);
        return redirect()->back();
    }

    public function deleteCart($id)
    {
        $cart = Cart::get($id);
        Cart::remove($id);
        return redirect()->back();
    }
}