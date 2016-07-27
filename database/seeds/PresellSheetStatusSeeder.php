<?php

/**
 * Created by PhpStorm.
 * User: rick
 * Date: 7/20/16
 * Time: 11:05 AM
 */
class PresellSheetStatusSeeder extends \Illuminate\Database\Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('presell_sheet_status')->insert([
            'status'     => 'open',
        ]);

        DB::table('presell_sheet_status')->insert([
            'status'     => 'closed',
        ]);

        DB::table('presell_sheet_status')->insert([
            'status'     => 'archived',
        ]);
        

    }
}