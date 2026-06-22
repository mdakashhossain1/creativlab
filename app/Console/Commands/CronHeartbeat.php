<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CronHeartbeat extends Command
{
    protected $signature = 'cron:heartbeat';
    protected $description = 'Writes a timestamp to cache so the dashboard can detect if the cron is running';

    public function handle()
    {
        Cache::put('cron_last_heartbeat', now()->toDateTimeString(), 300);
    }
}
