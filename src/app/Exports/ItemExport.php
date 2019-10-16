<?php

namespace App\Exports;

use App\Item;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemExport implements FromView
{
	public function collection() {
		return Item::with('purchases:purchase_id,statusHarga')->get();
	}
  public function view(): View
  {
    $items = Item::with('purchases:purchase_id,statusHarga')->get();
    return view('pages.rekap.item-xlsx', [
      'items' => $items,
    ]);
  }
}
