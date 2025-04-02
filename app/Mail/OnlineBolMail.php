<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OnlineBolMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $images;

    public function __construct($data)
    {
        $this->data = $data;
        $this->images = $images;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Online BOL Submission',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.online_bol',
            with: [
                'data' => $this->data,
            ],
        );
    }

    public function attachments()
    {
        $attachments = [];
        foreach ($this->images as $image) {
            $attachments[] = public_path($image); // Use public_path() for files in the public directory
        }
        return $attachments;
    }
}