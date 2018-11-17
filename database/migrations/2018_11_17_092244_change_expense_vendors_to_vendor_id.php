<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeExpenseVendorsToVendorId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
        'UPDATE expenses
        LEFT JOIN vendors ON expenses.vendor = vendors.name
        SET expenses.vendor_id = vendors.id
        WHERE expenses.vendor = vendors.name'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->update(['vendor_id' => 0]);
        });
    }
}
