<?php

namespace Modules\Task\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Task\App\Models\Task;
use Modules\EmailSetting\App\Models\BusinessEmailAccount;
use Modules\EmailSetting\App\Mail\ComposeEmail;

class SendMeetingReminders extends Command
{
    protected $signature   = 'task:send-meeting-reminders';
    protected $description = 'Send email reminders for upcoming scheduled task meetings';

    public function handle(): void
    {
        $account = BusinessEmailAccount::active()->where('is_default', true)->first()
                ?? BusinessEmailAccount::active()->first();

        if (!$account) {
            return;
        }

        $adminEmails = DB::table('admins')->pluck('email')->toArray();
        if (empty($adminEmails)) {
            return;
        }

        // Pre-meeting reminder: meeting is still upcoming and within the notify window
        $preReminders = Task::whereNotNull('meeting_at')
            ->whereNotIn('status', ['done', 'trash'])
            ->whereNull('reminder_sent_at')
            ->where('meeting_at', '>', now())
            ->whereRaw('meeting_at <= DATE_ADD(NOW(), INTERVAL notify_before_minutes MINUTE)')
            ->get();

        foreach ($preReminders as $task) {
            $minutesLeft = (int) now()->diffInMinutes($task->meeting_at);
            $subject = "Reminder: {$task->title} — meeting in {$minutesLeft} min";
            $body    = $this->buildReminderBody($task, $minutesLeft);
            $this->sendToAdmins($account, $adminEmails, $subject, $body);
            $task->update(['reminder_sent_at' => now()]);
        }

        // At-meeting notification: meeting time has just passed (within last 2 min)
        $nowNotifications = Task::whereNotNull('meeting_at')
            ->whereNotIn('status', ['done', 'trash'])
            ->whereNull('meeting_notified_at')
            ->where('meeting_at', '<=', now())
            ->where('meeting_at', '>=', now()->subMinutes(2))
            ->get();

        foreach ($nowNotifications as $task) {
            $subject = "Meeting Now: {$task->title}";
            $body    = $this->buildNowBody($task);
            $this->sendToAdmins($account, $adminEmails, $subject, $body);
            $task->update(['meeting_notified_at' => now()]);
        }
    }

    private function sendToAdmins(BusinessEmailAccount $account, array $emails, string $subject, string $body): void
    {
        try {
            config(["mail.mailers.task_reminder_{$account->id}" => $account->mailerConfig()]);
            $mailer   = Mail::mailer("task_reminder_{$account->id}");
            $mailable = new ComposeEmail($subject, $body, $account->name, $account->email);

            foreach ($emails as $email) {
                $mailer->to($email)->send($mailable);
            }
        } catch (\Throwable $e) {
            $this->error("Failed to send meeting reminder: " . $e->getMessage());
        }
    }

    private function buildReminderBody(Task $task, int $minutesLeft): string
    {
        $meetingTime = $task->meeting_at->format('D, d M Y \a\t h:i A');
        $priority    = strtoupper($task->priority);
        $tags        = implode(', ', $task->tags_list) ?: '—';
        $desc        = nl2br(e($task->description ?? ''));

        return <<<HTML
<div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;">
  <div style="background:#4f46e5;padding:24px 32px;border-radius:8px 8px 0 0;">
    <h2 style="color:#fff;margin:0;font-size:20px;">⏰ Meeting Reminder — {$minutesLeft} minutes to go</h2>
  </div>
  <div style="background:#fff;padding:32px;border:1px solid #e5e7eb;border-top:none;border-radius:0 0 8px 8px;">
    <h3 style="margin:0 0 4px;font-size:18px;color:#111827;">{$task->title}</h3>
    <p style="margin:0 0 20px;color:#6b7280;font-size:14px;">Scheduled for <strong>{$meetingTime}</strong></p>
    <table style="width:100%;border-collapse:collapse;margin-bottom:20px;">
      <tr><td style="padding:8px 0;color:#6b7280;width:40%;">Priority</td><td style="padding:8px 0;font-weight:600;">{$priority}</td></tr>
      <tr><td style="padding:8px 0;color:#6b7280;">Tags</td><td style="padding:8px 0;">{$tags}</td></tr>
    </table>
    {$desc}
    <p style="margin-top:24px;color:#6b7280;font-size:13px;">— CreativLab Task System</p>
  </div>
</div>
HTML;
    }

    private function buildNowBody(Task $task): string
    {
        $meetingTime = $task->meeting_at->format('D, d M Y \a\t h:i A');
        $desc        = nl2br(e($task->description ?? ''));

        return <<<HTML
<div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;">
  <div style="background:#ef4444;padding:24px 32px;border-radius:8px 8px 0 0;">
    <h2 style="color:#fff;margin:0;font-size:20px;">🔔 Meeting Starting Now</h2>
  </div>
  <div style="background:#fff;padding:32px;border:1px solid #e5e7eb;border-top:none;border-radius:0 0 8px 8px;">
    <h3 style="margin:0 0 4px;font-size:18px;color:#111827;">{$task->title}</h3>
    <p style="margin:0 0 20px;color:#6b7280;font-size:14px;">Scheduled for <strong>{$meetingTime}</strong></p>
    {$desc}
    <p style="margin-top:24px;color:#6b7280;font-size:13px;">— CreativLab Task System</p>
  </div>
</div>
HTML;
    }
}
