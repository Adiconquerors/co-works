<?php

$factory->define(App\ArticleTag::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "is_popular" => collect(["enum(&#039;No&#039;","&#039;Yes&#039;)",])->random(),
    ];
});
