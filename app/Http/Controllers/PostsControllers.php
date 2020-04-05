<?php

namespace App\Http\Controllers;

use App\Posts;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
        $this->middleware('role:ROLE_SUPERADMIN');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        return view('admin.posts.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Posts();
        $post->title = request('title');
        $post->content = request('description');

        // if ($post->image) {
        $post->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        // }

        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('success', "New Post $post->title created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
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
        $post = Posts::findOrFail($id);
        $post->title = request('title');
        $post->content = request('description');

        if ($request->hasFile('image')) {
            $post->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('success', "Update Post $post->title success!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('delete', "Post $post->title deleted!");
    }

    //Search
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return redirect()->route('posts.index');
        }
        $posts = Posts::where('title', 'LIKE', '%' . $keyword . '%')->paginate(5);
        return view('admin.posts.list', compact('posts'));
    }
}