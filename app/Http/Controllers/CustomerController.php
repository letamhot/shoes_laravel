<?php

namespace App\Http\Controllers;

use DateTime;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

use App\Customer;
use App\Bill_detail;
use App\Bills;
use App\Gender;


class CustomerController extends Controller
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
        $customer = Customer::all();
        return view('admin.customer.list', compact('customer'));
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
        //
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
        $gender = Gender::all();
        $customer = Customer::withTrashed()->findOrFail($id);
        return view('admin.customer.edit', compact('customer', 'gender'));
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
        $this->validate($request, [
            'name' => 'required | min:5 | max:255 | string',
            'gender' => 'required',
            'address' => 'required | min:5 | max:255 | string',
            'city' => 'required | min:1 | max:255 | string',
            'phone' => 'required | numeric | min:0',
        ]);

        $customer = Customer::withTrashed()->findOrFail($id);

        $customer->name = request('name');
        if (request('gender')) {
            $customer->gender_id = request('gender');
        } else {
            $customer->gender_id = null;
        }

        $customer->email = request('email');
        $customer->address = request('address');
        $customer->postcode = request('postcode');
        $customer->city = request('city');
        $customer->phone = request('phone');
        $customer->user_updated = Auth::user()->name;
        $customer->save();

        return redirect()->back()->with('success', "Customer $customer->name updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        Customer::find($id)->update(['user_deleted' => Auth::user()->name]);

        $bills = Bills::where('id_customer', $customer->id)->get();

        foreach ($bills as $bill) {
            $find_bills_detail = Bill_detail::where('id_bill', $bill->id)->get();
            foreach ($find_bills_detail as $delete_item) {
                $delete_bills_detail = Bill_detail::findOrFail($delete_item->id);
                $delete_bills_detail->delete();
            }
        }

        $customer->bills()->delete();
        $customer->delete();
        return back()->with("success", "Customer $customer->name deleted, and all bill and bill details of this customer deleted, you can restore in garbage can!");
    }

    public function trashed(Request $request)
    {
        $customer = Customer::onlyTrashed()->get();
        return view('admin.customer.trash', compact('customer'));
    }

    public function restore($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $bills = Bills::onlyTrashed()->where('id_customer', $customer->id)->get();


        foreach ($bills as $bill) {
            $find_bills_detail = Bill_detail::onlyTrashed()->where('id_bill', $bill->id)->get();
            foreach ($find_bills_detail as $delete_item) {
                $delete_bills_detail = Bill_detail::onlyTrashed()->findOrFail($delete_item->id);
                $delete_bills_detail->restore();
            }
        }

        $customer->bills()->restore();
        $customer->restore();
        return back()->with('success', "Customer $customer->name restored!");
    }

    public function delete($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $bills = Bills::onlyTrashed()->where('id_customer', $customer->id)->get();

        foreach ($bills as $bill) {
            $find_bills_detail = Bill_detail::onlyTrashed()->where('id_bill', $bill->id)->get();
            foreach ($find_bills_detail as $delete_item) {
                $delete_bills_detail = Bill_detail::onlyTrashed()->findOrFail($delete_item->id);
                $delete_bills_detail->forceDelete();
            }
        }

        $customer->bills()->forceDelete();
        $customer->forceDelete();
        return back()->with('delete', "Customer $customer->name deleted!");
    }

    public function restoreAll()
    {
        $customer = Customer::onlyTrashed()->get();
        if (count($customer) == 0) {
            return back()->with('success', "Clean trash, nothing to restore!");
        } else {
            Customer::onlyTrashed()->restore();
            return back()->with('success', "All data restored!");
        }
    }

    public function deleteAll()
    {
        $customer = Customer::onlyTrashed()->get();


        if (count($customer) == 0) {
            return back()->with('delete', "Clean trash, nothing to deleted!");
        } else {
            foreach ($customer as $item) {
                $item->customer_detail()->forceDelete();
                $item->forceDelete();
            }
            return back()->with('delete', "All data deleted!");
        }
    }

    public function active($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);
        $customer->active = !$customer->active;
        $customer->save();
        return redirect()->back()->with('success', "Customer $customer->name updated active column!");
    }
}
