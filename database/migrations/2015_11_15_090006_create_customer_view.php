<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement(
            "	CREATE VIEW `vw_customers` AS
				SELECT
                    `customers`.`id`,
			        `customers`.`name`,
			        `customers`.`vat_number`,
			        `customers`.`address`,
			        `customers`.`telephone`,
			        `customers`.`fax`,
			        `customers`.`email`,
			        `customers`.`contact_person`,
			        `customers`.`contact_position`,
			        `customers`.`contact_cell`,
              `customers`.`city`,
			        `customer_status`.`status` as `customer_status`,
			        `customer_types`.`type` as `customer_type`
                FROM
                    ((`customers`
                    join `customer_status` ON (`customers`.`customer_status_id` = `customer_status`.`id`))
                    join `customer_types` ON (`customers`.`customer_type_id` = `customer_types`.`id`))
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
				DROP VIEW `vw_customers`
			"
        );
    }
}
