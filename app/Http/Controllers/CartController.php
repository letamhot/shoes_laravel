<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Customer;
use App\Bills;
use App\Bill_detail;
use App\Size;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = null;

        foreach (Cart::content() as $cart) {
            $product[] = Product::find($cart->id);
            $check_amount = Product::find($cart->id);

            //Check if in cart of customer, product out of stock
            if ($check_amount->amount <= 0) {
                Cart::remove($cart->rowId);
                $request->session()->flash('error', "Product $check_amount->name has sold out, sincerely sorry!");
            }
        }

        //Request coupon code in function coupon()
        if ($request->session()->has('coupon')) {
            $coupon = Session('coupon');
        } else {
            $coupon = null;
        }

        if (Auth::user()) {
            return view('shoes.cart', compact("product", "coupon"));
        } else {
            return view('shoes.checkout', compact("product", "coupon"));
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
            'payment' => "required",
            "size.*" => "required | numeric | min:0"
        ]);
        $oderdetail = array();

        if (request('qty') > request('check_availability')) {
            return redirect()->back()->with('error', 'The quantity of products you entered is incorrect');
        } else {
            if (Auth::user()) {
                $check_customer = Customers::where('username', Auth::user()->username)->first();

                // Check if user current have made a previous purchase
                if ($check_customer == true) {
                    $id_customer = $check_customer->id;
                } else {
                    $customer = new Customer();
                    $customer->username = Auth::user()->username;
                    $customer->name = Auth::user()->name;
                    $customer->email = Auth::user()->email;
                    $customer->address = Auth::user()->address;
                    $customer->phone = Auth::user()->phone;
                    $customer->save();
                }

                $data = $request->all();
                if ($check_customer == true) {
                    $data["id_customer"] = $id_customer;
                } else {
                    $data["id_customer"] = $customer->id;
                }
                $data["date_order"] = date('Y-m-d H:i:s');
                $data["total"] = Cart::total();
                $data["payment"] = $request->payment;
                $bills = Bills::create($data);
                $id_order = $bills->id;
                $bill_detail = [];

                $i = 0;
                foreach (Cart::content() as $key => $cart) {
                    $bill_detail["id_bill"] = $id_order;
                    $bill_detail["id_product"] = $cart->id;
                    $bill_detail["name_product"] = $cart->name;
                    $bill_detail["size"] = request("size" . $i++);
                    $bill_detail["quantity"] = $cart->qty;
                    $bill_detail["Price_input"] = $cart->price;

                    if (!empty(request('code'))) {
                        $bill_detail["discount"] = number_format(100 - ($cart->total * 100 / ($cart->price * $cart->qty)), 0);
                    }

                    $bill_detail["total_price"] = $cart->total;
                    $oderdetail[$key] = Bill_detail::create($bill_detail);

                    $product = Product::findOrFail($cart->id);
                    $product->amount -= $cart->qty;
                    $product->save();
                }

                if (!empty(request('code'))) {
                    $coupon = Coupons::where('id_coupon', request('code'))->first();
                    if ($coupon == true) {
                        $coupon->used = 1;
                        $coupon->user_used = Auth::user()->username;
                        $coupon->save();
                    }
                }

                // if ($check_customer == true) {
                //     Mail::to($check_customer->email)->send(new ShoppingMail($bills, $oderdetail));
                // } else {
                //     Mail::to($customer->email)->send(new ShoppingMail($bills, $oderdetail));
                // }
                Cart::destroy();
                return redirect()->route('shoesHome')->with('toast', 'You have successfully placed an order! We will send a mail to confirm your order today');
            } else { }
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
        if ($request->ajax()) {
            if ($request->qty == 0) {
                return response()->json(['error' => 'Số lượng tối thiểu là 1 sản phẩm'], 200);
            } else {
                Cart::update($id, $request->qty);
                return response()->json(['result' => 'Đã cập số lượng sản phẩm thành công']);
            }
        }
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
        Cart::destroy();
        return back()->with('success', "Cart $cart->name delete!");
    }
    public function addCart($id, Request $request)
    {
        $qty = null;
        $product = Product::findOrFail($id);

        if ($request->qty > $request->check_stock) {
            return redirect()->back()->with('error', "You enter an amount that exceeds the allowed limit!");
        }

        // if ($request->qty > $request->check_quantity) {
        //     return redirect()->back()->with('error', "This item is sold out, we will import this product soon!");
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

        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $price,
            'weight' => 0,
            'taxRate' => 0,
            'options' => [
                'img' => $product->image,
                'size' => $size,
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
    public function checkout()
    {
        $user = Auth::user();
        $price = str_replace(',', '', Cart::total());
        return view('shoes.checkout', compact('user', 'price'));
    }
}