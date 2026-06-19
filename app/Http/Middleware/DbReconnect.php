<?php

namespace App\Http\Middleware;

use Closure;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DbReconnect
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Verify the persistent connection is still alive before any query runs.
            // Cost: ~0-1 ms when healthy; saves the 50-300 ms reconnect mid-request.
            DB::connection()->getPdo()->query('SELECT 1');
        } catch (Throwable $e) {
            Log::debug('DB: stale persistent connection, reconnecting — ' . $e->getMessage());
            DB::reconnect();
        }

        return $next($request);
    }
}
