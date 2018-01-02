<?php

use Faker\Generator as Faker;
use App\BuildTime;

$factory->define(BuildTime::class, function (Faker $faker) {
    return [
        'building_id' => 0,
        'level' => 1,
        'build_time' => '00:00:02'
    ];
});
