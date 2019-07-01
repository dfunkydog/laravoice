<?php

namespace App\Jobs;

use App\Models\ScheduledExpense;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduledExpenseNotification;

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
        $current = ScheduledExpense::current()->with('expense')->get();
        $current->pluck('expense')->each(function ($item) {
            $item->scheduled();
        });
        event(new ScheduledExpensesProcessed($current));
        Mail::to(env('SCHEDULED_NOTIFICATION_RECIPIENT'))->cc(env('SCHEDULED_NOTIFICATION_CC'))->send(new ScheduledExpenseNotification($current));
        return $current;
    }
}
