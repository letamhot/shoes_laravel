<?php

namespace App\Http\Controllers;

use App\Type;
use App\Product;
use App\Producer;
use App\slide;

use Illuminate\Http\Request;


class ShoesController extends Controller
{
    public function home(Request $request)
    {
        $types = Type::all();
        $products = Product::all();
        $product1 = Product::take(3)->get();
        $product2 = Product::where('id', '>', 4)->get();
        $producers = Producer::all();
        $slides = slide::first();
        $slides1 = slide::where('id', '>', 1)->get();



        return view('shoes.home', compact('types', 'slides1', 'product1', 'product2', 'products', 'producers', 'slides'));
    }

    public function cart()
    {
        return view('shoes.cart');
    }
    public function blogsingle()
    {
        return view('shoes.blog-single');
    }
    public function shop()
    {
        return view('shoes.shop');
    }
    public function blog()
    {
        return view('shoes.blog');
    }
    public function checkout()
    {
        return view('shoes.checkout');
    }
    public function productdetail()
    {
        return view('shoes.product-detail');
    }
    public function contact()
    {
        return view('shoes.contact-us');
    }
    public function error()
    {
        return view('shoes.404');
    }
}