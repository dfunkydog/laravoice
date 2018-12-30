<?php

use Faker\Generator as Faker;
use App\User;
use App\Models\ExpenseType;
use App\Models\Vendor;

$factory->define(App\Models\Expense::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'amount' => $faker->numberBetween(1, 40),
        'paid_on' => $faker->dateTimeBetween('-4 months'),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'type_id' => function () {
            return factory(ExpenseType::class)->create()->id;
        },
        'vendor_id' => function () {
            return factory(Vendor::class)->create();
        },
    ];
});
