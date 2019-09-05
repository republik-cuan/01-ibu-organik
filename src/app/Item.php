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
    'category_id',
    'supplier_id',
  ];

  public function supplier() {
    return $this->belongsTo(Supplier::class);
  }

  public function category() {
    return $this->belongsTo(Category::class);
  }

  public function purchases() {
    return $this->belongsToMany(Purchase::class);
  }
}
