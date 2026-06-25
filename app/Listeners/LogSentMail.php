<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Modules\EmailSetting\App\Models\SentMailLog;
use Modules\EmailSetting\App\Models\BusinessEmailAccount;

class LogSentMail
{
    public function handle(MessageSent $event): void
    {
        try {
            $message = $event->message;

            $from = collect($message->getFrom())
                ->map(fn($a) => $a->getAddress())
                ->first() ?? '';

            $to = collect($message->getTo())
                ->map(fn($a) => $a->getAddress())
                ->join(', ');

            $cc = collect($message->getCc())
                ->map(fn($a) => $a->getAddress())
                ->join(', ');

            // Try to match sender to a stored business account
            $account = BusinessEmailAccount::where('email', $from)->first();

            // Skip if this was already logged manually (e.g. compose flow)
            $alreadyLogged = SentMailLog::where('from_email', $from)
                ->where('to_email', $to)
                ->where('subject', $message->getSubject() ?? '')
                ->where('sent_at', '>=', now()->subSeconds(10))
                ->exists();

            if ($alreadyLogged) {
                return;
            }

            SentMailLog::create([
                'account_id' => $account?->id,
                'from_email' => $from,
                'to_email'   => $to,
                'cc'         => $cc ?: null,
                'subject'    => $message->getSubject() ?? '(no subject)',
                'body'       => $message->getHtmlBody() ?? $message->getTextBody() ?? '',
                'status'     => 'sent',
                'sent_at'    => now(),
            ]);
        } catch (\Throwable $e) {
            // Never let logging break the mail flow
        }
    }
}
