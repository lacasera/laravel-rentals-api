<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Property;
use Faker\Generator as Faker;

$factory->define(\App\Image::class, function (Faker $faker) {
    return [
        'public_id' => $faker->randomAscii,
        'url' => $faker->imageUrl()
    ];
});
