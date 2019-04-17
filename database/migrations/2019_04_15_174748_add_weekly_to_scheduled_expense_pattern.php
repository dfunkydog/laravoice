<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeeklyToScheduledExpensePattern extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scheduled_expenses', function (Blueprint $table) {
            $table->renameColumn('day_of_month', 'scheduled_day');
            $table->unsignedInteger('schedule_pattern_id')->default(1);
            $table->foreign('schedule_pattern_id')->references('id')->on('schedule_patterns');
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
            $table->dropForeign(['schedule_pattern_id']);
            $table->dropColumn('schedule_pattern_id');
            $table->renameColumn('scheduled_day','day_of_month');
        });
    }
}
