<?php

namespace App\Http\Controllers;

use DB;

use App\User;
// use App\Http\UserAuth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:ROLE_ADMIN');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function error404()
    {
        return view('admin.404');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function button()
    {
        return view('admin.button');
    }

    public function card()
    {
        return view('admin.card');
    }

    public function chart()
    {
        return view('admin.chart');
    }
    public function table()
    {
        return view('admin.table');
    }
    public function animation()
    {
        return view('admin.utilities.animation');
    }

    public function border()
    {
        return view('admin.utilities.border');
    }

    public function color()
    {
        return view('admin.utilities.color');
    }

    public function orther()
    {
        return view('admin.utilities.orther');
    }

    // public function index1(Request $request)
    // {


    //     if ($request->session()->has('remember_token')) {
    //         return view('yte', ['name' => $request->session()->get('username')]);
    //     } else return view('admin.404');
    // }

}