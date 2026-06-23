<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('installments:generate-monthly')->dailyAt('00:01');
        $schedule->command('google:sync-reviews')->hourly();
        $schedule->command('cron:heartbeat')->everyMinute();

        // Process queued mail jobs every minute; --stop-when-empty exits once
        // the queue is drained so it doesn't outlive the cron window.
        // withoutOverlapping(2) prevents a second worker starting if the first
        // is still running (lock auto-expires after 2 minutes).
        $schedule->command('queue:work --stop-when-empty --tries=3 --timeout=55')
                 ->everyMinute()
                 ->withoutOverlapping(2);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
