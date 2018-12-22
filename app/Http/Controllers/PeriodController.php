<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PeriodController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->period = session('period') ?: getPeriod();

            return $next($request);
        });
    }

    public function setPeriod(string $preset)
    {
        $end = Carbon::now();
        $start = Carbon::now()->subWeek();
        $preset->session()->put('period', [$start, $end]);

        return $preset->session()->get('period');
    }

    public function preset(Request $preset)
    {
        $end = Carbon::now();
        switch ($preset->preset) {
            case '7days':
                $start = Carbon::now()->subWeek();

                break;
            case '1mth':
                $start = Carbon::now()->subMonth();

                break;
            case '3mths':
                $start = Carbon::now()->subMonths(3);

                break;
            case '1year':
                $start = Carbon::now()->subYear();

                break;
            case 'week':
                $start = Carbon::now()->startOfWeek();

                break;
            case 'month':
                $start = Carbon::now()->startOfMonth();

                break;
            case 'year':
                $start = Carbon::now()->startOfYear();

                break;
            default:
                $start = Carbon::now()->startOfMonth();

                break;
        }
        $preset->session()->put('period', [$start, $end]);

        $preset->flash('message', 'Date range updated');

        return redirect('/');
    }
}
