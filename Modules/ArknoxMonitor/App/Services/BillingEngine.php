<?php

namespace Modules\ArknoxMonitor\App\Services;

use Illuminate\Support\Facades\DB;

class BillingEngine
{
    /**
     * Return invoice data for a period.
     *
     * Current month  → live accumulation preview, never written to DB, status = "accumulating".
     * Past months    → auto-generate and persist the real invoice on first access.
     * Paid invoices  → locked snapshot, never recalculated.
     */
    public function invoice(int $year, int $month): array
    {
        if ($this->isCurrentMonth($year, $month)) {
            return $this->liveUsage($year, $month);
        }

        $existing = DB::table('arknox_invoices')
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        if ($existing && $existing->status === 'paid') {
            return $this->format($existing);
        }

        return $this->generate($year, $month);
    }

    /**
     * Generate and persist an invoice for a completed past month.
     * Blocked for the current month — invoices are only final once the month ends.
     */
    public function generate(int $year, int $month): array
    {
        if ($this->isCurrentMonth($year, $month)) {
            return $this->liveUsage($year, $month);
        }

        $usage = DB::table('arknox_usage_monthly')
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        $queries     = (int)   ($usage?->query_count ?? 0);
        $baseRent    = (float) config('arknoxmonitor.base_rent', 7.00);
        $freeQuota   = (int)   config('arknoxmonitor.free_queries', 0);
        $overageRate = (float) config('arknoxmonitor.overage_rate', 0.001);

        $overage       = max(0, $queries - $freeQuota);
        $overageAmount = round($overage * $overageRate, 4);
        $total         = round($baseRent + $overageAmount, 4);

        DB::table('arknox_invoices')->upsert(
            [
                'year'           => $year,
                'month'          => $month,
                'query_count'    => $queries,
                'base_rent'      => $baseRent,
                'overage_amount' => $overageAmount,
                'total_amount'   => $total,
                'status'         => 'pending',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            ['year', 'month'],
            ['query_count', 'overage_amount', 'total_amount', 'updated_at']
        );

        $row = DB::table('arknox_invoices')->where('year', $year)->where('month', $month)->first();
        return $this->format($row);
    }

    /**
     * Mark a past-month invoice as paid. Blocked for the current month.
     */
    public function markPaid(int $year, int $month): array
    {
        if ($this->isCurrentMonth($year, $month)) {
            return array_merge($this->liveUsage($year, $month), [
                'error' => 'Cannot mark the current month as paid — the month is still accumulating.',
            ]);
        }

        // Auto-generate the invoice first if it doesn't exist yet
        $this->generate($year, $month);

        DB::table('arknox_invoices')
            ->where('year', $year)
            ->where('month', $month)
            ->update(['status' => 'paid', 'paid_at' => now(), 'updated_at' => now()]);

        return $this->invoice($year, $month);
    }

    public function markUnpaid(int $year, int $month): array
    {
        if ($this->isCurrentMonth($year, $month)) {
            return $this->liveUsage($year, $month);
        }

        DB::table('arknox_invoices')
            ->where('year', $year)
            ->where('month', $month)
            ->update(['status' => 'unpaid', 'paid_at' => null, 'updated_at' => now()]);

        return $this->invoice($year, $month);
    }

    public function allInvoices(): array
    {
        $now = now();
        $rows = DB::table('arknox_invoices')
            ->where(function ($q) use ($now) {
                // Exclude the current month — it's still accumulating
                $q->where('year', '<', $now->year)
                  ->orWhere(function ($q2) use ($now) {
                      $q2->where('year', $now->year)
                         ->where('month', '<', $now->month);
                  });
            })
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        return $rows->map(fn($r) => $this->format($r))->all();
    }

    // ── helpers ──────────────────────────────────────────────────────────────

    private function isCurrentMonth(int $year, int $month): bool
    {
        return $year === (int) now()->year && $month === (int) now()->month;
    }

    /**
     * Live preview for the current (still-running) month.
     * Never written to the DB — status is "accumulating".
     */
    private function liveUsage(int $year, int $month): array
    {
        $usage       = DB::table('arknox_usage_monthly')
                         ->where('year', $year)->where('month', $month)->first();
        $queries     = (int)   ($usage?->query_count ?? 0);
        $timeMs      = (int)   ($usage?->total_time_ms ?? 0);
        $baseRent    = (float) config('arknoxmonitor.base_rent', 7.00);
        $freeQuota   = (int)   config('arknoxmonitor.free_queries', 0);
        $overageRate = (float) config('arknoxmonitor.overage_rate', 0.001);
        $overage     = max(0, $queries - $freeQuota);
        $overageAmt  = round($overage * $overageRate, 4);

        return [
            'period'           => ['year' => $year, 'month' => $month],
            'request_count'    => $queries,
            'total_time_ms'    => $timeMs,
            'avg_response_ms'  => $queries > 0 ? round($timeMs / $queries, 2) : 0,
            'free_quota'       => $freeQuota,
            'overage_requests' => $overage,
            'base_rent_usd'    => $baseRent,
            'overage_amount'   => $overageAmt,
            'total_usd'        => round($baseRent + $overageAmt, 4),
            'status'           => 'accumulating',
            'paid_at'          => null,
        ];
    }

    private function format(object $row): array
    {
        $freeQuota = (int) config('arknoxmonitor.free_queries', 0);
        $queries   = (int) $row->query_count;
        $usage     = DB::table('arknox_usage_monthly')
                       ->where('year', $row->year)->where('month', $row->month)->first();

        $liveRequests = (int) ($usage?->query_count ?? $queries);
        $timeMs       = (int) ($usage?->total_time_ms ?? 0);

        return [
            'period'           => ['year' => (int) $row->year, 'month' => (int) $row->month],
            'request_count'    => $queries,
            'total_time_ms'    => $timeMs,
            'avg_response_ms'  => $liveRequests > 0 ? round($timeMs / $liveRequests, 2) : 0,
            'free_quota'       => $freeQuota,
            'overage_requests' => max(0, $queries - $freeQuota),
            'base_rent_usd'    => (float) $row->base_rent,
            'overage_amount'   => (float) $row->overage_amount,
            'total_usd'        => (float) $row->total_amount,
            'status'           => $row->status,
            'paid_at'          => $row->paid_at ?? null,
        ];
    }
}
