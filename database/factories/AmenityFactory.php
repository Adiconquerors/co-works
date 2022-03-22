<?php

$factory->define(App\Amenity::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->description,
        "icon_id" => factory('App\Icon')->create(),
    ];
});
