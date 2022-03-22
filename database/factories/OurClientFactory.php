<?php

$factory->define(App\OurClient::class, function (Faker\Generator $faker) {
    $data = [
        'image' => $faker->image,
    ];
});