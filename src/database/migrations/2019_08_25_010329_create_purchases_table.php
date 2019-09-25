<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode')->unique();
            $table->enum('bank', [
              'bni',
              'bri',
              'bca',
              'mandiri',
              'cash',
            ]);
            $table->string('rekening')->default('-');
            $table->enum('statusHarga', [
              'reseller',
              'modal',
              'end user',
            ])->default('end user');
            $table->enum('statusPembayaran', [
              'belum bayar',
              'preorder',
              'terbayar',
            ])->default('belum bayar');
            $table->boolean('statusPengiriman')->default(false);
            $table->enum('deliveryOption', [
              'kurir',
              'grab',
              'expedisi',
              'free ongkir',
              'ambil sendiri',
            ]);
            $table->integer('deliveryPrice')->default(0);
            $table->unsignedBigInteger('customer_id')
                  ->foreign()
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');
            $table->date('pembayaran')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
