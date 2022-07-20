<?php

namespace App\Listener;

use App\paymentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\paymetDetail;

class paymentDetails
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  paymentCreated  $event
     * @return void
     */
    public function handle(paymentCreated $event)
    {
        // dD($event);
        $paymentDetails = $event->paymentDetails;
        $paymentAccountDetail = $event->paymentAccountDetail;
        // dd($event , $paymentDetails , $paymentAccountDetail);

        Mail::to($paymentAccountDetail->email)->send(new paymetDetail($paymentAccountDetail , $paymentDetails));
    }
}
