<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $fillable = [
    'name',
    'price',
    'stock',
    'sold',
  ];

  public function purchases() {
    return $this->belongsToMany(Purchase::class);
  }

  public function supplier() {
    return $this->belongsTo(Supplier::class);
  }
}
