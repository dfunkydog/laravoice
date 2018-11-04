<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::whereBetween('paid_on', getMonth())
            ->get()
            ->sortByDesc('paid_on');

        return view('expenses', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeFields = ExpenseType::all();

        return view('expenses.create', compact('typeFields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $today = new Carbon();
        $eod = $today->endOfDay();
        $valid = request()->validate([
            'amount' => 'required',
            'description' => 'required | min:3',
            'type_id' => 'required',
            'paid_on' => 'before_or_equal:' . $eod,
        ]);

        $expense = array_merge(request()->all(), ['user_id' => auth()->user()->id]);

        Expense::create($expense);

        return redirect('/expenses/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response


     */
    public function edit(Expense $expense)
    {
        $typeFields = ExpenseType::all();

        return view('expenses.edit', compact(['typeFields', 'expense']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Expense $expense)
    {
        $expense->update(request()->all());

        return view('expenses/show', compact('expense'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect('expenses');
    }
}
