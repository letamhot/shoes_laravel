<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producer;
use App\Product;


use Session;


class ProducerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:ROLE_ADMIN');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producer = producer::all();
        return view('admin.producer.index', compact('producer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.producer.create');
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
            'address' => 'required',
            'phone' => 'required',
            'tax_code' => 'required',
            // 'image' => 'required',
        ]);
        $producer = new Producer();
        $producer->name = $request->name;
        $producer->address = $request->address;
        $producer->phone = $request->phone;
        $producer->tax_code = $request->tax_code;
        $producer->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        $producer->save();
        return redirect()->route('producer.index')->with('success', 'Producer Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producer = Producer::findOrFail($id);
        return view('admin.producer.show', compact('producer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producer = Producer::find($id);
        return view('admin.producer.edit', compact('producer'));
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
            'address' => 'required',
            'phone' => 'required',
            'tax_code' => 'required',
        ]);
        $producer = Producer::findOrfail($id);
        $producer->name = $request->name;
        $producer->address = $request->address;
        $producer->phone = $request->phone;
        $producer->tax_code = $request->tax_code;
        if ($request->hasFile('image')) {
            $producer->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }
        $producer->save();
        return redirect()->route('producer.index')->with('success', 'Producer Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producer = Producer::findOrfail($id);

        $producer->product()->delete();
        $producer->delete();
        return back()->with('success', "Producer $producer->name delete!");
    }

    public function trashed(Request $request)
    {
        $producer = producer::onlyTrashed()->get();
        return view('admin.producer.trash', compact('producer'));
    }

    public function restore($id)
    {
        $producer = producer::onlyTrashed()->findOrFail($id);
        $producer->product()->restore();
        $producer->restore();

        return back()->with('success', "producer $producer->name restored!");
    }

    public function restoreAll()
    {
        $producer = producer::onlyTrashed()->get();
        if (count($producer) == 0) {
            return back()->with('success', "Clean trash, nothing to restore!");
        } else {
            foreach ($producer as $item) {
                $item->product()->restore();
            }
            producer::onlyTrashed()->restore();
            return back()->with('success', "All data restored!");
        }
    }

    public function delete($id)
    {
        $producer = producer::onlyTrashed()->findOrFail($id);
        $producer->product()->forceDelete();
        $producer->forceDelete();
        return back()->with('delete', "producer $producer->name destroyed!");
    }

    public function deleteAll()
    {
        $producer = producer::onlyTrashed()->get();

        if (count($producer) == 0) {
            return back()->with('delete', "Clean trash, nothing to delete!");
        } else {
            foreach ($producer as $item) {
                $item->product()->forceDelete();
            }
            producer::onlyTrashed()->forceDelete();
            return back()->with('delete', "All data destroyed!");
        }
    }
}