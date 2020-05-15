<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Location;
use App\Neighborhood;
use App\City;

$factory->define(Location::class, function (Faker $faker) {
    $n = Neighborhood::where('City_id', '=', 6)->get()->random(1);
    $latitude = $faker->latitude($min = '21.3', $max = '21.5');
    $longitude = $faker->longitude($min = '39.7', $max = '39.9');
   


    return [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'city_id' => 6,
        'neighborhood_id' => $n[0]->id,
    ];
});
