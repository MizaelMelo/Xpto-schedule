<?php

use Faker\Generator as Faker;

$factory->define(App\Schedules::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address' => $faker->address
    ];
});
