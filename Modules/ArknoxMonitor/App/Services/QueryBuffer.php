<?php

namespace Modules\ArknoxMonitor\App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Accumulates query stats in memory for the duration of a request,
 * then flushes to the tracking tables once at request termination.
 * This avoids per-query writes (overhead) and recursive tracking loops.
 */
class QueryBuffer
{
    private static bool  $listening  = false;
    private static bool  $flushing   = false;
    private static int   $queries    = 0;
    private static float $timeMs     = 0.0;
    private static int   $rows       = 0;

    public static function start(): void
    {
        if (self::$listening) return;
        self::$listening = true;

        // Skip tracking for ArknoxMonitor's own API requests
        $prefix = trim(config('arknoxmonitor.route_prefix', 'arknox-monitor'), '/');
        if (str_starts_with(request()->path(), $prefix)) return;

        $exclude = config('arknoxmonitor.exclude_connections', []);

        DB::listen(function ($query) use ($exclude) {
            if (self::$flushing) return;
            if (in_array($query->connectionName, (array) $exclude, true)) return;

            self::$queries++;
            self::$timeMs += (float) $query->time;
        });
    }

    public static function flush(): void
    {
        if (self::$flushing || self::$queries === 0) return;

        self::$flushing = true;
        $queries = self::$queries;
        $timeMs  = (int) round(self::$timeMs);

        // Reset immediately so any accidental re-entry is a no-op
        self::$queries = 0;
        self::$timeMs  = 0.0;

        try {
            $date  = now()->toDateString();
            $year  = now()->year;
            $month = now()->month;
            $now   = now()->toDateTimeString();

            DB::statement("
                INSERT INTO arknox_usage_daily (date, query_count, total_time_ms, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                    query_count   = query_count   + VALUES(query_count),
                    total_time_ms = total_time_ms + VALUES(total_time_ms),
                    updated_at    = VALUES(updated_at)
            ", [$date, $queries, $timeMs, $now, $now]);

            DB::statement("
                INSERT INTO arknox_usage_monthly (year, month, query_count, total_time_ms, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                    query_count   = query_count   + VALUES(query_count),
                    total_time_ms = total_time_ms + VALUES(total_time_ms),
                    updated_at    = VALUES(updated_at)
            ", [$year, $month, $queries, $timeMs, $now, $now]);

        } catch (\Throwable) {
            // Monitoring must never break the host application
        } finally {
            self::$flushing = false;
        }
    }

    public static function current(): array
    {
        return [
            'buffered_queries' => self::$queries,
            'buffered_time_ms' => self::$timeMs,
        ];
    }
}
