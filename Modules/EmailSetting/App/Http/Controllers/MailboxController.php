<?php

namespace Modules\EmailSetting\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Modules\EmailSetting\App\Models\SentMailLog;
use Modules\EmailSetting\App\Models\ReceivedMailLog;
use Modules\EmailSetting\App\Models\BusinessEmailAccount;
use Modules\EmailSetting\App\Mail\ComposeEmail;

class MailboxController extends Controller
{
    // ─── Sent Mail ───────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        try {
            $accounts = BusinessEmailAccount::withCount('logs')->latest()->get();
        } catch (\Throwable $e) {
            $accounts = collect();
        }

        try {
            $inboxUnread = ReceivedMailLog::unread()->count();
        } catch (\Throwable $e) {
            $inboxUnread = 0;
        }

        try {
            $query = SentMailLog::with('account')->latest('sent_at');

            if ($request->filled('account') && $request->account !== 'all') {
                $query->where('account_id', $request->account);
            }
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            if ($request->filled('search')) {
                $s = $request->search;
                $query->where(function ($q) use ($s) {
                    $q->where('subject', 'like', "%{$s}%")
                      ->orWhere('to_email', 'like', "%{$s}%")
                      ->orWhere('from_email', 'like', "%{$s}%");
                });
            }

            $logs  = $query->paginate(20)->withQueryString();
            $stats = [
                'total'  => SentMailLog::count(),
                'sent'   => SentMailLog::sent()->count(),
                'failed' => SentMailLog::failed()->count(),
            ];
        } catch (\Throwable $e) {
            $logs  = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
            $stats = ['total' => 0, 'sent' => 0, 'failed' => 0];
        }

        return view('emailsetting::mailbox', compact('logs', 'accounts', 'stats', 'inboxUnread')
            + ['viewMode' => 'sent']);
    }

    public function show($id)
    {
        $log = SentMailLog::with('account')->findOrFail($id);
        return response()->json([
            'id'      => $log->id,
            'from'    => $log->from_email,
            'to'      => $log->to_email,
            'cc'      => $log->cc,
            'subject' => $log->subject,
            'body'    => $log->body,
            'status'  => $log->status,
            'sent_at' => $log->sent_at?->format('d M Y, h:i A'),
            'account' => $log->account?->name,
        ]);
    }

    public function destroy($id)
    {
        SentMailLog::findOrFail($id)->delete();
        return redirect()->back()
            ->with(['message' => trans('Mail log deleted'), 'alert-type' => 'success']);
    }

    // ─── Inbox (Received via IMAP) ───────────────────────────────────────────

    public function inbox(Request $request)
    {
        try {
            $accounts = BusinessEmailAccount::withCount('logs')->latest()->get();
        } catch (\Throwable $e) {
            $accounts = collect();
        }

        try {
            $inboxUnread = ReceivedMailLog::unread()->count();
        } catch (\Throwable $e) {
            $inboxUnread = 0;
        }

        try {
            $query = ReceivedMailLog::with('account')->latest('received_at');

            if ($request->filled('account') && $request->account !== 'all') {
                $query->where('account_id', $request->account);
            }
            if ($request->filled('status')) {
                if ($request->status === 'unread') $query->unread();
                if ($request->status === 'read')   $query->where('is_read', true);
            }
            if ($request->filled('search')) {
                $s = $request->search;
                $query->where(function ($q) use ($s) {
                    $q->where('subject', 'like', "%{$s}%")
                      ->orWhere('from_email', 'like', "%{$s}%")
                      ->orWhere('from_name', 'like', "%{$s}%");
                });
            }

            $receivedLogs = $query->paginate(20)->withQueryString();
            $inboxStats   = [
                'total'  => ReceivedMailLog::count(),
                'unread' => ReceivedMailLog::unread()->count(),
                'read'   => ReceivedMailLog::where('is_read', true)->count(),
            ];
        } catch (\Throwable $e) {
            $receivedLogs = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
            $inboxStats   = ['total' => 0, 'unread' => 0, 'read' => 0];
        }

        return view('emailsetting::mailbox', compact('receivedLogs', 'accounts', 'inboxStats', 'inboxUnread')
            + ['viewMode' => 'inbox', 'logs' => collect(), 'stats' => []]);
    }

    public function showReceived($id)
    {
        $log = ReceivedMailLog::with('account')->findOrFail($id);

        // Auto mark as read
        if (!$log->is_read) {
            $log->update(['is_read' => true]);
        }

        return response()->json([
            'id'          => $log->id,
            'from'        => $log->from_email,
            'from_name'   => $log->from_name,
            'to'          => $log->to_email,
            'subject'     => $log->subject,
            'body'        => $log->body,
            'received_at' => $log->received_at?->format('d M Y, h:i A'),
            'account'     => $log->account?->name,
            'is_read'     => $log->is_read,
        ]);
    }

    public function destroyReceived($id)
    {
        ReceivedMailLog::findOrFail($id)->delete();
        return redirect()->back()
            ->with(['message' => trans('Email deleted'), 'alert-type' => 'success']);
    }

    // ─── Fetch inbox from IMAP server ────────────────────────────────────────

    public function fetchInbox(Request $request)
    {
        if (!extension_loaded('imap')) {
            return redirect()->back()->with([
                'message'    => 'PHP IMAP extension is not enabled. Enable extension=imap in php.ini.',
                'alert-type' => 'error',
            ]);
        }

        $accountId = $request->input('account_id');
        $query     = BusinessEmailAccount::active()->whereNotNull('imap_host')->where('imap_host', '!=', '');
        if ($accountId) {
            $query->where('id', $accountId);
        }
        $accounts = $query->get();

        if ($accounts->isEmpty()) {
            return redirect()->route('admin.mailbox.inbox')
                ->with(['message' => 'No accounts with IMAP configured.', 'alert-type' => 'error']);
        }

        $fetched = 0;
        $errors  = [];

        foreach ($accounts as $account) {
            try {
                $connection = @imap_open(
                    $account->imapConnectionString(),
                    $account->smtp_username,
                    $account->smtp_password,
                    0, 1
                );

                if (!$connection) {
                    $errors[] = $account->name . ': ' . (imap_last_error() ?: 'Connection failed');
                    continue;
                }

                $numMessages = imap_num_msg($connection);
                $start       = max(1, $numMessages - 99); // fetch last 100

                for ($i = $start; $i <= $numMessages; $i++) {
                    $uid = imap_uid($connection, $i);

                    if (ReceivedMailLog::where('account_id', $account->id)->where('message_uid', $uid)->exists()) {
                        continue;
                    }

                    $header    = @imap_headerinfo($connection, $i);
                    $structure = @imap_fetchstructure($connection, $i);

                    if (!$header) continue;

                    $fromEmail = isset($header->from[0])
                        ? ($header->from[0]->mailbox . '@' . ($header->from[0]->host ?? ''))
                        : '';
                    $fromName = isset($header->from[0]->personal)
                        ? imap_utf8($header->from[0]->personal)
                        : $fromEmail;
                    $subject = isset($header->subject)
                        ? imap_utf8($header->subject)
                        : '(No Subject)';

                    $body = $structure ? $this->extractBody($connection, $i, $structure) : '';

                    $receivedAt = null;
                    if (isset($header->date)) {
                        try { $receivedAt = \Carbon\Carbon::parse($header->date); } catch (\Throwable $e) {}
                    }

                    ReceivedMailLog::create([
                        'account_id'   => $account->id,
                        'message_uid'  => $uid,
                        'from_email'   => $fromEmail,
                        'from_name'    => $fromName,
                        'to_email'     => $account->email,
                        'subject'      => $subject,
                        'body_preview' => Str::limit(strip_tags($body), 200),
                        'body'         => $body,
                        'received_at'  => $receivedAt,
                    ]);
                    $fetched++;
                }

                imap_close($connection);
            } catch (\Throwable $e) {
                $errors[] = $account->name . ': ' . $e->getMessage();
            }
        }

        $msg = "Fetched {$fetched} new email(s).";
        if ($errors) {
            $msg .= ' Errors: ' . implode('; ', $errors);
        }

        return redirect()->route('admin.mailbox.inbox')
            ->with(['message' => $msg, 'alert-type' => $errors && !$fetched ? 'error' : 'success']);
    }

    // ─── Compose / Send ──────────────────────────────────────────────────────

    public function compose(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:business_email_accounts,id',
            'to'         => 'required|email',
            'cc'         => 'nullable|email',
            'subject'    => 'required|string|max:255',
            'body'       => 'required|string',
        ]);

        $account = BusinessEmailAccount::findOrFail($request->account_id);

        $logData = [
            'account_id' => $account->id,
            'from_email' => $account->email,
            'to_email'   => $request->to,
            'cc'         => $request->input('cc') ?: null,
            'subject'    => $request->subject,
            'body'       => $request->body,
            'sent_at'    => now(),
        ];

        try {
            $mailerKey = "mail.mailers.biz_{$account->id}";
            config([$mailerKey => $account->mailerConfig()]);

            $mailer   = Mail::mailer("biz_{$account->id}");
            $mailable = new ComposeEmail($request->subject, $request->body, $account->name, $account->email);

            $send = $mailer->to($request->to);
            if ($request->filled('cc')) {
                $send->cc($request->cc);
            }
            $send->send($mailable);

            $logData['status'] = 'sent';
            SentMailLog::create($logData);

            return redirect()->route('admin.mailbox.index')
                ->with(['message' => trans('Email sent successfully'), 'alert-type' => 'success']);

        } catch (\Throwable $e) {
            $logData['status']        = 'failed';
            $logData['error_message'] = $e->getMessage();
            SentMailLog::create($logData);

            return redirect()->back()->withInput()
                ->with(['message' => trans('Failed to send: ') . $e->getMessage(), 'alert-type' => 'error']);
        }
    }

    // ─── IMAP body helpers ───────────────────────────────────────────────────

    private function extractBody($connection, int $msgNum, object $structure): string
    {
        // Simple (non-multipart) message
        if (!isset($structure->parts)) {
            $body = @imap_fetchbody($connection, $msgNum, '1');
            return $this->decodeBody($body ?? '', $structure->encoding ?? 0, $structure->subtype ?? 'PLAIN');
        }

        // Multipart: prefer HTML, fall back to PLAIN
        $html  = null;
        $plain = null;

        foreach ($structure->parts as $partIndex => $part) {
            $partNum = (string) ($partIndex + 1);
            $subtype = strtoupper($part->subtype ?? '');

            if ($subtype === 'HTML' && $html === null) {
                $raw  = @imap_fetchbody($connection, $msgNum, $partNum);
                $html = $this->decodeBody($raw ?? '', $part->encoding ?? 0, 'HTML');
            } elseif ($subtype === 'PLAIN' && $plain === null) {
                $raw   = @imap_fetchbody($connection, $msgNum, $partNum);
                $plain = $this->decodeBody($raw ?? '', $part->encoding ?? 0, 'PLAIN');
            }

            // Handle nested multipart (e.g. multipart/alternative inside multipart/mixed)
            if (isset($part->parts)) {
                foreach ($part->parts as $subIndex => $subPart) {
                    $subNum    = $partNum . '.' . ($subIndex + 1);
                    $subType   = strtoupper($subPart->subtype ?? '');

                    if ($subType === 'HTML' && $html === null) {
                        $raw  = @imap_fetchbody($connection, $msgNum, $subNum);
                        $html = $this->decodeBody($raw ?? '', $subPart->encoding ?? 0, 'HTML');
                    } elseif ($subType === 'PLAIN' && $plain === null) {
                        $raw   = @imap_fetchbody($connection, $msgNum, $subNum);
                        $plain = $this->decodeBody($raw ?? '', $subPart->encoding ?? 0, 'PLAIN');
                    }
                }
            }
        }

        if ($html !== null) return $html;
        if ($plain !== null) return nl2br(e($plain));

        return '';
    }

    private function decodeBody(string $body, int $encoding, string $subtype): string
    {
        $decoded = match ($encoding) {
            1 => imap_8bit($body),
            2 => imap_binary($body),
            3 => base64_decode($body),
            4 => quoted_printable_decode($body),
            default => $body,
        };

        if (strtoupper($subtype) === 'PLAIN') {
            return nl2br(e($decoded));
        }

        return $decoded;
    }
}
