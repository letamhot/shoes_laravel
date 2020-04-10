<?php

namespace App\Http\Controllers;

use App\Type;
use App\Product;
use App\Producer;
use App\slide;
use App\Posts;
use App\User;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;


use Illuminate\Http\Request;


class ShoesController extends Controller
{
    // public function __construct()
    // {
    //     Auth::user();
    // }
    public function home(Request $request)
    {
        // Cart::destroy();
        // dd(Cart::content());
        $types = Type::all();
        $type = slide::first();
        $type1 = slide::where('id', '>', 1)->get();
        $products = Product::all();
        $product1 = Product::take(3)->get();
        $product2 = Product::where('id', '>', 4)->get();
        $producers = Producer::all();
        $slides = slide::first();
        $slides1 = slide::where('id', '>', 1)->get();


        return view('shoes.home', compact('types', 'type', 'type1', 'slides1', 'product1', 'product2', 'products', 'producers', 'slides'));
    }

    public function cart()
    {
        $products = Product::all();
        $types = Type::all();
        return view('shoes.cart', compact('types', 'products'));
    }
    public function blogsingle()
    {
        $products = Product::all();
        $types = Type::all();
        $posts = Posts::all();
        return view('shoes.blog-single', compact('types', 'products', 'posts'));
    }
    public function shop()

    {
        $products = Product::all();
        $types = Type::all();
        return view('shoes.shop', compact('types', 'products'));
    }
    public function blog()
    {
        $posts = Posts::all();
        $products = Product::all();
        $types = Type::all();
        return view('shoes.blog', compact('types', 'products', 'posts'));
    }
    public function checkout()
    {
        $products = Product::all();
        $types = Type::all();
        return view('shoes.checkout', compact('types', 'products'));
    }
    public function productdetail($id)
    {
        $id_product = Product::findOrfail($id);
        $products = Product::all();
        $types = Type::all();
        $product1 = Product::first();
        $product2 = Product::where('id', '>', 1)->get();
        return view('shoes.product-detail', compact('id_product', 'types', 'products', 'product1', 'product2'));
    }
    public function contact()
    {
        $products = Product::all();
        $types = Type::all();
        return view('shoes.contact-us', compact('types', 'products'));
    }
    public function error()
    {
        $products = Product::all();
        $types = Type::all();
        return view('shoes.404', compact('types', 'products'));
    }
}