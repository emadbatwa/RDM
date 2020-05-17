<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Faker\Factory as Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $faker = Factory::create('ar_SA');
    gc_collect_cycles();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'role_id' => 1,
        'phone' => '05' . $faker->unique()->randomNumber($nbDigits = 8),
        'company' => null,
    ];
});
