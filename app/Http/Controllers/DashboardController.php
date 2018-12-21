<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->period = session('period') ?: getPeriod();

            return $next($request);
        });
    }

    /**
     * Index
     */
    public function index(Expense $expense)
    {
        $categories = Expense::join('expense_types as type', 'type.id', '=', 'expenses.type_id')
        ->selectRaw('sum(amount) as total, type_id, count(description) as count')
            ->whereBetween('paid_on', $this->period)
            ->groupBy('type_id')
            ->orderBy('name')
            ->get();
        $totalExpenses = $categories->sum('total');

        return view('dashboard', compact('categories', 'totalExpenses'));
    }
}
