<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Faker\Factory as Factory;
use App\Ticket;
use App\user;
use App\Status;
use App\Classification;
use App\DamageDegree;

$factory->define(Ticket::class, function (Faker $faker) {
    $u = User::where('role_id', '=', 1)->get()->random(1);
    $class = Classification::get()->random(1);
    $degree = DamageDegree::get()->random(1);
    $faker = Factory::create('ar_SA');
    gc_collect_cycles();

    $description = 'تتصنف الحفرة ضمن نطاق الحفر ';
    $description .= $degree[0]->degree_ar;
    $description .= ' الضرر من نوع ';
    $description .= $class[0]->classification_ar;

    return [
        'description' => $description ,
         'user_id' => $u[0]->id,
         'status_id' => rand(1, 7),
         'classification_id' => rand(1, 10),
         'location_id' => function () {
             return factory(App\Location::class)->create()->id;
         },
    ];
});
