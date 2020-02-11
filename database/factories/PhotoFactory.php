<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Photo;

$factory->define(Photo::class, function (Faker $faker) {

    return [
        'photo_path' => 'http://127.0.0.1:8000/storage/photos/5e411f70ee3561581326192.jpeg',
        'photo_name' => '5e411f70ee3561581326192.jpeg',
        'role_id' => 1,
        'ticket_id' => function () {
        return factory(App\Ticket::class)->create()->id;
    },
    ];
});
