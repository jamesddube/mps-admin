<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = \App\Product::all();
        
        $warehouses = \App\Warehouse::all();
        
        foreach ($products as $product)
        {
            foreach ($warehouses as $warehouse)
            {
                DB::table('stocks')->insert([
                    'product_id' => $product->id,
                'warehouse_id' => $warehouse->id,
               'quantity' => 5000
                ]);
            }
        }
    }
}
