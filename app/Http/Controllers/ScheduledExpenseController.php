<?php

namespace App\Http\Controllers;

use App\Models\ScheduledExpense;
use Illuminate\Http\Request;

class ScheduledExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ScheduledExpense::current()->get();
        return view('scheduled', compact('items'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $items = (new ScheduledExpense)->list();
        return view('scheduled', compact('items'));
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
            'scheduled_day' => 'integer|min:1|max:31',
            'schedule_pattern_id' => 'integer',
        ]);
        $scheduled = ScheduledExpense::create($request->all());

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ScheduledExpense  $scheduledExpense
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduledExpense $scheduledExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScheduledExpense  $scheduledExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduledExpense $scheduledExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduledExpense  $scheduledExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduledExpense $scheduledExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScheduledExpense  $scheduledExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduledExpense $scheduledExpense)
    {
        //
    }
}
