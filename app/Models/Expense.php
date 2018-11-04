<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Expense extends Model
{
    protected $fillable = ['vendor', 'description', 'amount', 'type_id', 'user_id', 'paid_on', ];
    protected $with = ['type:id,name'];

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
}
