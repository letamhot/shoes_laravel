<?php

namespace App\Http\Controllers;

use App\Bill_detail;
use App\Bills;
use App\Product;
use App\Size;
use App\Size_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillDetailController extends Controller
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
        //
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
        //code
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bills = Bill_detail::withTrashed()->findOrFail($id);
        $product = Product::withTrashed()->where('id', $bills->id_product)->first();
        $sizes = Size::all();
        $size_product = Size_product::where('id_product', $bills->id_product)->get();
        return view('admin.bills.editBillDetail', compact('bills', 'product', 'sizes', 'size_product'));
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
            'size' => 'required | numeric | min:0',
            'status' => 'required | numeric | between:0,1',
        ]);

        $bill = Bill_detail::withTrashed()->findOrFail($id); // 132
        $product = Product::withTrashed()->where('id', $bill->id_product)->first();
        $size_product = Size_product::where('id_product', $bill->id_product)->get();
        $code_bill = Bills::withTrashed()->findOrFail($bill->id_bill);
        $i = 0;
        if (request('quantity') > $size_product->qty) {
            return back()->with('error', "Error, $product->name Exceeded quantity in stock! Maximum is $size_product->qty!");
        }
        if ($product->promotion_price > 0) {
            $price = $product->promotion_price;
        } else {
            $price = $product->unit_price;
        }
        $bool = true;
        $total = 0;

        foreach ($size_product as $size) {
            if (request('size') == $size->id_size) {
                $bill->size = request('size');
                $bill->quantity = request('quantity');
                $bill->total_price = ((request('quantity') * $price) / 100);
                $bill->status = request('status');
                Bill_detail::withTrashed()->findOrFail($id)->update(['user_updated' => Auth::user()->name]);
                $bill->save();

                $amountBill = Bill_detail::where('id_bill', $bill->id_bill)->get();

                foreach ($amountBill as $price) {
                    $total += $price->total_price;
                }

                $code_bill->total = $total;
                $code_bill->save();
                return back()->with('success', "Update $bill->id success!");
            } else {
                $bool = false;
            }
        }
        if ($bool == false) {
            return back()->with('error', "Error, Please select the correct size of this product - $product->name!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill_detail::findOrFail($id);
        Bill_detail::find($id)->update(['user_deleted' => Auth::user()->name]);
        $code_bill = Bills::withTrashed()->findOrFail($bill->id_bill);
        $bill->product()->delete();
        $bill->delete();
        $total = 0;
        $amountBill = Bill_detail::where('id_bill', $bill->id_bill)->get();

        foreach ($amountBill as $price) {
            $total += $price->total_price;
        }

        $code_bill->total = $total;
        $code_bill->save();

        return back()->with('success', "Bills $bill->id moved to trash!");
    }

    public function trashed(Request $request, $id)
    {
        $size_product = Size_product::all();
        $bill_detail = Bill_detail::onlyTrashed()->where('id_bill', $id)->get();
        $id_bill_detail = Bill_detail::withTrashed()->where('id_bill', $id)->first();
        $id_bills = Bills::withTrashed()->where('id', $id_bill_detail->id_bill)->first();
        return view('admin.bills.trashBillDetail', compact('size_product', 'bill_detail', 'id_bill_detail', 'id_bills'));
    }

    public function restore($id)
    {
        $bill = Bill_detail::withTrashed()->findOrFail($id);
        $bill->restore();

        $code_bill = Bills::withTrashed()->findOrFail($bill->id_bill);
        $total = 0;
        $amountBill = Bill_detail::withTrashed()->where('id_bill', $bill->id_bill)->get();

        foreach ($amountBill as $price) {
            $total += $price->total_price;
        }

        $code_bill->total = $total;
        $code_bill->save();

        return back()->with('success', "Bills $bill->id restored!");
    }

    public function restoreAll()
    {
        $bills = Bill_detail::onlyTrashed()->get();
        if (count($bills) == 0) {
            return redirect()->route('bills.trash')->with('delete', "Clean trash, nothing to restore!");
        } else {
            $total = 0;
            foreach ($bills as $bill) {
                $bill->restore();
                $code_bill = Bills::withTrashed()->where('id', $bill->id_bill)->first();
            }

            $amountBill = Bill_detail::withTrashed()->where('id_bill', $bill->id_bill)->get();
            foreach ($amountBill as $price) {
                $total += $price->total_price;
            }

            $code_bill->total = $total;
            $code_bill->save();
            return back()->with('success', "Success, all data of bill $code_bill->id restored!");
        }
    }

    public function delete($id)
    {
        $bill_detail = Bill_detail::onlyTrashed()->findOrFail($id);
        $bill_detail->forceDelete();
        return redirect()->route('bills.trash')->with('delete', "Bills $bill_detail->id destroyed!");
    }

    public function deleteAll()
    {
        $bill_detail = Bill_detail::onlyTrashed()->get();

        if (count($bill_detail) == 0) {
            return redirect()->route('bills.trash')->with('delete', "Clean trash, nothing to delete!");
        } else {
            foreach ($bill_detail as $item) {
                $code_bill = Bills::withTrashed()->where('id', $item->id_bill)->first();
                $item->forceDelete();
            }
            return back()->with('error', "All data of bill $code_bill->id destroyed!");
        }
    }
}
