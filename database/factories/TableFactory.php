<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Table;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class)->create(),
        'identify' => Str::random(5) . uniqid(),
        'description' => $faker->sentence,
    ];
});
