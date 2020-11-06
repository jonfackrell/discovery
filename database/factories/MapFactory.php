<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;


$factory->define(\Jonfackrell\Maps\Models\Library::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(\Jonfackrell\Maps\Models\Floor::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
    ];
});

$factory->define(\Jonfackrell\Maps\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
    ];
});

$factory->define(\Jonfackrell\Maps\Models\Amenity::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'image' => $faker->imageUrl(40, 40),
    ];
});

$factory->define(\Jonfackrell\Maps\Models\Location::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'x' => $faker->randomFloat(1, 0, 1),
        'y' => $faker->randomFloat(1, 0, 1),
    ];
});
