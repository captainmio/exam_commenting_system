<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'body' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'parent_id' => 10,
    ];
});
