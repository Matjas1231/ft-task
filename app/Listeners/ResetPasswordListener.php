<?php

namespace App\Listeners;

use App\Events\ResetPassword;
use App\Jobs\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResetPasswordListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ResetPassword $event): void
    {
        $mailAndToken = $event->mailAndToken;
        dispatch(new SendEmail('resetPassword', $mailAndToken));
    }
}
