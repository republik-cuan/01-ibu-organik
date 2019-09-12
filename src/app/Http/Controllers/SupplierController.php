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
    $validatedData = $request->validate([
      'name'=> 'required',
      'phone'=> 'required',
      'address'=> 'required'
  ]);
    Supplier::create($validatedData);

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
    $supplier = Supplier::with('items')->findOrfail($id);
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
    $validatedData = $request->validate([
      'name'=> 'required',
      'phone'=> 'required',
      'address'=> 'required'
  ]);
    $supplier = Supplier::findOrfail($id);
    $supplier->update($validatedData);

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
        $supplier = Supplier::findOrfail($id);
        $supplier->delete();
        return redirect('/supplier');
    }

    public function trash()
    {
        $supplier = Supplier::onlyTrashed()->get();
        return view('pages.supplier.trash', [
            'supplier' => $supplier
        ]);
    }

    public function destroypermanent($id)
    {
        $supplier = Supplier::onlyTrashed()->findOrfail($id);
        $supplier->forceDelete();
        return redirect('supplier/trash');
    }

    public function restore($id)
    {
        $supplier = Supplier::onlyTrashed()->findOrfail($id);
        $supplier->restore();
        return redirect('supplier/trash');
    }
}
