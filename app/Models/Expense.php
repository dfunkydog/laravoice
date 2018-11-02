<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['vendor', 'description', 'amount', 'type_id'];
    protected $with = ['type:id,name'];

    /**
     * Get the user associated with this expense
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get type associated with this expense
     */
    public function type()
    {
        return $this->hasOne('App\Models\ExpenseType', 'id', 'type_id');
    }
}
