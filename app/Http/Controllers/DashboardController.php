<?php

namespace App\Http\Controllers;

use App\Models\Expense;

class DashboardController extends Controller
{
    /**
     * Index
     */
    public function index(Expense $expense)
    {
        $categories = Expense::join('expense_types as type', 'type.id', '=', 'expenses.type_id')
        ->selectRaw('sum(amount) as total, type_id, count(description) as count')
            ->whereBetween('paid_on', getMonth())
            ->groupBy('type_id')
            ->orderBy('name')
            ->get();
        $totalExpenses = $categories->sum('total');

        return view('dashboard', compact('categories', 'totalExpenses'));
    }
}
