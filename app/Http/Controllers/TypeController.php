<?php

namespace App\Http\Controllers;

use App\Type;
use http\Env\Response;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\Validator::validate

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
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
        $type = new Type();
        $type->name = request('name');
        if (request('image')) {
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
        $type = Type::findOrFail($id);
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
        $type = Type::findOrFail($id);
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
        $type = Type::findOrfail($id);
        $type->name = $request->name;
        $type->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
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
        Type::find($id)->delete();

        //store status message
        Session::flash('success_msg', 'Type deleted successfully!');

        return redirect()->route('type.index');
    }
}