<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {

            $table->increments('id');
            $table->string('order_id');
            $table->string('product_id');
            $table->integer('quantity');
            $table->timestamp('deleted_at');
            $table->timestamps();
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')
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
        Schema::table('order_details', function ($table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['order_id']);
        });
        Schema::drop('order_details');
    }
}
