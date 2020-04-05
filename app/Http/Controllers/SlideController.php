<?php

namespace App\Http\Controllers;

use App\slide;
use Illuminate\Http\Request;

class SlideController extends Controller
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
        $slide = Slide::all();
        return view('admin.slide.index', compact('slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slide = new slide();
        if (request('image')) {
            $slide->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }
        $slide->save();
        return redirect()->route('slide.index')->with('success', 'slide Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = slide::findOrFail($id);
        return view('admin.slide.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = slide::findOrFail($id);
        return view('admin.slide.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slide = slide::findOrfail($id);
        $slide->name = $request->name;
        $slide->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        $slide->save();
        return redirect()->route('slide.index')->with('success', 'slide Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        slide::find($id)->delete();

        //store status message
        Session::flash('success_msg', 'slide deleted successfully!');

        return redirect()->route('slide.index');
    }
}