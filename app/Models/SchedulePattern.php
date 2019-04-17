<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchedulePattern extends Model
{
    /**
     * These attributes are mass assignable
     *
     * @var array
     */
    protected $fillable = ['pattern'];

    /**
     * No need for timestamps on this model
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Get expenses associated with this pattern
     *
     * @return Collection
     */
    public function getExpenses(): Collection
    {
        $period = session('period') ?: getPeriod();
        $expenses = ScheduledExpense::where('schedule_pattern_id', $this->id)->whereBetween('paid_on', $period)->get();

        return $expenses;
    }
}
