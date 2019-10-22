<?php

namespace App\Http\Controllers;

use PDF;
use App\Item;
use App\Purchase;
use App\ItemPurchase;
use Illuminate\Http\Request;

class ItemPurchaseController extends Controller
{
    public function store(Request $request)
    {
      $item = Item::find($request->item);
      $purchase = Purchase::find($request->purchase);
      $inventory = ItemPurchase::where([
        'item_id' => $item->id,
        'purchase_id' => $purchase->id,
      ])->first();

      if ($request->bobot=="kilogram" && $item['satuan']=="gram") {
        $request->total *= 1000;
      }

      if ($inventory!=null) {
        $temp = $item->sold + $request->total;
        if ($item->stock > $temp) {
          $inventory->update([
            'total' => $inventory->total + $request->total,
            'discount' => $inventory->discount + $request->discount,
          ]);

          $item->update([
            'sold' => $temp,
          ]);

          return redirect()->route('purchase.add', $purchase->id)->with('message', 'Sukses menambahkan item baru kedalam pembelian');
        } else {
          return abort(400, 'Stock tidak mencukupi');
        }
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

    public function print($id) {
      $purchase = Purchase::with('customer', 'inventories.item')->find($id);

      $pdf = PDF::loadView('pages.purchase.pdf', [
        'purchase' => $purchase,
        'statusHarga' => $purchase->statusHarga,
        'customer' => $purchase->customer,
        'inventories' => $purchase->inventories,
      ]);

      return $pdf->stream();
    }

    public function verified($id) {
      $hasil = "";
      $purchase = Purchase::find($id);

      if ($purchase['statusPembayaran']=="terbayar") {
        $hasil = "belum bayar";
      } else {
        $hasil = "terbayar";
      }

      $purchase->update([
        'statusPembayaran' => $hasil,
      ]);
      return redirect('purchase');
    }

    public function destroy($id)
    {
      $inventory = ItemPurchase::with('purchase', 'item')->where('id', $id)->first();
      $purchase = $inventory->purchase;
      $item = $inventory->item;
      try {
        $item->update([
          'sold' => $item->sold - $inventory->total,
        ]);
      } catch (Exception $e) {
        return abort(400, $e);
      } finally {
        $purchase->items()->detach($item->id);
      }

      return redirect()->route('purchase.add', $purchase->id)->with('message', 'Sukses menghapus item dari penjualan');
    }
}
