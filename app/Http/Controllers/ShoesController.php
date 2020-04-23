<?php

namespace App\Http\Controllers;

use App\Type;
use App\Size_product;
use App\Product;
use App\Producer;
use App\slide;
use App\Posts;
use App\Review;

use App\User;
use Illuminate\Support\Facades\Session;
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
        $type = Type::first();
        $type1 = Type::where('id', '>', 1)->get();
        $products = Product::all();
        $size_product = Size_product::all();
        $product1 = Product::take(3)->get();
        $product2 = Product::where('id', '>', 4)->get();
        $producers = Producer::all();
        $slides = slide::first();
        $slides1 = slide::where('id', '>', 1)->get();


        return view('shoes.home', compact('types', 'size_product', 'type', 'type1', 'slides1', 'product1', 'product2', 'products', 'producers', 'slides'));
    }

    public function cart(Request $request)
    {
        if (Auth::user()) {

            // $product = Product::all();
            $size_product = Size_product::all();

            $product = null;
            $amount_product = null;
            foreach (Cart::instance(Auth::user()->id)->content() as $cart) {
                $product[] = Product::find($cart->id);
                $check_amount = Product::find($cart->id);
                $amount_product[] = Size_product::where('id_size', $cart->options->size)->where('id_product', $cart->id)->sum('qty');

                //Check if in cart of customer, product out of stock
                if ($check_amount->amount <= 0) {
                    Cart::remove($cart->rowId);
                    $request->session()->flash('error', "Product $check_amount->name has sold out, sincerely sorry!");
                }
            }

            $types = Type::all();
            return view('shoes.cart', compact('types', 'product', 'size_product', 'amount_product'));
        } else {
            return view('shoes.login');
        }
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
        $size_product = Size_product::all();

        $types = Type::all();
        return view('shoes.shop', compact('types', 'size_product', 'products'));
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
        $review = Review::all();
        $types = Type::all();
        $product1 = Product::take(3)->get();
        $product2 = Product::where('id', '>', 4)->get();
        return view('shoes.product-detail', compact('id_product', 'review', 'types', 'products', 'product1', 'product2'));
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
    public function getDetailProduct($id)
    {
        $productKey = 'product_' . $id;

        // // Kiểm tra Session của sản phẩm có tồn tại hay không.
        // // Nếu không tồn tại, sẽ tự động tăng trường view_count lên 1 đồng thời tạo session lưu trữ key sản phẩm.
        if (!Session::has($productKey)) {
            Product::where('id', $id)->increment('view_count');
            Session::put($productKey, 1);
        }

        $product = Product::find($id);
        $id_product = Product::find($id);
        $related_product = Product::where('id_type', $product->id_type)->where('amount', '<>', 0)->where('id', '<>', $product->id)->inRandomOrder()->paginate(8);
        $id_type = Type::find($id);
        return view('shoes.detail_product', compact('product',  'related_products', 'id_product'));
    }
}