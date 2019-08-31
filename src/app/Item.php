<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $fillable = [
    'supplier_id',
    'category_id',
    'name',
    'price',
    'stock',
    'sold',
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

  public function supplier() {
    return $this->belongsTo(Supplier::class);
  }
}
