<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->firstName,
        'sobrenome' => $faker->lastName,
        'email' => $faker->email,
        'password' => '123456',
        'verified' => true,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Bid::class, function (Faker\Generator $faker) {
    return [
        'operation' => $faker->boolean($chanceOfGettingTrue = 50),
        'currency' => $faker->randomElement($array = ['USD', 'CAD', 'EUR', 'GBP']),
        'amount' => $faker->randomNumber($nbDigits = 3),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 10),
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'address' => $faker->state,
        'user_id' => $faker->numberBetween($min = 1, $max = 40)
    ];
});
