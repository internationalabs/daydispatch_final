<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyAllUsers extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct()
    public function __construct($mailData)
    {
        // Request Carrier Mail
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Listing Alert',
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
            view: 'emails.notifyAllUsers',
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
