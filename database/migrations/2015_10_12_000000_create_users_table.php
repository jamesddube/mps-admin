<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('gender');
            $table->string('job_title');
            $table->string('email')->unique();
            $table->string('avatar',255);
            $table->string('password', 60);
            $table->integer('user_type_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->timestamp('deleted_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('user_type_id')
                ->references('id')->on('user_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('route_id')
                ->references('id')->on('routes')
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
        Schema::table('users', function ($table) {
            $table->dropForeign(['route_id']);
            $table->dropForeign(['user_type_id']);
        });

        Schema::drop('users');
    }
}
