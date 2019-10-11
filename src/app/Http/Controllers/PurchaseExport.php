<?php

use App;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PurchaseExport implements FromView
{

  public function view($id): View
  {
    return view('pages.rekap.detail', [
      'purchases' => App\Purchase::find($id),
    ]);
  }

  public function export($id)
  {
    return Excel::download(new PurchaseExport($id), 'rekap.xlsx');
  }
  
}
