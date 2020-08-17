<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Client as Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
