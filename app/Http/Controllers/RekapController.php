<?php

namespace App\Http\Controllers;

use PDF;
use App\Bank;
use App\Item;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function item(Request $request)
    {
      $banks = Bank::all();

      if ($request->start_date!=null && $request->end_date!=null) {
        $temp = Item::with('purchases')->get();
        $foo = array_pad([], sizeof($temp), 0);

        if ($request->bank!=null && $request->bank!='none') {
          for ($i = 0; $i < sizeof($foo); $i++) {
            $purchase = $temp[$i]->purchases->reject(function($purchase) {
              $start = Date($_REQUEST['start_date']);
              $end = Date($_REQUEST['end_date']);
              $bank = intval($_REQUEST['bank']);
              return (
                $purchase['bank_id'] != $bank ||
                $purchase['created_at'] <= $start &&
                $purchase['created_at'] >= $end
              );
            })->map(function($barang) {
              return $barang;
            });

            $foo[$i] = [
              'id' => $temp[$i]->id,
              'name' => $temp[$i]->name,
              'endUser' => $temp[$i]->endUser,
              'modal' => $temp[$i]->modal,
              'reseller' => $temp[$i]->reseller,
              'sold' => $temp[$i]->sold,
              'purchases' => $purchase,
            ];
          }
        } else {
						for ($i = 0; $i < sizeof($foo); $i++) {
							$purchase = $temp[$i]->purchases->reject(function($purchase) {
								$start = Date($_REQUEST['start_date']);
								$end = Date($_REQUEST['end_date']);
								return (
									$purchase['created_at'] <= $start &&
									$purchase['created_at'] >= $end
								);
							})->map(function($barang) {
								return $barang;
							});

							$foo[$i] = [
								'id' => $temp[$i]->id,
								'name' => $temp[$i]->name,
								'endUser' => $temp[$i]->endUser,
								'modal' => $temp[$i]->modal,
								'reseller' => $temp[$i]->reseller,
								'sold' => $temp[$i]->sold,
								'purchases' => $purchase,
							];
						}
        }

        $items = json_encode($foo);

      } else if ($request->bank != null && $request->bank != "none") {
        $temp = Item::with('purchases')->get();
        $foo = array_pad([], sizeof($temp), 0);

        for ($i = 0; $i < sizeof($foo); $i++) {
          $purchase = $temp[$i]->purchases->reject(function($purchase) {
            $bank = intval($_REQUEST['bank']);
            return $purchase['bank_id'] != $bank;
          })->map(function($barang) {
            return $barang;
          });

          $foo[$i] = [
            'id' => $temp[$i]->id,
            'name' => $temp[$i]->name,
            'endUser' => $temp[$i]->endUser,
            'modal' => $temp[$i]->modal,
            'reseller' => $temp[$i]->reseller,
            'sold' => $temp[$i]->sold,
            'purchases' => $purchase,
          ];

          $items = json_encode($foo);
        }
        
      } else {
        $items = Item::with('purchases')->get();
      }

      return view('pages.rekap.item', [
        'items' => $items,
        'banks' => $banks,
        'bnk' => $request->bank!=null ? $request->bank : '',
        'start' => $request->start_date!=null ? $request->start_date : '',
        'end' => $request->end_date!=null ? $request->end_date : '',
      ]);
    }

    public function itemExport(Request $request) {

      if ($request->start_date!=null && $request->end_date!=null) {
        $temp = Item::with('purchases')->get();
        $foo = array_pad([], sizeof($temp), 0);

        if ($request->bank!=null && $request->bank!='none') {
          for ($i = 0; $i < sizeof($foo); $i++) {
            $purchase = $temp[$i]->purchases->reject(function($purchase) {
              $start = Date($_REQUEST['start_date']);
              $end = Date($_REQUEST['end_date']);
              $bank = intval($_REQUEST['bank']);
              return (
                $purchase['bank_id'] != $bank ||
                $purchase['created_at'] <= $start &&
                $purchase['created_at'] >= $end
              );
            })->map(function($barang) {
              return $barang;
            });

            $foo[$i] = [
              'id' => $temp[$i]->id,
              'name' => $temp[$i]->name,
              'endUser' => $temp[$i]->endUser,
              'modal' => $temp[$i]->modal,
              'reseller' => $temp[$i]->reseller,
              'sold' => $temp[$i]->sold,
              'purchases' => $purchase,
            ];
          }
        } else {
						for ($i = 0; $i < sizeof($foo); $i++) {
							$purchase = $temp[$i]->purchases->reject(function($purchase) {
								$start = Date($_REQUEST['start_date']);
								$end = Date($_REQUEST['end_date']);
								return (
									$purchase['created_at'] <= $start &&
									$purchase['created_at'] >= $end
								);
							})->map(function($barang) {
								return $barang;
							});

							$foo[$i] = [
								'id' => $temp[$i]->id,
								'name' => $temp[$i]->name,
								'endUser' => $temp[$i]->endUser,
								'modal' => $temp[$i]->modal,
								'reseller' => $temp[$i]->reseller,
								'sold' => $temp[$i]->sold,
								'purchases' => $purchase,
							];
						}
        }

        $items = json_encode($foo);

      } else if ($request->bank != null && $request->bank != "none") {
        $temp = Item::with('purchases')->get();
        $foo = array_pad([], sizeof($temp), 0);

        for ($i = 0; $i < sizeof($foo); $i++) {
          $purchase = $temp[$i]->purchases->reject(function($purchase) {
            $bank = intval($_REQUEST['bank']);
            return $purchase['bank_id'] != $bank;
          })->map(function($barang) {
            return $barang;
          });

          $foo[$i] = [
            'id' => $temp[$i]->id,
            'name' => $temp[$i]->name,
            'endUser' => $temp[$i]->endUser,
            'modal' => $temp[$i]->modal,
            'reseller' => $temp[$i]->reseller,
            'sold' => $temp[$i]->sold,
            'purchases' => $purchase,
          ];

          $items = json_encode($foo);
        }
        
      } else {
        $items = Item::with('purchases')->get();
      }

      $date = Date("d F Y");
      $pdf = PDF::loadView('pages.rekap.item-pdf', [
        'items' => $items,
      ]);

      return $pdf->stream('Rekap Item - '.$date.'.pdf');
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
        $purchases = Purchase::with(['inventories.item:id,modal,reseller,endUser'])
          ->get()
          ->groupBy(function($item){
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
      $date = Date("F Y");

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

      return $pdf->stream("Rekap Bulan - ".$date.".pdf");
    }
}
