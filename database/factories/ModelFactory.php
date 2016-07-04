<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'user_type_id'  =>  $faker->randomElement($array = [1, 2, 3])
    ];
});
$factory->define(App\Order::class, function (Faker\Generator $faker) {
    $c = \App\Customer::all('id');
    $id = $c[ rand(0, (count($c) - 1)) ]->id;
    return [
        "id"        => $faker->numerify('OD-########'),
        "customer_id"     => $id,
        "user_id"         => 2,
        "order_date"      =>date('Y-m-d'),
        "order_status_id" => $faker->randomElement($array = [1, 2, 3]),
        "sync_status"         => $faker->randomElement($array = [1, 2, 3]),
    ];
});

$factory->define(App\OrderDetail::class, function (Faker\Generator $faker) {
    $od = \App\Product::all('id');
    $pd = $od[ rand(0, (count($od) - 1)) ]->id;

    return
        [
            "order_id"   => null,
            "product_id" => $pd,
            "quantity"   => rand(100, 2000),
        ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return
        [
            "id"                 => ucfirst($faker->randomLetter).ucfirst($faker->randomLetter) . $faker->numerify('-######'),
            "name"               => $faker->company,
            "vat_number"         => $faker->randomNumber(5),
            "address"            => $faker->address,
            "city"               => $faker->city,
            "telephone"          => $faker->phoneNumber,
            "fax"                => $faker->phoneNumber,
            "email"              => $faker->companyEmail,
            "contact_person"     => $faker->name,
            "contact_position"   => $faker->randomElement(['Accountant','Finance Manager','HR Manager','Sales Manager','Software Developer','IT Manager','Engineer','Clerk']),
            "contact_cell"       => $faker->phoneNumber,
            "customer_status_id" => $faker->randomElement([1, 2, 3]),
            "customer_type_id"   => $faker->randomElement([1, 2, 3]),
            "geocode"			 => $faker->latitude.",".$faker->longitude
        ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $od = $faker->unique()->numerify('####');
    return
        [
            "id"          => $od,
            "Description" => $faker->randomElement(['Coke', 'Fanta', 'Sprite', 'Creme Soda']),
            "category_id" => rand(1,4),
            "price"       => rand(5, 20),
            "image"       => $faker->imageUrl(150, 150),
        ];
});
$factory->define(App\Stock::class, function (Faker\Generator $faker) {
    $c = \App\Product::all('id');
    $id = $c[ rand(0, (count($c) - 1)) ]->id;
    return [
        "id"        => $faker->numerify('OD-########'),
        "customer_id"     => $id,
        "user_id"         => 2,
        "order_date"      =>date('Y-m-d'),
        "order_status_id" => $faker->randomElement($array = [1, 2, 3]),
        "sync_status"         => $faker->randomElement($array = [1, 2, 3]),
    ];
});