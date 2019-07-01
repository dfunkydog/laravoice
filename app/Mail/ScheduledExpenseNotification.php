<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScheduledExpenseNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $expenses;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($expenses)
    {
      $this->expenses = $expenses;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.scheduled', ['expenses'=>$this->expenses]);
    }
}
