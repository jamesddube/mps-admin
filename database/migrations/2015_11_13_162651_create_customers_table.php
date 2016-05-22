<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('customers', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->integer('vat_number')->nullable();
            $table->string('address');
            $table->string('telephone',20);
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('city');
            $table->string('contact_person');
            $table->string('contact_position');
            $table->string('contact_cell');
            $table->integer('customer_status_id')->unsigned();
            $table->integer('customer_type_id')->unsigned();
            $table->string('geocode');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('customer_status_id')
                ->references('id')->on('customer_status')
                ->onUpdate('cascade');
            $table->foreign('customer_type_id')
                ->references('id')->on('customer_types')
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
        //
        Schema::drop('customers');
    }
}
