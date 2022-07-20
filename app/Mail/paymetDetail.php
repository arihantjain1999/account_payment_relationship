<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class paymetDetail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data ; 

    public function __construct($accountdata , $paymentData)
    {
        $this->data['Payment_subject'] = $paymentData['subject'];
        $this->data['payment_date'] = $paymentData['payment_date'];
        $this->data['payment_pending'] = $paymentData['payment_pending'];
        $this->data['payment_recived'] = $paymentData['payment_recived'];
        $this->data['pending_amount'] = $paymentData['pending_amount'];
        $this->data['Account_name'] = $accountdata['name'];
        $this->data['phone'] = $accountdata['phone'];
        $this->data['status'] = $accountdata['status'];
        $this->data['all_payment_pending'] = $accountdata['payment_pending'];
        $this->data['all_payment_recived'] = $accountdata['payment_recived'];
        // dd($paymentData , $accountdata , $this->data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.paymentmail')->with(['data' => $this->data]) ;
    }
}
