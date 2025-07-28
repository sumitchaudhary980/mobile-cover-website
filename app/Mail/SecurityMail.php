<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SecurityMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🚨 Critical Security Alert: Password Changed',
            replyTo: [
                'no-reply@gmail.com'  // Use your no-reply email address
            ]
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.passwordchanged',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
