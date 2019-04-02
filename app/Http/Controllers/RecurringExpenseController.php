<?php

namespace App\Http\Controllers;

use App\Models\RecurringExpense;
use Illuminate\Http\Request;

class RecurringExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items =  RecurringExpense::with('expense')->orderBy('day_of_month')->get();

        return view('recurring', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'parent_expense_id' => 'integer',
            'day_of_month' => 'integer|min:1|max:31',
        ]);
        $recur = RecurringExpense::create($request->all());

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function show(RecurringExpense $recurringExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(RecurringExpense $recurringExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecurringExpense $recurringExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecurringExpense  $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecurringExpense $recurringExpense)
    {
        //
    }
}
