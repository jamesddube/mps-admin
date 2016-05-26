<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE VIEW `vw_users` AS
                 select 
                      u.id,
                      u.name,
                      u.surname,
                      u.email,
                      u.gender,
                      u.avatar,
                      ut.name as user_type
                from users u 
                inner join user_types ut on u.user_type_id = ut.id
            "
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(
            "
                DROP VIEW `vw_users`
            "
        );
    }
}
