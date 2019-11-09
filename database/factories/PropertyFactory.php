<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(\App\Property::class, function (Faker $faker) {
    return [
        'title' => $faker->words(3, true),
        'category' => array_rand(['real estate', 'automobile', 'electronics']),
        'price' => $faker->randomNumber(3),
        'pricing_frequency' => array_rand(['daily', 'weekly', 'monthly', 'yearly']),
        'description' => $faker->paragraph(3),
        'features' => $faker->words(5),
    ];
});
