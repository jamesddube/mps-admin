<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id');
            $table->integer('warehouse_id')->unsigned();
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('warehouse_id')
                ->references('id')->on('warehouses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function ($table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['warehouse_id']);
        });

        Schema::drop('stocks');
    }
}
