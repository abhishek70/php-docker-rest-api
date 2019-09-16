<?php

/* @var $factory Factory */

use Illuminate\Database\Eloquent\Factory;
use Models\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {

    return [
        'name' 		=> $faker->name,
		'email'		=> $faker->email,
		'message'	=> $faker->text
    ];
});
