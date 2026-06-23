<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientProjectInvoice extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $mail_subject;
    public string $mail_message;

    public function __construct(string $mail_message, string $mail_subject)
    {
        $this->mail_message = $mail_message;
        $this->mail_subject = $mail_subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mail_subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.order_success_mail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
