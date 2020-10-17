<?php

namespace App\Http\Controllers;

use App\Producer;
use App\Product;
use App\Size;
use App\Size_product;
use App\Type;
use http\Env\Response;
use Illuminate\Http\Request;

// use Session;
//
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware( 'role:ROLE_ADMIN' );
        $this->middleware( 'role:ROLE_SUPERADMIN' );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $type = Type::all();
        $producer = Producer::all();
        $size = Size::all();
        return view('admin.product.create', compact('type', 'producer', 'size'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | min:3 | string',
            'type' => 'required',
            'producer' => 'required',
            'image' => 'image | mimes:png,jpg,jpeg',
            'price_input' => 'required | numeric | min:0 | max:300000000',
            'promotion_price' => 'required | numeric | max:300000000',
            'description' => 'required | string',

        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->id_type = $request->type;
        $product->id_producer = $request->producer;

        $product->amount = $request->amount;
        if (request('image')) {
            $product->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }
            $product->price_input = $request->price_input;
        if ($request->promotion_price >= 0 && $request->promotion_price <  $product->price_input) {
                $product->promotion_price = $request->promotion_price;
            }
            else{
                return back()->with('error', 'Do not enter a negative number');
            }
        $product->new = $request->new;
        $product->description = $request->description;
        $product->save();
        if (request('size')) {
            $product->size()->attach(request('size'));
        }

        return redirect()->route('product.index')->with('success', 'Product Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $product = Product::withTrashed()->find($id);
        // return view( 'admin.product.show', compact( 'product' ) );

        return response()->json(['data' => $product, 'name' => 'Khôi'], 200);
        // 200 là mã lỗi
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $product = Product::withTrashed()->find($id);
        $type = Type::all();
        $producer = Producer::all();
        $sizes = Size::all();

        return view('admin.product.edit', compact('product', 'type', 'producer', 'sizes'));
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
        $request->validate([
            'name' => 'required | min:3 | string',
            'type' => 'required',
            'producer' => 'required',
            'image' => 'image | mimes:png,jpg,jpeg',
            'price_input' => 'required | numeric | min:0 | max:300000000',
            'promotion_price' => 'required | numeric | max:300000000',
            'description' => 'required | string',

        ]);
        $product = Product::withTrashed()->findOrfail($id);
        $product->name = $request->name;
        $product->id_type = $request->type;
        $product->id_producer = $request->producer;

        $product->amount = $request->amount;
        if (request('image')) {
            $product->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        $product->price_input = $request->price_input;

        if ( $request->promotion_price >= 0 && $request->promotion_price <  $product->price_input) {
            $product->promotion_price = $request->promotion_price;
        }else{
            return back()->with('error', '
            Do not enter a negative number');
        }
        $product->new = $request->new;

        $product->description = $request->description;

        $product->save();
        $product->size()->sync(request('size'));

        return redirect()->route('product.index')->with('success', 'Product Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with('success', "Product $product->name delete!");
    }

    public function trashed(Request $request)
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.product.trash', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return back()->with('success', "Product $product->name restored!");
    }

    public function restoreAll()
    {
        $product = Product::onlyTrashed()->get();
        if (count($product) == 0) {
            return back()->with('success', 'Clean trash, nothing to restore!');
        } else {
            Product::onlyTrashed()->restore();
            return back()->with('success', 'All data restored!');
        }
    }

    public function delete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();

        return back()->with('delete', "Product $product->name deleted!");
    }

    public function deleteAll()
    {
        $product = Product::onlyTrashed()->get();

        if (count($product) == 0) {
            return back()->with('delete', 'Clean trash, nothing to delete!');
        } else {

            Product::onlyTrashed()->forceDelete();

            return back()->with('delete', 'All data destroyed!');
        }
    }

    public function news($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->new = !$product->new;
        $product->save();
        return redirect()->back()->with('success', "Product $product->name changed column new");
    }
    public function newsTrash($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->new = !$product->new;
        $product->save();
        return redirect()->back()->with('success', "Product $product->name changed column new");
    }

    public function qtyGet($id)
    {
        $product = Product::where('id', $id)->first();
        $id_product = Size_product::where('id_product', $id)->get();
        return view('admin.size_product.edit', compact('id_product', 'product'));
    }

    public function qtyPost(Request $request, $id)
    {
        $id_product = Size_product::where('id_product', $id)->get();
        $i = 0;
        foreach ($id_product as $qty) {
            $quantity = $i;
            $quantity = Size_product::findOrfail($qty->id);
            $quantity->qty = request('qty' . $i);
            $quantity->save();
            $i++;
        }

        return redirect()->back()->with('success', 'Add to qty');
    }
}
