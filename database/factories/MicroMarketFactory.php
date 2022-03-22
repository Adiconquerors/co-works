<?php

$factory->define(App\MicroMarket::class, function (Faker\Generator $faker) {
    $data = [
        'name' => $faker->word,
        'description' => $faker->name,
    ];
});