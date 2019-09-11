<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $purchases = Purchase::with('customer')->get();

      return view('pages.purchase.index', [
        'purchases' => $purchases,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $customers = Customer::all();
      $temp = new Purchase();

      return view('pages.purchase.create', [
        'customers' => $customers,
        'banks' => $temp->banks,
        'status' => $temp->status,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $customer = Customer::find($request->customer);

      try {
        $customer->purchases()->create([
          'bank' => $request->bank,
          'accountNumber' => $request->accountNumber,
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('customer.edit', $customer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $purchase = Purchase::with('customer')->where('id', $id);

      return view('pages.purchase.edit', [
        'purchase' => $purchase,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $purchase = Purchase::with('customer', $id)->first();
      try {
        $purchase->update($request);
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('customer.edit', $purchase->customer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $purchase = Purchase::find($id);
      $customer = $purchase->customer;
      try {
        $purchase->delete();
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('customer.edit', $customer->id);
    }
}
