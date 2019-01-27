<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Http\Request;

class Expense extends Model
{
    protected $fillable = ['vendor_id', 'description', 'amount', 'type_id', 'user_id', 'paid_on', 'is_recurring'];
    protected $with = ['type:id,name', 'vendor:id,name'];

    private function period(Request $request)
    {
        return $request->session()->get('period') ?: getPeriod();
    }

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

    /**
     * Get expenses grouped by vendors
     */
    public function vendors($request)
    {
        return $this->groupBy('vendor_id')
        ->selectRaw('sum(amount) as total,vendor_id,  count(id) as count')
        ->whereBetween('paid_on', $this->period($request))
        ->orderBy('total', 'desc')
        ->get()
        ->sortBy(function ($vendor) {
            return $vendor->vendor->name;
        });
    }
}
