<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlyExport implements FromView
{
    protected $invoices;
    protected $label;

    public function __construct(object $invoices, string $label) {
      $this->invoices = $invoices;
      $this->label = $label;
    }

    public function view(): View {
      return view('pages.rekap.month-xlsx', [
        'purchases' => $this->invoices,
        'label'     => $this->label,
      ]);
    }
}
