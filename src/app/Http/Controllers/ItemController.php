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
      return view('pages.item.create', [ 'categories' => $categories, 'suppliers' => $suppliers ]);
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
          'modal' => 'required|integer',
          'reseller' => 'required|integer',
          'endUser' => 'required|integer',
          'stock' => 'required|integer',
          'category_id' => 'required|integer',
          'supplier_id' => 'required|integer',
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        Item::create($validatedData);
      }

      return redirect()->route('item');
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
      $item = Item::find($id);
      $categories = Category::all();
      $suppliers = Supplier::all();
      $item->load('category', 'supplier');
      return view('pages.item.edit',['item' => $item, 'categories' => $categories, 'suppliers' => $suppliers ]);
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
        $validatedData = $request->validate([
          'name' => 'unique:items|required',
          'price' => 'required',
          'stock' => 'required',
          'sold' => 'required',
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        Item::where('id', $id)->update($request->except('_token','_method'));
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
      try {
        Item::where('id', $id)->delete();
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('item');
    }
}
