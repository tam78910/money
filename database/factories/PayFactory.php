<?php

use Faker\Generator as Faker;

$factory->define(\App\Pay::class, function (Faker $faker) {
    return [
        'user_id' => function () use($faker) {
            return $faker->randomElement(\App\User::pluck("id")->toArray());
        },
        'kind_id' => function () use($faker) {
            return $faker->randomElement(\App\Kind::pluck("id")->toArray());
        },
        'description' => $faker->word(20),

    ];
});
