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
            ->groupBy('type_id')
            ->orderBy('name')
            ->get();
        $totalExpenses = $categories->sum('total');

        return view('dashboard', compact('categories', 'totalExpenses'));
    }
}
/* $products = Shop\Product::join('shop_products_options as po', 'po.product_id', '=', 'products.id')
   ->orderBy('po.pinned', 'desc')
   ->select('products.*')       // just to avoid fetching anything from joined table
   ->with('options'); */
