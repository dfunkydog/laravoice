<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PeriodController extends Controller
{
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
        switch ($preset->preset) {
            case 'week':
                $start = Carbon::now()->subWeek();

                break;
            case 'year':
                $start = Carbon::now()->subYear();

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
