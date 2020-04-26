<?php

namespace App\Http\Controllers;

use DB;

use App\User;
use App\Bills;
use App\Bill_detail;
use App\Size_product;

// use App\Http\UserAuth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
        // $this->middleware('role:ROLE_SUPERADMIN');
    }
    public function dashboard()
    {
        //Tổng tiền khách đã đặt
        $earnings = Bills::withTrashed()->where('status', 1)->whereDate('date_order', '=', date('Y-m-d'))->sum('total');
        //Tổng số sản phẩm
        $total_product = Size_product::sum('qty');
        $total_product += Bill_detail::withTrashed()->sum('quantity');
        //Tổng số sản phẩm đã bán
        $product = Bill_detail::withTrashed()->where('status', 1)->sum('quantity');
        // Bills
        $bill = Bills::all();
        //Thống kê bills theo ngày
        $todayBills = Bills::whereDate('date_order', '=', date('Y-m-d'))->get();
        $todayBill_detail = Bill_detail::withTrashed()->where('status', 1)->whereDate('created_at', '=', date('Y-m-d'))->get();


        $day_bills = array();
        for ($i = 0; $i <= 30; $i++) {
            $day_bills[$i] = Bills::withTrashed()->where('status', 1)->whereDay('date_order', $i + 1)->whereMonth('date_order', date('m'))->sum('total');
        }
        $month_bills = array();

        for ($i = 0; $i < 12; $i++) {
            $month_bills[$i] = Bills::withTrashed()->where('status', 1)->whereMonth('date_order', $i + 1)->sum('total');
        }
        return view('admin.dashboard', compact('earnings', 'total_product', 'product', 'bill', 'todayBill_detail', 'todayBills', 'day_bills', 'month_bills'));
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
