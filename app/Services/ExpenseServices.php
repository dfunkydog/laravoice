<?php
namespace App\Services;

use App\Models\Expense;

class ExpenseServices
{
    public function getBetween(array $period)
    {
        return Expense::whereBetween('paid_on', $period)
            ->get()
            ->sortByDesc('paid_on');
    }

    public function getDescriptions()
    {
        return Expenses::distinct('description')->get();
    }
}
