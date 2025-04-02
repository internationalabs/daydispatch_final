<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PickupOnlineBolMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // This will hold the data including images

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Pickup Online BOL Submission',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.pickup_online_bol',
            with: [
                'data' => $this->data,
            ],
        );
    }

    public function attachments()
    {
        // $attachments = [];
        // foreach ($this->data['images'] as $image) {
        //     $attachments[] = public_path($image); // Convert relative path to full path
        // }
        // return $attachments;
        return [];
    }
}
