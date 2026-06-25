<?php

namespace Modules\EmailSetting\App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ComposeEmail extends Mailable
{
    public function __construct(
        public string $mailSubject,
        public string $mailBody,
        public string $fromName,
        public string $fromAddress,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address($this->fromAddress, $this->fromName),
            subject: $this->mailSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: $this->mailBody,
        );
    }
}
