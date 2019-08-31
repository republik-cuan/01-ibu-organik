<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $fillable = [
    'name',
    'phone',
    'address',
  ];

  public function items() {
  	return $this->hasMany(Item::class);
  }
}
