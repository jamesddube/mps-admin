<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresellSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(/**
         * @param Blueprint $table
         */
            'presell_sheets', function (Blueprint $table) {
            $table->string('id');
            $table->integer('route_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('status_id')
                ->references('id')->on('presell_sheet_status')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('route_id')
                ->references('id')->on('routes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presell_sheets', function ($table) {
            $table->dropForeign(['status_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['route_id']);
        });

        Schema::drop('presell_sheets');
    }
}
