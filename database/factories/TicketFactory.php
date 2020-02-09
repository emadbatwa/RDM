<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Ticket;
use App\user;
use App\Status;
use App\Classification;

$factory->define(Ticket::class, function (Faker $faker) {
    $u = User::all()->random(1);
    $s = Status::all()->random(1);
    $c = Classification::all()->random(1);
    return [
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
         'user_id' => $u[0]->id,
         'status_id' => $s[0]->id,
         'classification_id' => $c[0]->id,
         'location_id' => function () {
             return factory(App\Location::class)->create()->id;
         },
    ];
});
