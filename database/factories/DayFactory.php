<?php

$factory->define(App\Day::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->description,
    ];
});
