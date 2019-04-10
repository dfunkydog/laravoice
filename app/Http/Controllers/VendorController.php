<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Expense;

class VendorController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->period = $request->session()->get('period') ?: getPeriod();

            return $next($request);
        });
    }

    /**
     * Display a listing of the expenses by vendor.
     * This is a rough draft to be updated when model complete.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Expense $expense, Request $request)
    {
        $vendors = $expense->vendors($request);
        $totalExpenses = $vendors->sum('total');

        return view('vendor', compact('vendors', 'totalExpenses'));
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
        $attributes = $request->validate(['name' => 'required']);

        return response(Vendor::create($attributes));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        $expenses = $vendor->getExpenses()
            ->sortBy('paid_on');

        return view('vendor.show', compact('vendor', 'expenses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
