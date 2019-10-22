<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
  use SoftDeletes;
  
  protected $fillable = [
    'name',
    'modal',
    'reseller',
    'endUser',
    'stock',
    'sold',
    'berat',
    'satuan',
    'category_id',
    'supplier_id',
  ];

  public $berat = ['satuan', 'kilogram', 'gram'];
  public $satuan = ['satuan', 'gram'];

  public function supplier() {
    return $this->belongsTo(Supplier::class);
  }

  public function category() {
    return $this->belongsTo(Category::class);
  }

  public function purchases() {
    return $this->belongsToMany(Purchase::class)
                ->withPivot(['total','discount']);
  }
}
