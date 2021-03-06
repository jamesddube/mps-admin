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
       /* $host = env('DB_HOST', 'localhost');
        $user = env('DB_USERNAME', 'root');
        $pass = env('DB_PASSWORD', '2301');


        $db = new \PDO("mysql:host=$host","$user","$pass");

        $db->query('drop schema mps');
        $db->query('create schema mps');*/

        //$this->all(1,5,5);
        $this->call(SyncStatusSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(CustomerStatusSeeder::class);
        $this->call(CustomerTypeSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(PresellSheetStatusSeeder::class);
        $this->call(RouteSeeder::class);
      

//        dd(factory(App\OrderDetail::class, 2)->make());
        
       
        echo "seeding customers...\n";
        factory(App\Customer::class, 100)->create();
        echo "seeding users...\n";
        factory(App\User::class, 2)->create();
        echo "seeding presell sheets...\n";
        factory(App\PresellSheet::class,5)->create();
        echo "seeding products...\n";
        factory(App\Product::class, 50)->create();
        echo "seeding orders...\n";
        factory(App\Order::class, 6)->make()
            ->each(function($o){
                
                $o->save();
               // dd($o);
                $o->lineItems()->saveMany([
                    factory(\App\OrderDetail::class)->make(),
                    factory(\App\OrderDetail::class)->make(),
                    factory(\App\OrderDetail::class)->make(),
                    factory(\App\OrderDetail::class)->make(),
                    factory(\App\OrderDetail::class)->make(),
                    factory(\App\OrderDetail::class)->make(),
                ]);
            });
        

        //factory(App\Product::class, 5000)->create();
        $this->call(StockSeeder::class);
        
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
        $user->route_id = 1;

        $user->save();

        Model::reguard();

    }
}
