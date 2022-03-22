<?php

$factory->define(App\Testimonial::class, function (Faker\Generator $faker) {
    $data = [
        'name' => $faker->word,
        'image' => $faker->image,
        'description' => $faker->name,
    ];
});