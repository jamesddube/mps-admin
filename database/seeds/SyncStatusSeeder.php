<?php

use Illuminate\Database\Seeder;

class SyncStatusSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//
		DB::table('sync_status')->insert([
			'status' => 'unprocessed',
		]);

		DB::table('sync_status')->insert([
			'status' => 'processed',
		]);

		DB::table('sync_status')->insert([
			'status' => 'partial',
		]);
	}

}
