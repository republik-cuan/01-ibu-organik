<?php

namespace App\Exports;

use App\Purchase;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PurchaseExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Purchase::all();
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function view(): View
    {
      return view('pages.rekap.xlsx', [
        'purchases' => Purchase::all(),
      ]);
    }
    
}
