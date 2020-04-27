<?php

namespace App\Http\Controllers;

use App\Type;
use App\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
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
        // if ( Auth::check() ) {
        $type = Type::all();
        return view('admin.type.index', compact('type'));
        // }
        //     return view( 'admin.404' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.type.create');
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
            'name' => 'required|string| min:3',
            'image' => 'image | mimes:png,jpg,jpeg',

        ]);
        $type = new Type();
        $type->name = $request->name;
        if ($request->image) {
            $type->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }
        $type->save();
        return redirect()->route('type.index')->with('success', 'Type Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $type = Type::withTrashed()->findOrFail($id);
        return view('admin.type.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $type = Type::withTrashed()->findOrFail($id);
        return view('admin.type.edit', compact('type'));
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
            'name' => 'required|string| min:3',
            'image' => 'image | mimes:png,jpg,jpeg',

        ]);
        $type = Type::withTrashed()->findOrfail($id);
        $type->name = $request->name;
        if ($request->image) {
            $type->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }
        $type->save();
        return redirect()->route('type.index')->with('success', 'Type Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $type = Type::findOrfail($id);

        $type->product()->delete();
        $type->delete();
        return back()->with('success', "Type $type->name delete!");
    }

    public function trashed(Request $request)
    {
        $type = Type::onlyTrashed()->get();
        return view('admin.type.trash', compact('type'));
    }

    public function restore($id)
    {
        $type = Type::onlyTrashed()->findOrFail($id);
        $type->product()->restore();
        $type->restore();

        return back()->with('success', "type $type->name restored!");
    }

    public function restoreAll()
    {
        $type = Type::onlyTrashed()->get();
        if (count($type) == 0) {
            return back()->with('success', "Clean trash, nothing to restore!");
        } else {
            foreach ($type as $item) {
                $item->product()->restore();
            }
            Type::onlyTrashed()->restore();
            return back()->with('success', "All data restored!");
        }
    }

    public function delete($id)
    {
        $type = Type::onlyTrashed()->findOrFail($id);
        $type->product()->forceDelete();
        $type->forceDelete();
        return back()->with('delete', "type $type->name destroyed!");
    }

    public function deleteAll()
    {
        $type = Type::onlyTrashed()->get();

        if (count($type) == 0) {
            return back()->with('delete', "Clean trash, nothing to delete!");
        } else {
            foreach ($type as $item) {
                $item->product()->forceDelete();
            }
            Type::onlyTrashed()->forceDelete();
            return back()->with('delete', "All data destroyed!");
        }
    }
}
