<?php

namespace Modules\EmailSetting\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Modules\EmailSetting\App\Models\SentMailLog;
use Modules\EmailSetting\App\Models\BusinessEmailAccount;
use Modules\EmailSetting\App\Mail\ComposeEmail;

class MailboxController extends Controller
{
    public function index(Request $request)
    {
        $accounts = BusinessEmailAccount::withCount('logs')->latest()->get();

        $query = SentMailLog::with('account')->latest('sent_at');

        if ($request->filled('account') && $request->account !== 'all') {
            $query->where('account_id', $request->account);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('to_email', 'like', "%{$search}%")
                  ->orWhere('from_email', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(20)->withQueryString();

        $stats = [
            'total'  => SentMailLog::count(),
            'sent'   => SentMailLog::sent()->count(),
            'failed' => SentMailLog::failed()->count(),
        ];

        return view('emailsetting::mailbox', compact('logs', 'accounts', 'stats'));
    }

    public function show($id)
    {
        $log = SentMailLog::with('account')->findOrFail($id);
        return response()->json([
            'id'         => $log->id,
            'from'       => $log->from_email,
            'to'         => $log->to_email,
            'cc'         => $log->cc,
            'subject'    => $log->subject,
            'body'       => $log->body,
            'status'     => $log->status,
            'sent_at'    => $log->sent_at?->format('d M Y, h:i A'),
            'account'    => $log->account?->name,
        ]);
    }

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
            // Dynamically register this account as a named mailer
            $mailerKey = "mail.mailers.biz_{$account->id}";
            config([$mailerKey => $account->mailerConfig()]);

            $mailer = Mail::mailer("biz_{$account->id}");

            $mailable = new ComposeEmail(
                $request->subject,
                $request->body,
                $account->name,
                $account->email
            );

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

    public function destroy($id)
    {
        SentMailLog::findOrFail($id)->delete();
        return redirect()->back()
            ->with(['message' => trans('Mail log deleted'), 'alert-type' => 'success']);
    }
}
