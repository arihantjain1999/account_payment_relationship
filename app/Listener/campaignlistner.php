<?php

namespace App\Listener;

use App\campaignevent;
use App\Mail\campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class campaignlistner
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
     * @param  campaignevent  $event
     * @return void
     */
    public function handle(campaignevent $event)
    {
        Mail::to($event->campaignEmail)->send(new campaign($event->emailbody));
    }
}
