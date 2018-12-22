<?php

namespace App\Http\Controllers;

class Summary extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->period = session('period') ?: getPeriod();

            return $next($request);
        });
    }

    /**
     * Show monthly summary page
     */
    public function month()
    {
        //
    }

    /**
     * Show summary category
     */
    public function category()
    {
        //
    }

    public function vendor()
    {
        //
    }
}
