<?php

use App\Models\Expense;
use Faker\Generator as Faker;

$factory->define(App\Models\ScheduledExpense::class, function (Faker $faker) {
    $start_date = $faker->dateTimeBetween('-1 months');
    $pattern = $faker->numberBetween(1,2);
    return [
        'schedule_pattern_id' => $pattern,
        'scheduled_day' => $pattern == 1 ? $faker->numberBetween(2, 28) : $faker->numberBetween(1,7),
        'parent_expense_id' => factory(Expense::class)->create()->id,
        'end_date' => $faker->randomElement([$faker->dateTimeBetween('+1 year', '+2 years'), null]),
    ];
});
