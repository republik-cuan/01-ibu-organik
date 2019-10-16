<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class SalesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $saless = Customer::where('status', 'reseller')->get();
    return view('pages.sales.index',[
      'saless' => $saless
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('pages.sales.create');
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
    $validatedData['status'] = 'reseller';
    Customer::create($validatedData);
    return redirect('sales')->with('message', 'Tambah sales berhasil');
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
    $sales = Customer::findOrfail($id);
    return view('pages.sales.edit', ['sales' => $sales]);
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
    $validatedData = $request->validate([
      'name' => 'required',
      'phone' => 'required',
      'email' => 'required',
      'gender' => 'required',
      'address' => 'required',
      'patokan' => 'required',
      'status' => 'required',
    ]);
    $sales = Customer::findOrfail($id);
    $sales->update($validatedData);
    return redirect('/sales')->with('message', 'edit sales berhasil');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {

    $sales = Customer::find($id);
    $sales->delete();
    return redirect('/sales');

  }
  public function trash()
  {
    $saless = Customer::onlyTrashed()->get();
    return view('pages.sales.trash',[
      'saless' => $saless

    ]);

  }
  public function destroypermanent($id)
  {
    $sales = Customer::onlyTrashed()->findOrfail($id);
    $sales->forceDelete();
    return redirect('sales/trash');

  }
  public function restore($id)
  {
    $sales = Customer::onlyTrashed()->findOrfail($id);
    $sales->restore();
    return redirect('sales/trash');
  }
}
