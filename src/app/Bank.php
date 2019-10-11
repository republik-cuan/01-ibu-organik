<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
