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
$factory->define(App\Event::class, function (Faker\Generator $faker) {
    static $password;

    return [
    	'user_id' => mt_rand(1,10),
        'name' => str_random(10),
        'desc' => str_random(20),
        'capacity' => mt_rand(10,50),
        'public' => mt_rand(0,1),
        'start_date' => '2017-02-05 15:00:00',
        'end_date' => '2017-02-05 15:01:00',
    ];
});
