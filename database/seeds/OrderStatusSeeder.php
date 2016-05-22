<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('order_status')->insert([
            'status'     => 'draft',
        ]);

        DB::table('order_status')->insert([
            'status'     => 'saved',
        ]);

        DB::table('order_status')->insert([
            'status'     => 'processed',
        ]);
    }
}
