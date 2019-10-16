<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Item;
use App\Bank;
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
      $purchases = Purchase::with(['bank', 'customer', 'inventories.item'])->get();

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
      $banks = Bank::all();
      $temp = new Purchase();

      return view('pages.purchase.create', [
        'customers' => $customers,
        'banks' => $banks,
        'status' => $temp->statusPembayaran,
        'statusHarga' => $temp->statusHarga,
        'deliveries' => $temp->deliveries,
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
      $kode = "";
      switch ($request->statusHarga) {
        case 'end user':
          $kode = "E";
          break;
        case 'reseller':
          $kode = "R";
          break;
        case 'distributor':
          $kode = "D";
          break;
      }
      $jml = Purchase::withTrashed()->whereDate('created_at', date('Y-m-d'))->get()->count();
      $jml += 1;
      $kode .= date('ymd').sprintf("%03s",$jml);

      try {
        $temp = $customer->purchases()->create([
          'kode' => $kode,
          'statusHarga' => $request->statusHarga,
          'deliveryPrice' => $request->deliveryPrice,
          'deliveryOption' => $request->deliveryOption,
          'bank_id' => $request->bank,
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('purchase.add', $temp->id);
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
      $purchase = Purchase::with('customer', 'inventories.item')->find($id);
      $banks = Bank::all();
      return view('pages.purchase.edit', [
        'purchase' => $purchase,
        'banks' => $banks,
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
      $purchase = Purchase::find($id);

      try {
        $purchase->update([
          'bank_id' => $request->bank,
          'statusHarga' => $request->statusHarga,
          'deliveryPrice' => $request->deliveryPrice,
          'deliveryOption' => $request->deliveryOption,
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('purchase.add', $purchase->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $purchase = Purchase::with('inventories.item', 'customer')->find($id);
      $inventories = $purchase->inventories;

      try {
        $purchase->delete();
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        foreach ($inventories as $inventory) {
          $inventory->item->update([
            'sold' => $inventory->item->sold - $inventory->total,
          ]);
        }
      }

      return redirect()->route('purchase');
    }

    public function add($id) {
      $purchase = Purchase::with('customer', 'inventories')->where('id', $id)->first();
      $items = Item::all();

      /* return $purchase; */

      return view('pages.purchase.add', [
        'purchase' => $purchase,
        'statusHarga' => $purchase->statusHarga,
        'customer' => $purchase->customer,
        'inventories' => $purchase->inventories,
        'items' => $items,
      ]);
    }
}
