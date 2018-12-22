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
