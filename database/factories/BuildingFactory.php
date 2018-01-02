<?php

use Faker\Generator as Faker;
use App\Building;

$factory->define(Building::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
