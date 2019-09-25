<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemPurchase extends Pivot
{
  protected $fillable = ['total', 'discount'];

  public function item() {
    return $this->belongsTo(Item::class);
  }

  public function purchase() {
    return $this->belongsTo(Purchase::class);
  }
}
