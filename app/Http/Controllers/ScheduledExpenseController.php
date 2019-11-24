<?php

namespace App\Http\Controllers;

use App\Models\ScheduledExpense;
use App\Models\Vendor;
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
            'scheduled_day' => 'integer|min:1|max:31',
            'schedule_pattern_id' => 'integer',
            'amount' => 'required',
            'description' => 'required | min:3',
            'type_id' => 'required | integer',
            'vendorName' => 'required',
        ]);

        $vendorId = Vendor::firstOrCreate(['name' => request()->get('vendorName')])->id;
        $scheduledExpense = array_merge(
            request()->all(),
            ['user_id' => auth()->user()->id, 'vendor_id' => $vendorId]
        );
        $scheduled = (new ScheduledExpense)->create($scheduledExpense);

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
