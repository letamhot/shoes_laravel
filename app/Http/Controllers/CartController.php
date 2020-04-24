<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Type;
// use App\Cart;
use Illuminate\Support\Facades\Session;
use App\Size_product;
use App\Customer;
use App\Bills;
use App\Bill_detail;
use App\Size;

class CartController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware( 'auth' );
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'payment' => 'required',
            'size.*' => 'required | numeric | min:0'
        ]);
        if(!empty(Auth::user()->phone) || !empty(Auth::user()->address)){
            return redirect()->route('details.profile')->with('error', '
            Please enter phone number or address');
        }
            $i = 0;
        foreach (Cart::content() as $check_amount) {
            $id_product = Product::findOrFail($check_amount->id);
            if (request('qty') > request("check_availability")) {
                return back()->with('error', 'Nhập sai');
            }
            $i++;
        }
        $bool = true;
        foreach (Cart::instance(Auth::user()->id)->content() as $cart) {
            $size_product = Size_product::where('id_size', $cart->options->size)->where('id_product', $cart->id)->first();
            if ($cart->qty > $size_product->qty) {
                Cart::instance(Auth::user()->id)->update($cart->rowId, $size_product->qty);
                $bool = false;
            }
        }
        if ($bool == false) {
            return back()->with('error', 'Out of stock can not order');
        }

        $oderdetail = array();

        if (request('qty') > request('check_availability')) {
            return redirect()->back()->with('error', 'The quantity of products you entered is incorrect');
        } else {
            if (Auth::user()) {
                $check_customer = Customer::where('email', Auth::user()->email)->first();

                // Check if user current have made a previous purchase
                if ($check_customer == true) {
                    $id_customer = $check_customer->id;
                } else {
                    $customer = new Customer();
                    $customer->name = Auth::user()->name;
                    $customer->gender_id = Auth::user()->gender;
                    $customer->email = Auth::user()->email;
                    $customer->address = Auth::user()->address;
                    $customer->phone = Auth::user()->phone;
                    $customer->save();
                }

                $data = $request->all();
                if ($check_customer == true) {
                    $data['id_customer'] = $id_customer;
                } else {
                    $data['id_customer'] = $customer->id;
                }
                $data['date_order'] = date('Y-m-d H:i:s');
                $data['total'] = Cart::instance(Auth::user()->id)->total();
                $data['payment'] = $request->payment;
                $bills = Bills::create($data);
                $id_order = $bills->id;
                $bill_detail = [];

                $i = 0;
                foreach (Cart::instance(Auth::user()->id)->content() as $key => $cart) {
                    $bill_detail['id_bill'] = $id_order;
                    $bill_detail['id_product'] = $cart->id;
                    $bill_detail['name_product'] = $cart->name;
                    $bill_detail['size'] = $cart->options->namesize;
                    $bill_detail['quantity'] = $cart->qty;
                    $bill_detail['unit_price'] = $cart->price;
                    $bill_detail['total_price'] = $cart->total;
                    $oderdetail[$key] = Bill_detail::create($bill_detail);

                    $product = Size_product::where('id_size', $cart->options->size)->where('id_product', $cart->id)->first();
                    $product->qty -= $cart->qty;
                    $product->save();
                    $i++;
                }
                Cart::instance(Auth::user()->id)->destroy();
                return redirect()->route('shoesHome')->with('success', 'Order Success');
            } else {
                return redirect()->route('loginshoes');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $amount = Cart::instance(Auth::user()->id)->get($id)->id;
        if ($request->ajax()) {
            if (request('qty') <= 0) {
                return response()->json(['error' => 'Minimum quantity is 1']);
            }
            $product = Product::find($amount);
            // $products = Product::findOrfail($amount);
            if (request('qty') > $product->size_product->qty) {
                return response()->json(['error' => "Quantity of <b>$product->name</b> is less than"]);
            }
            Cart::instance(Auth::user()->id)->update($id, request('qty'));
            return response()->json(['result' => 'Update quantity success']);
        }
    }

    public function saveListItemCart(Request $request, $id, $qty)
    {
        $id_cart = Cart::instance(Auth::user()->id)->get($id);
        $id_product = Product::findOrFail($id_cart->id);
        $size_product = Size_product::where('id_size', $id_cart->options->size)->where('id_product', $id_product->id)->first();
        $total = 0;
        $bool = true;
        foreach (Cart::instance(Auth::user()->id)->content() as $item) {
            if ($item->options->size == $size_product->id_size) {
                $total += $item->qty;
            }
        }
        if ($qty > $id_cart->qty) {
            $total += ($qty - $id_cart->qty);
        } else {
            $total += ($qty - $id_cart->qty);
        }

        if ($total > $size_product->qty) {
            $bool = false;
        }

        if ($request->ajax()) {
            if (($qty > $size_product->qty) || $bool == false) {
                return response()->json([
                    'status' => 'Wrong',
                    'msg' => 'Error'
                ]);
            }
        }
        Cart::instance(Auth::user()->id)->update($id, $qty);

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
        return view('shoes.cartajax', compact('types', 'product', 'size_product', 'amount_product'));
        // return view('shoes.cartajax', compact('product', 'size_product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $cart = Cart::find($id);
        Cart::instance(Auth::user()->id)->destroy();
        return back()->with('success', "Cart $cart->name delete!");
    }

    public function addCart($id, Request $request)
    {
        if (Auth::user()) {
            // if (empty(request('size_name'))) {
            //     return back()->with('error', "Please select size !");
            // }
            // $qty = null;
            $product = Product::findOrFail($id);
            // $bool = true;
            // $total = 0;
            // foreach (Cart::instance(Auth::user()->id)->content() as $item) {
            //     if ($item->id == $product->id) {
            //         $total += $item->qty;
            //         if (($total) >= $product->amount) {
            //             $bool = false;
            //         }
            //     }
            // }

            // if ($request->ajax()) {
            //     if ($bool == false) {
            //         return response()->json([
            //             'status' => 'error',
            //             'msg' => 'Error'
            //         ]);
            //     }
            // }

            // if (request('qty') > request('check_stock')) {
            //     return redirect()->back()->with('error', 'You enter an amount that exceeds the allowed limit!');
            // }

            // if ($request->qty > request('check_quantity')) {
            //     return redirect()->back()->with('error', 'This item is sold out, we will import this product soon!');
            // }

            // if (request('check_stock') < 1) {
            //     return back();
            // }

            if ($request->qty) {
                $qty = $request->qty;
            } else {
                $qty = 1;
            }
            if ($request->size) {
                $size = $request->size;
            } else {
                $size = 1;
            }

            if ($product->promotion_price > 0) {
                $price = $product->promotion_price;
            } else {
                $price = $product->price_input;
            }

            Cart::instance(Auth::user()->id)->add([
                'id' => $id,
                'name' => $product->name,
                'qty' => $qty,
                'price' => $price,
                'weight' => 0,
                'taxRate' => 0,
                'options' => [
                    'img' => $product->image,
                    'size' => $request->input('size'),
                ]
            ]);
            return view('shoes.partials.header_ajax');
        } else {
            return view('shoes.login');
        }
    }
    public function addCartPost($id, $qty, $check, $size, Request $request)
    {
        if (Auth::user()) {
            // if (empty($size)) {
            //     return back()->with('error', "Please select size !");
            // }

            if ($request->ajax()) {
                if ($size == 'abc') {
                    return response()->json([
                        'status' => 'errorsize',
                        'msg' => 'Error'
                    ]);
                }
            }
            $product = Product::findOrFail($id);
            $bool = true;
            $total = $qty;
            $qty_size_check = Size_product::where('id_size', $size)->where('id_product', $id)->first();
            // dd($qty_size_check);

            // 1 1 10

            foreach (Cart::instance(Auth::user()->id)->content() as $item) {
                if ($item->options->size == $qty_size_check->id_size) {
                    $total += $item->qty;
                    if ($total > $qty_size_check->qty) {
                        $bool = false;
                    }
                }
            }
            if ($request->ajax()) {
                if ($total > $qty_size_check->qty || $bool == false || $total < 1) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'Error'
                    ]);
                }
            }

            // if ($total > $qty_size_check->qty || $bool == false || $total < 1) {
            //     return back()->with('error', "The number you have entered exceeds the number allowed !");
            // }

            if ($product->promotion_price > 0) {
                $price = $product->promotion_price;
            } else {
                $price = $product->price_input;
            }
            Cart::instance(Auth::user()->id)->add([
                'id' => $id,
                'name' => $product->name,
                'qty' => $total,
                'price' => $price,
                'weight' => 0,
                'taxRate' => 0,
                'options' => [
                    'img' => $product->image,
                    'size' => $size, //id size checkout
                    'namesize' => $qty_size_check->size->name, //display


                ]
            ]);
            // dd(request('size_name'));

            // dd(Cart::instance(Auth::user()->id)->content());
            return view('shoes.partials.header_ajax');
        } else {
            return view('shoes.login');
        }
    }

    public function deleteCart($id)
    {
        Cart::instance(Auth::user()->id)->remove($id);
        return view('shoes.cart');
    }
    public function deleteListCart($id, Request $request)
    {
        Cart::instance(Auth::user()->id)->remove($id);
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
        return view('shoes.cartajax', compact('product', 'size_product', 'types', 'amount_product'));
    }

    public function updatedeleteCart(Request $request)
    {
        $product = null;
        $size_product = null;
        foreach (Cart::instance(Auth::user()->id)->content() as $cart) {
            $check = $product[] = Product::find($cart->id);
            $size_product[] = Size_product::where('id_size', $cart->options->size)->where('id_product', $check->id)->first();
        }
        return view('shoes.cartajax', compact('product', 'size_product'));
    }

    public function checkout(Request $request)
    {
        $this->validate($request, [
            'payment' => 'required',
            'size.*' => 'required | numeric | between:1,4',
            'name' => 'required | string | min:5 | max: 255',
            'gender' => 'required',
            'email' => 'required | email | min:5 | max: 255',
            'city' => 'required | string | min:5 | max: 255',
            'postcode' => 'required | numeric | min:0',
            'address' => 'required | string | min:5 | max: 255',
            'phone' => 'required | numeric | min:0',
        ]);

        $oderdetail = array();

        if (request('qty') > request('check_availability')) {
            return redirect()->back()->with('error', 'The quantity of products you entered is incorrect');
        } else {
            if (!(Auth::user())) {
                $customer = new Customer();
                $customer->name = $request->name;
                $customer->gender_id = $request->gender;
                $customer->email = $request->email;
                $customer->city = $request->city;
                $customer->postcode = $request->postcode;
                $customer->address = $request->address;
                $customer->phone = $request->phone;
                $customer->save();

                $data = $request->all();
                $data['id_customer'] = $customer->id;
                $data['date_order'] = date('Y-m-d H:i:s');
                $data['total'] = Cart::instance(Auth::user()->id)->total();
                $data['payment'] = $request->payment;
                $bills = Bills::create($data);

                $id_order = $bills->id;
                $bill_detail = [];

                $i = 0;
                foreach (Cart::instance(Auth::user()->id)->content() as $key => $cart) {
                    $bill_detail['id_bill'] = $id_order;
                    $bill_detail['id_product'] = $cart->id;
                    $bill_detail['name_product'] = $cart->name;
                    $bill_detail['size'] = $cart->options->namesize;
                    $bill_detail['quantity'] = $cart->qty;
                    $bill_detail['unit_price'] = $cart->price;
                    $bill_detail['total_price'] = $cart->total;
                    $oderdetail[$key] = Bill_detail::create($bill_detail);
                    // dd($cart->options->namesize);

                    $product = Size_product::where('id_size', $cart->options->size)->where('id_product', $cart->id)->first();
                    $product->qty -= $cart->qty;
                    $product->save();
                }
                Cart::instance(Auth::user()->id)->destroy();
                return redirect()->route('checkout')->with('success', 'Order Success');
            } else { }
        }
    }
}