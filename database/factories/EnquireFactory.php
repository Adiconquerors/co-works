<?php

$factory->define(App\Enquire::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->name,
        "phone_number" => $faker->randomNumber(10),
        "address" => $faker->name,
        "company" => $faker->name,
        "sub_space_type_id" => factory('App\SpaceType')->create(),
        "property_id" => factory('App\Property')->create(),
        "description" => $faker->name,
        "enquire_date" => $faker->date("d-m-Y", $max = 'now'),
        "otp" => $faker->randomNumber(6),
        "enquire_month" => $faker->randomNumber(2),
        "enquire_from" => $faker->name,
        "flag_color" => $faker->name,
        "comments" => $faker->name,
        "update_status" => collect(["enum(&#039;Requirement Received&#039;","&#039;Options Sent&#039;)","&#039;Visit Scheduled&#039;)","&#039;Booking Initiated&#039;)","&#039;Deal Completed&#039;)",])->random(),
        "progress" => $faker->randomNumber(10),
        "deal_lost" => $faker->name,
        "deal_comments" => $faker->name,
    ];
});
