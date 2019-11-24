<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduledExpense extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'scheduled_day', 'schedule_pattern_id', 'user_id', 'end_date',
        'description', 'amount', 'vendor_id', 'type_id', 
        ];

    /**
     * Get the user associated with this expense
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get type associated with this expense
     */
    public function type()
    {
        return $this->hasOne('App\Models\ExpenseType', 'id', 'type_id');
    }

    /**
     * Get the vendor associated with this expense
     */
    public function vendor()
    {
        return $this->hasOne('App\Models\Vendor', 'id', 'vendor_id');
    }

    public function pattern()
    {
        return $this->hasOne(SchedulePattern::class, 'id', 'schedule_pattern_id');
    }

    public function scopeCurrent($query)
    {
        $today = new Carbon();

        return $query->whereRaw('(scheduled_day = DAYOFMONTH(UTC_DATE) AND schedule_pattern_id = 1)
                OR (scheduled_day = WEEKDAY(UTC_DATE)+1 AND schedule_pattern_id = 2)')
            ->where(function ($query) use ($today) {
                $query
                ->whereDate('end_date', '>=', $today)
                ->orWhere('end_date', null);
            });
    }

    public function list()
    {
        return $this->with(['vendor', 'type', 'pattern'])->orderby('scheduled_day')->get();
    }

    
}
