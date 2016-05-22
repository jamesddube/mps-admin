<?php

use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customer_types')->insert([
            'type'     => 'Sole Trader',
        ]);

        DB::table('customer_types')->insert([
            'type'     => 'Retailer',
        ]);

        DB::table('customer_types')->insert([
            'type'     => 'Wholesaler',
        ]);
    }
}
