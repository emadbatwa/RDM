<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Ticket;
use App\Photo;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'photo_path' => $faker->imageUrl($width = 640, $height = 480),
        'photo_name' => $faker->word . '.jpg',
        'ticket_id' => function () {
        return factory(App\Ticket::class)->create()->id;
    },
    ];
});
