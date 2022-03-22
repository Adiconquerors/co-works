<?php

$factory->define(App\MembershipFee::class, function (Faker\Generator $faker) {
    return [
        "people" => $faker->name,
        "title" => $faker->name,
        "duration" => $faker->randomNumber(2),
        "price" => $faker->randomNumber(2),
    ];
});
