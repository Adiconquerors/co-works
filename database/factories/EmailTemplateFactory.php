<?php

$factory->define(App\EmailTemplate::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "key" => $faker->name,
        "type" => collect(["enum(&#039;Content&#039;","&#039;Header&#039;","&#039;Footer&#039;)",])->random(),
        "subject" => $faker->name,
        "from_email" => $faker->name,
        "from_name" => $faker->name,
        "content" => $faker->name,
        "status" => $faker->name,
    ];
});
