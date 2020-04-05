<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Producer;
use App\Type;
// use Session;
// use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
        // $this->middleware('role:ROLE_SUPERADMIN');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('admin.product.index', compact('product'));
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
        return view('admin.product.create', compact('type', 'producer'));
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
            'name' => 'required',
            'type' => 'required',
            'producer' => 'required',
            'amount' => 'required',
            'image' => 'image | mimes:png,jpg,jpeg',
            'price_input' => 'required',
            'description' => 'required'

        ]);
        $product = new Product();
        $product->id = $request->id;
        $product->name = $request->name;
        $product->id_type = $request->type;
        $product->id_producer = $request->producer;
        $product->amount = $request->amount;
        $product->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        $product->price_input = $request->price_input;
        $product->description = $request->description;
        $product->save();
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
        // return view('admin.product.show', compact('product'));

        return response()->json(['data' => $product, 'name' => 'Khôi'], 200); // 200 là mã lỗi
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $type = Type::all();
        $producer = Producer::all();
        return view('admin.product.edit', compact('product', 'type', 'producer'));
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
            'name' => 'required',
            'type' => 'required',
            'producer' => 'required',
            'amount' => 'required',
            'image' => 'image | mimes:png,jpg,jpeg',
            'price_input' => 'required',
            'description' => 'required'


        ]);
        $product = Product::findOrfail($id);
        $product->name = $request->name;
        $product->id_type = $request->type;
        $product->id_producer = $request->producer;
        $product->amount = $request->amount;
        if ($request->hasFile('image')) {
            $product->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }
        $product->price_input = $request->price_input;
        $product->description = $request->description;

        $product->save();
        return redirect()->route('product.index')->with('success', 'Product Created successfully');
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
        return redirect()->back();
    }

    public function trashed(Request $request)
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.product.trash', compact('product'));
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('product.trash')->with('success', "Product $product->name restored!");
    }

    public function restoreAll()
    {
        $product = Product::onlyTrashed()->get();
        if (count($product) == 0) {
            return redirect()->route('product.trash')->with('success', "Clean trash, nothing to restore!");
        } else {
            Product::onlyTrashed()->restore();
            return redirect()->route('product.trash')->with('success', "All data restored!");
        }
    }

    public function delete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        // if (!empty($product->image)) {
        //     unlink("img/products/" . $product->image);
        // }

        $product->forceDelete();
        return redirect()->route('product.trash')->with('delete', "Product $product->name destroyed!");
    }

    public function deleteAll()
    {
        $product = Product::onlyTrashed()->get();

        // foreach ($product as $value) {
        //     // if (!empty($value->image)) {
        //     //     unlink("img/products/" . $value->image);
        //     // }
        // }

        if (count($product) == 0) {
            return redirect()->route('product.trash')->with('delete', "Clean trash, nothing to delete!");
        } else {
            Product::onlyTrashed()->forceDelete();
            return redirect()->route('product.trash')->with('delete', "All data destroyed!");
        }
    }
}