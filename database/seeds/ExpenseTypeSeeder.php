<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $expense_types = [
            'Travel', 'Food', 'Misc', 'Utilities', 'Loans/Credit', 'Entertainment', 'Clothing', 'Rent', 'Savings', 'Household',
        ];
        foreach ($expense_types as $key => $type) {
            DB::table('expense_types')
                ->insert(['name' => $type]);
        }
    }
}
