<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Location;
use App\Neighborhood;
use App\City;

$factory->define(Location::class, function (Faker $faker) {
    $n = Neighborhood::all()->random(1);
    $c = City::all()->random(1);

    return [
        'location_url' => $faker->url,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'neighborhood_id' =>$n[0]->id,
        'city_id' => $c[0]->id,
    ];
});
