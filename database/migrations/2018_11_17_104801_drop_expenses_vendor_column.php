<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropExpensesVendorColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('vendor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('vendor')->nullable();
        });
        DB::statement(
            'UPDATE expenses
            LEFT JOIN vendors ON expenses.vendor_id = vendors.id
            SET expenses.vendor = vendors.name
            WHERE expenses.vendor_id = vendors.id'
            );
    }
}
