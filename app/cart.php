<?php

namespace App;

class Cart
{
    public $product = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($cart)
    {
        if ($cart) {
            $this->product = $cart->product;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
        }
    }
    public function AddCart($product, $id)
    {
        $newProduct = ['quantity' => 0, 'price' => $product->price_input, 'productInfo' => $product];
        if ($this->product) {
            if (array_key_exists($id, $product)) {
                $newProduct = $product;
            }
        }
        $newProduct['quantity']++;
        $newProduct['price'] = $newProduct['quantity'] * $product->price_input;
        $this->product[$id] = $newProduct;
        $this->totalPrice = $product->price_input;
        $this->totalQuantity++;
    }
}