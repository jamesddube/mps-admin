<?php

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Model::unguard();

        $db = new \PDO('mysql:host=localhost','root','sead2301');

        $db->query('drop schema mps');
        $db->query('create schema mps');
        Artisan::call('migrate');

        //$this->all(1,5,5);
        $this->call(SyncStatusSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(CustomerStatusSeeder::class);
        $this->call(CustomerTypeSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(ProductCategorySeeder::class);

//        dd(factory(App\OrderDetail::class, 2)->make());

        factory(App\Customer::class, 3)->create();
        factory(App\User::class, 5)->create();
        factory(App\Product::class, 10)->create();
        factory(App\Order::class, 30)->make()
            ->each(function($o){
                $id = $o->id;
                $o->save();
                $o = \App\Order::find($id);
                $o->lineItems()->save(factory(\App\OrderDetail::class)->make());
            });

        //factory(App\Product::class, 5000)->create();
        $this->call('OauthClientSeeder');
        $this->call('OauthUserSeeder');

        $user = new User();

        $user->email = 'info@mps.com';
        $user->password = bcrypt('password');
        $user->name = 'James';
        $user->surname = 'Dube';
        $user->gender = 'Male';
        $user->job_title = 'Administrator';
        $user->user_type_id = 1;

        $user->save();

        Model::reguard();

    }
}
