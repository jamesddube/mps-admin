<?php

use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('routes')->insert([
            'name'     => 'RUSAPE',
            'warehouse_id' => 1
        ]);

        DB::table('routes')->insert([
            'name'     => 'TOWN',
            'warehouse_id' => 2
        ]);

        DB::table('routes')->insert([
            'name'     => 'SALES DEPOT',
            'warehouse_id' => 3
        ]);

        DB::table('routes')->insert([
            'name'     => 'NYANGA',
            'warehouse_id' => 1
        ]);

        DB::table('routes')->insert([
            'name'     => 'CHIPINGE',
            'warehouse_id' => 1
        ]);
    }
}
