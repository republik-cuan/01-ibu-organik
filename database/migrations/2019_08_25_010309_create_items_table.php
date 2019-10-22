<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('modal');
            $table->float('reseller');
            $table->float('endUser');
            $table->integer('stock');
            $table->integer('sold')->default(0);
            $table->enum('berat', [
              'satuan',
              'gram',
              'kilogram',
            ]);
            $table->enum('satuan', [
              'satuan',
              'gram',
            ]);
            $table->unsignedBigInteger('category_id')
                  ->foreign()
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('supplier_id')
                  ->foreign()
                  ->references('id')
                  ->on('suppliers')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('items');
    }
}
