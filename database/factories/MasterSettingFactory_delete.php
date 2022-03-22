<?php

$factory->define(App\MasterSetting::class, function (Faker\Generator $faker) {
    return [
        "module" => $faker->name,
        "slug" => $faker->name,
        "key" => $faker->name,
        "description" => $faker->name,
        "settings_data" => $faker->name,
        "moduletype" => $faker->name,
        "status" => collect(["enum(&#039;Active&#039;","&#039;Inactive&#039;)",])->random(),
    ];
});
