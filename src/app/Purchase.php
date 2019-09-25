<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'kode',
    'bank',
    'rekening',
    'statusHarga',
    'statusPengiriman',
    'statusPembayaran',
    'deliveryPrice',
    'deliveryOption',
    'pembayaran',
  ];

  public $statusPembayaran = [
    'belum bayar',
    'preorder',
    'terbayar',
  ];

  public $statusHarga = [
    'reseller',
    'modal',
    'end user',
  ];

  public $banks = [
    'bni',
    'bri',
    'bca',
    'mandiri',
    'cash',
  ];

  public $deliveries = [
    'kurir',
    'grab',
    'expedisi',
    'free ongkir',
    'ambil sendiri',
  ];

  public function customer() {
    return $this->belongsTo(Customer::class);
  }

  public function items() {
    return $this->belongsToMany(Item::class)
                ->withPivot(['discount','total']);
  }

  public function inventories() {
    return $this->hasMany(ItemPurchase::class);
  }
}
