<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemodelSchedeuledExpense extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scheduled_expenses', function (Blueprint $table) {
            $table->text('description');
            $table->decimal('amount');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('vendor_id');
            $table->dropForeign('recurring_expenses_parent_expense_id_foreign');
        });
        
        DB::statement('UPDATE scheduled_expenses AS s
        JOIN (SELECT  id, user_id, description, amount, vendor_id, type_id FROM expenses ) AS e
        ON	s.parent_expense_id = e.id
        SET s.description = e.description,
            s.amount = e.amount,
            s.user_id = e.user_id,
            s.type_id = e.type_id,
            s.vendor_id = e.vendor_id'
        );

        Schema::table('scheduled_expenses', function (Blueprint $table) {
                $table->dropColumn('parent_expense_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scheduled_expenses', function (Blueprint $table) {
            $table->dropColumn(['description', 'amount', 'user_id', 'vendor_id', 'type_id',]);
            $table->unsignedInteger('parent_expense_id');;
        });
    }
}
