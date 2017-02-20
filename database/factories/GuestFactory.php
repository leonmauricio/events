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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Guest::class, function (Faker\Generator $faker) {
    static $password;

    return [
    	'event_id' => mt_rand(1,10),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'invitation_id' => bcrypt(str_random(10)),
    ];
});
