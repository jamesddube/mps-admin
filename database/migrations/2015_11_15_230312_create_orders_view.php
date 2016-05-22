<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersView extends Migration
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
				CREATE VIEW `vw_orders` AS
				SELECT
			        `mps`.`orders`.`id` AS `id`,
			        `mps`.`orders`.`order_date` AS `date`,
			        `mps`.`customers`.`name` AS `customer`,
			        `mps`.`customers`.`vat_number` AS `vat_number`,
			        `mps`.`customers`.`address` AS `address`,
			        `mps`.`customers`.`city` AS `city`,
			        `mps`.`customers`.`telephone` AS `telephone`,
			        `mps`.`customers`.`fax` AS `fax`,
			        `mps`.`customers`.`email` AS `email`,
			        `mps`.`customers`.`contact_person` AS `contact_person`,
			        `mps`.`users`.`name` AS `sales_rep`,
			        `mps`.`order_status`.`status` AS `order_status`,
			        `mps`.`sync_status`.`status` AS `sync_status`,
			        sum(`vw_order_details`.`quantity`) AS `total_quantity`,
			        sum(`vw_order_details`.`total_price`) AS `total_price`
			    FROM
			        (((((`mps`.`orders`
			        JOIN `mps`.`users` ON ((`mps`.`orders`.`user_id` = `mps`.`users`.`id`)))
			        JOIN `mps`.`vw_order_details` ON ((`vw_order_details`.`order_id` = `mps`.`orders`.`id`)))
			        JOIN `mps`.`customers` ON ((`customers`.`id` = `mps`.`orders`.`customer_id`)))
			        JOIN `mps`.`order_status` ON ((`mps`.`order_status`.`id` = `mps`.`orders`.`order_status_id`)))
			        JOIN `mps`.`sync_status` ON ((`mps`.`sync_status`.`id` = `mps`.`orders`.`sync_id`)))
			    GROUP BY `mps`.`orders`.`id`
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
					DROP VIEW `vw_orders`
				"
		);
	}
}
