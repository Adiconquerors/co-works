<?php

$factory->define(App\PaymentGateway::class, function (Faker\Generator $faker) {
    $data = [
        'name' => $faker->word,
        'logo' => $faker->image,
        'description' => $faker->name,
    ];
});