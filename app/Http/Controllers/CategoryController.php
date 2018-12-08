<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use App\Models\Expense;

class CategoryController extends Controller
{
    public function show(ExpenseType $category)
    {
        $expenses = Expense::where('type_id', $category->id)
            ->whereBetween('paid_on', getMonth())
            ->get()
            ->reverse();

        return view('category.show', compact('category', 'expenses'));
    }

    public function create()
    {
        return 'TODO: create view';
    }
}
