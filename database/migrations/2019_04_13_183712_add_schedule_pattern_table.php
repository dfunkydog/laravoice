<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchedulePatternTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $patterns = array(
            ['pattern'=>'Monthly'],['pattern'=>'Weekly']
        );
        Schema::create('schedule_patterns', function(Blueprint $table){
            $table->increments('id');
            $table->string('pattern');
        });


        DB::table('schedule_patterns')->insert(
            $patterns
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedule_patterns');
    }
}
