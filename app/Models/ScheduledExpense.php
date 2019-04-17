<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduledExpense extends Model
{
    public $timestamps = false;
    protected $fillable = ['scheduled_day', 'parent_expense_id', 'end_date', 'schedule_pattern_id'];

    public function expense()
    {
        return $this->hasOne(Expense::class, 'id', 'parent_expense_id');
    }

    public function pattern()
    {
        return $this->hasOne(SchedulePattern::class, 'id', 'schedule_pattern_id');
    }

    public function scopeCurrent($query)
    {
        $today = new Carbon();

        return $query->where('scheduled_day', '=', $today->day)
            ->whereRaw('(scheduled_day = DAYOFMONTH(NOW()) AND schedule_pattern_id = 1)
                OR (scheduled_day = WEEKDAY(UTC_DATE)+1 AND schedule_pattern_id = 2)')
            ->where(function ($query) use ($today) {
                $query
                ->whereDate('end_date', '>=', $today)
                ->orWhere('end_date', null);
            });
    }

 /*   public function scopeCurrent($query)
    {
        $today = new Carbon();
        $results = DB::table('scheduled_expenses')
            ->join('schedule_patterns', 'schedule_pattern_id', 'schedule_patterns.id')
            ->join('expenses', 'parent_expense_id', 'expenses.id')
            ->join('vendors', 'expenses.vendor_id', 'vendors.id')
            ->select('scheduled_expenses.scheduled_day', 'schedule_patterns.pattern', 'expenses.description', 'expenses.amount', 'expenses.id', 'vendors.name')
            ->where(function ($query) use ($today) {
                $query
                ->whereDate('end_date', '>=', $today)
                ->orWhere('end_date', null);
            })
            ->whereRaw('scheduled_day = DAYOFMONTH(NOW()) OR scheduled_day = WEEKDAY(NOW())');
        return $results;
    } */

    public function list()
    {
        return $this->with(['expense', 'pattern'])->orderby('scheduled_day')->get();
    }
}
