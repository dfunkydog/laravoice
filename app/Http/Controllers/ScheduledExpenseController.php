<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use App\Models\ScheduledExpense;
use App\Models\SchedulePattern;
use App\Models\Vendor;
use App\Services\ExpenseServices;
use Illuminate\Http\Request;
use Utilities\Inspire;

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
    public function create(Request $request)
    {
        //Set previous page as url.intended. this will help us redirect
        // After storing new Expense
        $request->session()->put('url.toExpense', URL::previous());

        return view('scheduled.create', self::formVariables());
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
            'end_date' => 'nullable|date'
        ]);

        $vendorId = Vendor::firstOrCreate(['name' => request()->get('vendorName')])->id;
        $scheduledExpense = array_merge(
            request()->all(),
            ['user_id' => auth()->user()->id, 'vendor_id' => $vendorId]
        );
        $scheduled = (new ScheduledExpense)->create($scheduledExpense);

        return redirect(session()->pull('url.toExpense') ?? '/scheduled/list')->with('status', Inspire::quote());
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
    public function edit(ScheduledExpense $scheduled)
    {
        return view(
            'scheduled.edit',
            array_merge( self::formVariables(), ['scheduled' => $scheduled])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduledExpense  $scheduledExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduledExpense $scheduled)
    {
        $scheduled = $scheduled->update($request->all());

        return redirect(session()->pull('url.toExpense') ?? '/scheduled/list')->with('status', Inspire::quote());
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

    /**
     * Variable needed to populate edit/create forms
     *
     * @return array
     */
    protected static function formVariables()
    {
        $typeFields = ExpenseType::all();
        $patterns = SchedulePattern::all();
        $vendors = Vendor::all();
        $descriptions = ExpenseServices::getDescriptions();

        return compact(['descriptions', 'typeFields', 'patterns', 'vendors']);
    }
}
