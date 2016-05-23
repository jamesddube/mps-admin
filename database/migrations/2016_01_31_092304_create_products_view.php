<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE VIEW `vw_products` AS
                  SELECT
                    `mps`.`products`.`id` AS `id`,
                    `mps`.`products`.`description`,
                    `mps`.`product_category`.`name` AS `category`,
                    `mps`.`products`.`price`,
                    `mps`.`products`.`image`
                  FROM
                    (`mps`.`products`
                      JOIN `mps`.`product_category` ON ((`mps`.`products`.`category_id` = `mps`.`product_category`.`id`)))
                  GROUP BY `mps`.`products`.`id`
                  ORDER BY `mps`.`products`.`id`
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
					DROP VIEW `vw_products`
				"
        );
    }
}
