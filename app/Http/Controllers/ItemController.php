<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use App\Supplier;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $items = Item::with(['supplier:id,name', 'category:id,name'])->get();

      return view('pages.item.index', [
        'items' => $items,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::select('id','name')->get();
      $suppliers = Supplier::select('id','name')->get();
      $item = new Item();
      return view('pages.item.create', [
        'categories' => $categories,
        'suppliers' => $suppliers ,
        'berat' => $item->berat,
        'satuan' => $item->satuan,
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
      try {
        $validatedData = $request->validate([
          'name' => 'unique:items|required',
          'modal' => 'required',
          'reseller' => 'required',
          'endUser' => 'required',
          'stock' => 'required|integer',
          'satuan' => 'required',
          'category_id' => 'required|integer',
          'supplier_id' => 'required|integer',
        ]);
        Item::create($validatedData);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        return redirect()->route('item');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.http://datatables.net/tn/4
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $item = Item::with(['category', 'supplier'])->find($id);
      $categories = Category::all();
      $suppliers = Supplier::all();

      return view('pages.item.edit', [
        'item' => $item,
        'categories' => $categories,
        'suppliers' => $suppliers,
        'satuan' => $item->satuan,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try {
        $item = Item::find($id);
        $temp = ($request->stock - ($item->stock-$item->sold));
        $item->update([
          'modal' => $request->modal,
          'reseller' => $request->reseller,
          'endUser' => $request->endUser,
          'name' => $request->name,
          'price' => $request->price,
          'stock' => $item->stock + $temp,
          'satuan' => $request->satuan,
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        return redirect()->route('item')->with('message','Edit Item Berhasil');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Item::with('purchases')->find($id);

      if (sizeof($item->purchases) > 0) {
        return redirect()->route('item')->with([
          'error' => true,
          'message' => 'Some Purchase still have this value'
        ]);
      } else {
        try {
          $item->forceDelete();
        } catch (Exception $e) {
          return abort(404, $e);
        } finally {
          return redirect()->route('item');
        }
      }
    }
    public function trash()
    {
      $item = Item::with(['category:id,name', 'supplier:id,name'])->onlyTrashed()->get();
      return view('pages.item.trash',[
        'item'=>$item,
      ]);
    }
    public function destroypermanent($id)
    {
      $item = Item::with('purchases')->find($id);
      if (sizeof($item->purchases) > 0) {
        return redirect()->route('item')->with('message','Edit Item Berhasil');
      } else {
        $item->forceDelete();
        return redirect('item/trash');
      }
    }
    public function restore($id)
    {
      $item = Item::onlyTrashed()->findOrFail($id);
      $item->restore();
      return redirect('item');
    }
}
