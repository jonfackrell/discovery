<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Modules\Stackmaps\Models\Map::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl(),
        'thumbnail' => $faker->imageUrl(),
    ];
});
