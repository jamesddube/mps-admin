<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id');
            $table->string('description');
            $table->integer('category_id')->unsigned();
            $table->integer('price',null,true);
            $table->string('image');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('category_id')
                  ->references('id')->on('product_category')
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
        Schema::table('products', function ($table) {
            $table->dropForeign(['category_id']);
        });
        
        Schema::drop('products');
    }
}
