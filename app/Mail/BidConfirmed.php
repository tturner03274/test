<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BidConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $bid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bid)
    {
        $this->bid = $bid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Delivery Confirmed')->markdown('emails.bid.confirmed');
    }
}
