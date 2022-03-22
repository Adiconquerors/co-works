<?php

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->description,
    ];
});
