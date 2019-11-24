<?php

namespace App\Jobs;

use App\Models\ScheduledExpense;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Events\ScheduledExpensesProcessed;

class ProcessScheduledExpenses implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $current = ScheduledExpense::current()->get();
        if ($current->count() === 0) {
            return $current;
        }
        $current->each(function ($item) {
            $item->processScheduled();
        });
        event(new ScheduledExpensesProcessed($current));

        return $current;
    }
}
