<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
  use SoftDeletes;
  protected $fillable = [
    'status',
    'bank',
    'accountNumber',
  ];

  public $status = [
    'order',
    'preorder',
    'verified',
  ];

  public $banks = [
    'bni',
    'bri',
    'mandiri',
  ];

  public function customer() {
    return $this->belongsTo(Customer::class);
  }

  public function items() {
    return $this->belongsToMany(Item::class);
  }
}
