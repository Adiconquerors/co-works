<?php

$factory->define(App\Venue::class, function (Faker\Generator $faker) {
    $data = [
        'manager_name' => $faker->name,
        'description' => $faker->name,
        'manager_email' => $faker->name,
        'manager_phone' => $faker->numberBetween(7000000000, 9999999999),
    ];
});