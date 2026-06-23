<?php

namespace App\Console\Commands;

use App\Services\GooglePlacesService;
use Illuminate\Console\Command;

class SyncGoogleReviews extends Command
{
    protected $signature   = 'google:sync-reviews';
    protected $description = 'Sync Google Business reviews from Places API into the database';

    public function handle(GooglePlacesService $places): int
    {
        $this->info('Syncing Google reviews...');
        $count = $places->syncReviews();
        $this->info("Done. {$count} review(s) synced.");
        return Command::SUCCESS;
    }
}
