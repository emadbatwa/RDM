<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Ticket;
use App\user;
use App\Status;
use App\Classification;

$factory->define(Ticket::class, function (Faker $faker) {
    $u = User::where('role_id', '=', 1)->get()->random(1);
    return [
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
         'user_id' => $u[0]->id,
         'status_id' => rand(1, 7),
         'classification_id' => 1,
         'location_id' => function () {
             return factory(App\Location::class)->create()->id;
         },
    ];
});
