<?php

namespace App\Http\Controllers;

use PDF;
use App\Item;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function item()
    {
      $items = Item::with('purchases:purchase_id,statusHarga')->get();

      return view('pages.rekap.item', [
        'items' => $items,
      ]);
    }

    public function itemExport() {
      $items = Item::with('purchases:purchase_id,statusHarga')->get();
      $pdf = PDF::loadView('pages.rekap.item-pdf', [
        'items' => $items,
      ]);

      return $pdf->stream();
    }

    public function month(Request $request) {
      $label = "";
      if ($request->year!="") {
        $label = "with";
        $purchases = Purchase::with(['inventories.item:id,modal,reseller,endUser'])
          ->whereYear('created_at', $request->year)
          ->whereMonth('created_at', $request->month)
          ->get();
      } else {
        $label = "without";
        $purchases = Purchase::with(['inventories.item:id,modal,reseller,endUser'])->get()->groupBy(function($item){
          return Carbon::parse($item->created_at)->format('Y-m');
        });
      }

      return view('pages.rekap.month', [
        'purchases' => $purchases,
        'label' => $label,
      ]);
    }

    public function monthExport(Request $request) {
      $purchases = [];
      $label = "";
      if ($request->year!="") {
        $label = "with";
        $purchases = Purchase::with(['inventories.item:id,modal,reseller,endUser'])
          ->whereYear('created_at', $request->year)
          ->whereMonth('created_at', $request->month)
          ->get();
      } else {
        $label = "without";
        $purchases = Purchase::with(['inventories.item:id,modal,reseller,endUser'])->get()->groupBy(function($item){
          return Carbon::parse($item->created_at)->format('Y-m');
        });
      }

      $pdf = PDF::loadView('pages.rekap.month-pdf', [
        'purchases' => $purchases,
        'label'     => $label,
      ]);

      return $pdf->stream();
    }
}
