<?php

namespace Modules\Task\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Task\App\Models\Task;
use Modules\EmailSetting\App\Models\BusinessEmailAccount;
use Modules\EmailSetting\App\Models\EmailTemplate;
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

        // Pre-meeting reminder: meeting is still upcoming and inside the notify window
        $preReminders = Task::whereNotNull('meeting_at')
            ->whereNotIn('status', ['done', 'trash'])
            ->whereNull('reminder_sent_at')
            ->where('meeting_at', '>', now())
            ->whereRaw('meeting_at <= DATE_ADD(NOW(), INTERVAL notify_before_minutes MINUTE)')
            ->get();

        $reminderTemplate = EmailTemplate::find(12);

        foreach ($preReminders as $task) {
            if (!$reminderTemplate) {
                continue;
            }

            $minutesLeft = (int) now()->diffInMinutes($task->meeting_at);
            $meetingTime = $task->meeting_at->format('D, d M Y \a\t h:i A');

            $subject = str_replace(
                ['{{title}}', '{{minutes_left}}'],
                [$task->title, $minutesLeft],
                $reminderTemplate->subject
            );
            $body = str_replace(
                ['{{title}}', '{{minutes_left}}', '{{meeting_time}}', '{{description}}'],
                [$task->title, $minutesLeft, $meetingTime, $task->description ?? ''],
                $reminderTemplate->description
            );

            $this->sendToAdmins($account, $adminEmails, $subject, $body);
            $task->update(['reminder_sent_at' => now()]);
        }

        // At-meeting notification: meeting time just reached (within last 2 min window)
        $nowTemplate = EmailTemplate::find(13);

        $nowNotifications = Task::whereNotNull('meeting_at')
            ->whereNotIn('status', ['done', 'trash'])
            ->whereNull('meeting_notified_at')
            ->where('meeting_at', '<=', now())
            ->where('meeting_at', '>=', now()->subMinutes(2))
            ->get();

        foreach ($nowNotifications as $task) {
            if (!$nowTemplate) {
                continue;
            }

            $meetingTime = $task->meeting_at->format('D, d M Y \a\t h:i A');

            $subject = str_replace(
                ['{{title}}', '{{meeting_time}}'],
                [$task->title, $meetingTime],
                $nowTemplate->subject
            );
            $body = str_replace(
                ['{{title}}', '{{meeting_time}}', '{{description}}'],
                [$task->title, $meetingTime, $task->description ?? ''],
                $nowTemplate->description
            );

            $this->sendToAdmins($account, $adminEmails, $subject, $body);
            $task->update(['meeting_notified_at' => now()]);
        }
    }

    private function sendToAdmins(BusinessEmailAccount $account, array $emails, string $subject, string $body): void
    {
        try {
            config(["mail.mailers.task_mailer_{$account->id}" => $account->mailerConfig()]);
            $mailer   = Mail::mailer("task_mailer_{$account->id}");
            $mailable = new ComposeEmail($subject, $body, $account->name, $account->email);

            foreach ($emails as $email) {
                $mailer->to($email)->send($mailable);
            }
        } catch (\Throwable $e) {
            $this->error("Failed to send meeting reminder: " . $e->getMessage());
        }
    }
}
