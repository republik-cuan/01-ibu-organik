<?php

namespace App\Exports;

use App\Purchase;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PurchaseExport implements FromView
{
  protected $val = [];
  protected $label = "";

  public function __construct($val, $label)
  {
    $this->val = $val;
    $this->label = $label;
  }
  
  public function view(): View
  {
    return view('pages.rekap.month-xlsx', [
      'purchases' => $this->val,
      'label' => $this->label,
    ]);
  }
    
}
