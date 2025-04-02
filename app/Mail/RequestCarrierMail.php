<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestCarrierMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $mailData;
    public $order_ID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $order_ID)
    {
        // Request Carrier Mail
        $this->mailData = $mailData;
        $this->order_ID = $order_ID;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Broker Request For Listing | Day Dispatch | Order ID: '.$this->order_ID,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
