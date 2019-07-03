<?php

namespace App\Listeners;

use App\Events\ScheduledExpensesProcessed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduledExpenseNotification;
use App\User;

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
        $to = User::where('email', 'michael@416studios.co.uk')->first();
        $cc = User::where('email', 'hello@gocha.co.uk')->first();

        Mail::to($to)->cc($cc)->send(new ScheduledExpenseNotification($event->expenses));
    }
}
