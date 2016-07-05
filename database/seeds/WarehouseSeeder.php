<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('warehouses')->insert([
            'name'     => 'RUSAPE',
           
        ]);

        DB::table('warehouses')->insert([
            'name'     => 'HEAD OFFICE',
        ]);

        DB::table('warehouses')->insert([
            'name'     => 'SALES DEPOT',
        ]);

        
    }
}
