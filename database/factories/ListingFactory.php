<?php

$factory->define(App\Listing::class, function (Faker\Generator $faker) {
    return [
        "property_name" => $faker->name,
        "description" => $faker->name,
        "landmark" => $faker->name,
        "address" => $faker->name,
        "capacity" => $faker->name,
    ];
});
