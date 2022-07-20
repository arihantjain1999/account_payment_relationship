<?php

namespace App\Listeners;

use App\Events\sendPaymentDetailMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendMail
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
     * @param  sendPaymentDetailMail  $event
     * @return void
     */
    public function handle(sendPaymentDetailMail $event)
    {
        //
    }
}
