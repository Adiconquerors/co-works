<?php

$factory->define(App\ContactHost::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->name,
        "subject" => $faker->name,
        "message" => $faker->description,
        "property_id" => factory('App\Property')->create(),
    ];
});
