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
        $categories = $expense->with('type')->groupBy('type_id')
        ->selectRaw('sum(amount) as total, type_id, count(id) as count')->get();

        $totalExpenses = $categories->sum('total');

        return view('dashboard', compact('categories', 'totalExpenses'));
    }
}
