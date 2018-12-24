<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PeriodController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->period = session('period') ? : getPeriod();

            return $next($request);
        });
    }

    public function index()
    {
        return view('period');
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
        $period_label = 'this month';
        switch ($preset->preset) {
            case '7days':
                $start = Carbon::now()->subWeek();
                $period_label = 'the last 7 days';
                break;
            case '1mth':
                $start = Carbon::now()->subMonth();
                $period_label = 'the last 30 days';

                break;
            case '3mths':
                $start = Carbon::now()->subMonths(3);
                $period_label = 'the last 90 days';

                break;
            case '1year':
                $start = Carbon::now()->subYear();
                $period_label = 'the last year';

                break;
            case 'week':
                $start = Carbon::now()->startOfWeek();
                $period_label = 'this week';

                break;
            case 'month':
                $start = Carbon::now()->startOfMonth();
                $period_label = 'this month';

                break;
            case 'year':
                $start = Carbon::now()->startOfYear();
                $period_label = 'this year';

                break;
            default:
                $start = Carbon::now()->startOfMonth();
                $period_label = 'this month';

                break;
        }
        $preset->session()->put('period', [$start, $end]);
        $preset->session()->put('period_label', $period_label);
        $preset->flash('message', 'Date range updated');

        return redirect('/');
    }
}
