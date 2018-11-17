<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the expenses by vendor.
     * This is a rough draft to be updated when model complete.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Expense $expense)
    {
        $vendors = $expense->groupBy('vendor')
        ->selectRaw('sum(amount) as total, vendor, count(id) as count')
        ->orderBy('total', 'desc')
        ->get();
        $vendors = DB::table('expenses')
        ->selectRaw('DISTINCT vendor')->get()->pluck('vendor');
        dd($vendors);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
