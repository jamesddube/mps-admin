<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            "
             CREATE OR REPLACE VIEW vw_users AS
                  SELECT
                    `u`.`id`      AS `id`,
                    `u`.`name`    AS `name`,
                    `u`.`surname` AS `surname`,
                    `u`.`email`   AS `email`,
                    `u`.`gender`  AS `gender`,
                    `u`.`avatar`  AS `avatar`,
                    `ut`.`name`   AS `user_type`
                  FROM (`mps`.`users` `u`
                    JOIN `mps`.`user_types` `ut` ON ((`u`.`user_type_id` = `ut`.`id`))) 
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
        DB::statement (
            'DROP view vw_users'
        );
    }
}
