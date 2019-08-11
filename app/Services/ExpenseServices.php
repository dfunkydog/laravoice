<?php

namespace App\Services;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;

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
        return DB::table('expenses')->selectRaw('DISTINCT description')->get();
    }
}
