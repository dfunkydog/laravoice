<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Services\ExpenseServices;
use Utilities\Inspire;
use App\Models\SchedulePattern;
use App\Models\ScheduledExpense;

class ExpenseController extends Controller
{
    /**
     * Implementes ExpenseServices
     *
     * @var ExpenseServices
     */
    protected $expenses;

    public function __construct(Request $request, ExpenseServices $expenses)
    {
        $this->middleware(function ($request, $next) {
            $this->period = session('period') ?: getPeriod();

            return $next($request);
        });
        $this->expenses = $expenses;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = $this->expenses->getBetween($this->period);

        return view('expense', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $typeFields = ExpenseType::all();
        $scheduled_pattern = SchedulePattern::all();
        $vendors = Vendor::all();
        $descriptions = $this->expenses::getDescriptions();
        //Set previous page as url.intended. this will help us redirect
        // After storing new Expense
        $request->session()->put('url.toExpense', URL::previous());

        return view('expense.create', compact('typeFields', 'vendors', 'descriptions', 'scheduled_pattern'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Expense::validate();
        $vendorId = Vendor::firstOrCreate(['name' => request()->get('vendorName')])->id;
        $expense = array_merge(
            request()->all(),
            ['user_id' => auth()->user()->id, 'vendor_id' => $vendorId]
        );
        $expense_id = Expense::create($expense)->id;
        if (isset($expense['is_scheduled'])) {
            (new ScheduledExpense)->create([
                'end_date' => $expense['end_date'] ?? null,
                'schedule_pattern_id' => $expense['pattern'],
                'scheduled_day' => $this->defaultDay((int) $expense['pattern']),
                'description'=> $expense['description'], 
                'amount'=> $expense['amount'], 
                'vendor_id'=> $expense['vendor_id'], 
                'user_id'=> $expense['user_id'],
                'type_id'=> $expense['type_id'],
            ]);
        }

        return redirect(session()->pull('url.toExpense') ?? '/dashboard')->with('status', Inspire::quote());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('expense.show', compact('expense'));
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
        $descriptions = DB::table('expenses')->select('description')->distinct()->get();
        session()->put('url.toExpense', URL::previous());

        return view('expense.edit', compact('typeFields', 'expense', 'descriptions'));
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
        Expense::validate();
        $expenseValues = request()->all();
        $expenseValues['vendor_id'] = Vendor::firstOrCreate(['name' => $expenseValues['vendorName']])->id;
        $expense->update($expenseValues);

        return redirect(session()->pull('url.toExpense'))->with('status', Inspire::quote());
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

        return redirect()->route('expense.index');
    }

    public static function defaultDay(int $pattern)
    {
        $pattern_name = SchedulePattern::find($pattern);
        if ($pattern_name->pattern == 'Monthly') {
            return now()->day;
        } else {
            return now()->dayOfWeekIso;
        }
    }
}
