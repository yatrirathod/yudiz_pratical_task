<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'quantity' => $faker->numberBetween(1,5),
        'price'  => $faker->numberBetween(10000,100000),
        'status' => 'active'
    ];
});
