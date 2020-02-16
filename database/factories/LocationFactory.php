<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Location;
use App\Neighborhood;
use App\City;

$factory->define(Location::class, function (Faker $faker) {
    $c = City::all()->random(1);
    $n = Neighborhood::where('City_id', '=', $c[0]->id)->get()->random(1);
    $latitude = $faker->latitude;
    $longitude = $faker->longitude;

    return [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'city_id' => $c[0]->id,
        'neighborhood_id' => $n[0]->id,
    ];
});
