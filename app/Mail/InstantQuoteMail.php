<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InstantQuoteMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $Year_Make_Model;
    public $Select_Vehicle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Year_Make_Model, $Select_Vehicle)
    {
        // Request Carrier Mail
        $this->Year_Make_Model = $Year_Make_Model;
        $this->Select_Vehicle = $Select_Vehicle;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Instant Quote Mail',
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
            view: 'emails.InstantQuote',
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
