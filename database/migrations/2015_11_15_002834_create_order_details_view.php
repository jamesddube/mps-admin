<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "	CREATE VIEW `vw_order_details` AS
				SELECT
                    `order_details`.`id`,
                    `order_details`.`order_id` as `order_id`,
                    `products`.`description`,
                    `products`.`price`,
                    `order_details`.`quantity`,
                    (`order_details`.`quantity` * `products`.`price`) as `total_price`
                FROM
                    (`order_details`
                    join `products` ON (`order_details`.`product_id` = `products`.`id`))
                group by `order_details`.`id`
                order by `order_details`.`id`
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
				DROP VIEW `vw_order_details`
			"
        );
    }
}
