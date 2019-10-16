<?php

namespace App\Http\Controllers;

use App\Item;
use App\Purchase;
use App\Exports\ItemExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
      return Excel::download(new ItemExport, 'rekap-barang.xlsx');
    }

    public function month(Request $request) {
      $purchases = [];
      if ($request!=null) {
        $purchases = Purchase::with(['inventories.item:id,modal,reseller,endUser'])
          ->whereYear('created_at', $request->year)
          ->whereMonth('created_at', $request->month)
          ->get();
      } else {
        $purchases = Purchase::with(['inventories.item:id,modal,reseller,endUser'])->get()->groupBy(function($item){
          return Carbon::parse($item->created_at)->format('Y-m');
        });
      }

      return view('pages.rekap.index', [
        'purchases' => $purchases,
      ]);
    }

    public function monthExport() {
      return Excel::download(new PurchaseExport, 'rekap-bulanan.xlsx');
    }
}
