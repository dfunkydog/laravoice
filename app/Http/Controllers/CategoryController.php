<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use App\Models\Expense;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $totalExpenses = number_format($categories->sum('total'), 2);

        return view('category', compact('categories', 'totalExpenses'));
    }

    public function show(ExpenseType $category)
    {
        $expenses = Expense::where('type_id', $category->id)
            ->whereBetween('paid_on', $this->period)
            ->get()
            ->reverse();

        return view('category.show', compact('category', 'expenses'));
    }

    public function create()
    {
        return 'TODO: create view';
    }
}
