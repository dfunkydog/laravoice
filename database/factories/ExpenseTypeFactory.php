<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ExpenseType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
