<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_category')->insert([
            'name'     => '300',
        ]);

        DB::table('product_category')->insert([
            'name'     => '330',
        ]);

        DB::table('product_category')->insert([
            'name'     => '500',
        ]);

        DB::table('product_category')->insert([
            'name'     => '1000',
        ]);

        DB::table('product_category')->insert([
            'name'     => '2000',
        ]);
    }
}
