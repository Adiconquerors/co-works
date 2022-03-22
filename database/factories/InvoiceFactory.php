<?php

$factory->define(App\Invoice::class, function (Faker\Generator $faker) {
    return [
    	"property_id" => factory('App\Property')->create(),
        "action" => $faker->name,
        "no_of_seats" => $faker->randomNumber(100),
        "company_address" => $faker->name,
        "amount" => $faker->randomFloat(2, 1, 100),
        "gstin" => $faker->randomFloat(2, 1, 100),
        "total_amount" => $faker->randomFloat(2, 1, 100),
        "description" => $faker->name,
        "customer_name" => $faker->name,
        "customer_email" => $faker->name,
        "customer_mobile" => $faker->randomNumber(10),
        "booking_months" => $faker->randomNumber(10),
        "paymentstatus" => collect(["enum(&#039;paid&#039;","&#039;unpaid&#039;)","&#039;partially paid&#039;)",])->random(),
    ];
});
