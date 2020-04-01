<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    return [
        'name'          => $faker->company,
        'description'   => $faker->paragraph,
        'price'         => $faker->randomFloat(2, 4, 9999),
        'image'         => $faker->imageUrl()
    ];
});

