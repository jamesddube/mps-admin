<?php

use Illuminate\Database\Seeder;

class CustomerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customer_status')->insert([
            'status'     => 'Active',
        ]);

        DB::table('customer_status')->insert([
            'status'     => 'Inactive',
        ]);

        DB::table('customer_status')->insert([
            'status'     => 'Blacklisted',
        ]);
    }
}
