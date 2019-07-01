<?php

namespace App\Listeners;

use App\Events\ScheduledExpensesProcessed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduledExpenseNotification;

class SendScheduledNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ScheduledExpensesProcessed  $event
     * @return void
     */
    public function handle(ScheduledExpensesProcessed $event)
    {
        Mail::to(env('SCHEDULED_NOTIFICATION_RECIPIENT')) ->cc(env('SCHEDULED_NOTIFICATION_CC'))->send(new ScheduledExpenseNotification($event->expenses));
    }
}
