<?php

namespace App\Http\Controllers;

use App\Item;
use App\Purchase;
use App\ItemPurchase;
use Illuminate\Http\Request;

class ItemPurchaseController extends Controller
{
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
      $item = Item::find($request->item);
      $purchase = Purchase::find($request->purchase);
      $inventory = ItemPurchase::where([
        'item_id' => $item->id,
        'purchase_id' => $purchase->id,
      ])->first();

      if ($inventory!=null) {
        $inventory->update([
          'total' => $inventory->total + $request->total,
          'discount' => $inventory->discount + $request->discount,
        ]);

        $item->update([
          'sold' => $item->sold + $request->total,
        ]);

        return redirect()->route('purchase.add', $purchase->id)->with('message', 'Sukses menambahkan item baru kedalam pembelian');
      }

      try {
        $purchase->items()->attach($item->id, [
          'total' => $request->total,
          'discount' => $request->discount,
        ]);
      } catch (Exception $e) {
        return redirect()->route('purchase.add', $purchase->id)->with('message', $e);
      } finally {
        $item->update([
          'sold' => $item->sold + $request->total,
        ]);
      }

      return redirect()->route('purchase.add', $purchase->id)->with('message', 'Sukses menambahkan item baru kedalam pembelian');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
