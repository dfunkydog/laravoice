<?php

use App\Models\Expense;
use Faker\Generator as Faker;

$factory->define(App\Models\RecurringExpense::class, function (Faker $faker) {
    $start_date = $faker->dateTimeBetween('-1 months');
    $recurrence = $faker->randomElement(['monthly', 'weekly']);

    return [
        'day_of_month' => $faker->numberBetween(2, 20),
        'parent_expense_id' => factory(Expense::class)->create()->id,
        'end_date' => $faker->randomElement([$faker->dateTimeBetween('+1 year', '+2 years'), null]),
    ];
});
