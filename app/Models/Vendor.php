<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Vendor extends Model
{
    /**
     * These attributes are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * No need for timestamps on this model
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Get expenses associated with this vendor
     *
     * @return Collection
     */
    public function getExpenses(): Collection
    {
        $period = session('period') ?: getPeriod();
        $expenses = Expense::where('vendor_id', $this->id)->whereBetween('paid_on', $period)->get();

        return $expenses;
    }
}
