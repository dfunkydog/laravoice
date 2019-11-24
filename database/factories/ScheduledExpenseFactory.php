<?php

use App\Models\ExpenseType;
use App\Models\Vendor;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\ScheduledExpense::class, function (Faker $faker) {
    $start_date = $faker->dateTimeBetween('-1 months');
    $pattern = $faker->numberBetween(1,2);
    return [
        'schedule_pattern_id' => $pattern,
        'scheduled_day' => $pattern == 1 ? $faker->numberBetween(2, 28) : $faker->numberBetween(1,7),
        'end_date' => $faker->randomElement([$faker->dateTimeBetween('+1 year', '+2 years'), null]),
        'description' => $faker->sentence,
        'amount' => $faker->numberBetween(1, 40),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'type_id' => function () {
            return factory(ExpenseType::class)->create()->id;
        },
        'vendor_id' => function () {
            return factory(Vendor::class)->create()->id;
        },
    ];
});
