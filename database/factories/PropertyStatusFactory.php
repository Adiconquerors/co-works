<?php

$factory->define(App\PropertyStatus::class, function (Faker\Generator $faker) {
    $data = [
        'name' => $faker->word,
        'description' => $faker->name,
    ];
    return $data;
});