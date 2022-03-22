<?php

$factory->define(App\Property::class, function (Faker\Generator $faker) {
    $data = [
        'slug' => $faker->md5(),
        'name' => $faker->word,
        'cotact_person_name' => $faker->name,
        'phone_number' => $faker->randomInt(10),
        'email' => $faker->name,
        'alter_email' => $faker->name,
        'property_manager_name' => $faker->name,
        'property_manager_email' => $faker->name,
        'property_manager_number' => $faker->randomInt(10),
        'account_number' => $faker->randomInt(10),
        'pan_no' => $faker->randomInt(10),
    ];
});