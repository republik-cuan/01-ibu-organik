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
            $table->enum('status', [
              'order',
              'preorder',
              'verified'
            ])->default('order');
            $table->enum('bank', [
              'bni',
              'bri',
              'mandiri',
            ]);
            $table->string('accountNumber');
            $table->unsignedBigInteger('customer_id')
                  ->foreign()
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');
            $table->timestamps();
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
