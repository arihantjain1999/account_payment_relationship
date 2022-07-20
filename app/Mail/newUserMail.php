<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public  $data;
    public function __construct($data)
    {
        // dd($data);
        $this->data['name'] = $data['name'];
        $this->data['email'] = $data['email'];
        $this->data['phone'] = $data['phone'];
        $this->data['payment_pending'] = $data['payment_pending'];
        $this->data['status'] = $data['status'];
        $this->data['payment_pending'] = $data['payment_pending'];
        $this->data['payment_recived'] = $data['payment_recived'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->data);
        return $this->markdown('email.mail')->with(
         ['data' => $this->data]
        );
    }
}
