<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RecurringExpense extends Model
{
    public $timestamps = false;
    protected $fillable = ['day_of_month', 'parent_expense_id', 'end_date'];

    public function expense()
    {
        return $this->hasOne(Expense::class, 'id', 'parent_expense_id');
    }

    public function scopeCurrent($query)
    {
        $today = new Carbon();

        return $query->where('day_of_month', '=', $today->day)
            ->where(function ($query) use ($today) {
                $query
                ->whereDate('end_date', '>=', $today)
                ->orWhere('end_date', null);
            });
    }

    public function list()
    {
        return $this->with('expense')->orderby('day_of_month')->get();
    }
}
