<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulePatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        $patterns = ['Monthly', 'Weekly'];
        foreach ($patterns as $pattern) {
            DB::table('schedule_patterns')->insert([
                'pattern'=>$pattern
            ]);
        }
    }
}
