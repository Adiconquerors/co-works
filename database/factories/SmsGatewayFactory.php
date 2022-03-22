<?php

$factory->define(App\SmsGateway::class, function (Faker\Generator $faker) {
    $data = [
        'name' => $faker->word,
        'key' => $faker->name,
        'description' => $faker->name,
    ];
});