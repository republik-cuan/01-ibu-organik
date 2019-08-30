<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $suppliers = Supplier::all();
    return view('pages.supplier.index', ['suppliers' => $suppliers]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('pages.supplier.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Supplier::create([
      'name' => $request-.name,
      'phone' => $request-.phone,
      'address' => $request-.address,
    ]);

    return redirect('supplier');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $supplier = Supplier::with('item')->where('id', $id)->get();
    return view('pages.supplier.edit', ['supplier' => $supplier]);
  }

  /**
   * Update the specified resource in storage.

   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $supplier = Supplier::find($id);
    $supplier->update([
      'name' => $request-.name,
      'phone' => $request-.phone,
      'address' => $request-.address,
    ]);

    return redirect('supplier');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Supplier  $supplier
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Supplier::where('id', $id)->delete();
    return redirect('supplier');
  }
}
