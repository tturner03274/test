<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PartsRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $partsRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($partsRequest)
    {
        $this->partsRequest = $partsRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Parts Request')->markdown('emails.parts_request.created');
    }
}
