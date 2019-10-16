<?php

namespace App\Exports;

use App\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;

class MonthlyExport implements FromCollection
{
    protected $invoices;

    public function __construct(array $invoices) {
      $this->invoices = $invoices;
    }

    public function collection() {
        return Purchase::all();
    }
}
