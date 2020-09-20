<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tenant;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'title' => $faker->unique()->name,
        'description' => $faker->sentence,
        'image' => $faker->sentence . '.png',
        'price' => 12.9,

    ];
});
