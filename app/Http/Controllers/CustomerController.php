<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $customers = Customer::where('status', 'customer')->get();

      return view('pages.customer.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('pages.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'address' => 'required',
        'patokan' => 'required',
      ]);

      Customer::create($validatedData);
      return redirect('customer')->with('message', 'Tambah customer berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $customer = \App\Customer::find($id);
        // return view('pages.customer.edit',['customer'=>$customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.edit',['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'adress' => 'required',
        'patokan' => 'required',
      ]);
      $customer = Customer::find($id);
      $customer->update($validatedData);
      return redirect('/customer')->with('message', 'edit customer berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('/customer');
    }
    public function trash()
    {
        $customers = Customer::onlyTrashed()->get();
        return view('pages.customer.trash',[
            'customers' => $customers

        ]);
    }
    public function destroypermanent($id)
    {
        $customer = Customer::onlyTrashed()->findOrfail($id);
        $customer->forceDelete();
        return redirect('customer/trash');

    }
    public function restore($id)
    {
        $customer = Customer::onlyTrashed()->findOrfail($id);
        $customer->restore();
        return redirect('customer/trash');
    }
}
