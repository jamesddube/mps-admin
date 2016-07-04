<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id');
            $table->string('customer_id');
            $table->integer('user_id')->unsigned();
            $table->integer('order_status_id')->unsigned();;
            $table->boolean('sync_status');
            $table->timestamp('order_date');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('order_status_id')
                ->references('id')->on('order_status')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
