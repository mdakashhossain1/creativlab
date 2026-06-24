<?php

namespace Modules\ArknoxMonitor\App\Services;

use Illuminate\Support\Facades\DB;

class BillingEngine
{
    /**
     * Return an existing invoice for the period, or generate and persist one.
     */
    public function invoice(int $year, int $month): array
    {
        $existing = DB::table('arknox_invoices')
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        if ($existing) {
            return $this->format($existing);
        }

        return $this->generate($year, $month);
    }

    /**
     * Generate and save an invoice for the given period.
     * Safe to call multiple times — returns existing record if already generated.
     */
    public function generate(int $year, int $month): array
    {
        $usage = DB::table('arknox_usage_monthly')
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        $queries     = (int)   ($usage?->query_count ?? 0);
        $baseRent    = (float) config('arknoxmonitor.base_rent', 7.00);
        $freeQuota   = (int)   config('arknoxmonitor.free_queries', 10000);
        $overageRate = (float) config('arknoxmonitor.overage_rate', 0.0001);

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
            // Only update usage snapshot if not yet paid
            ['query_count', 'overage_amount', 'total_amount', 'updated_at']
        );

        $row = DB::table('arknox_invoices')->where('year', $year)->where('month', $month)->first();
        return $this->format($row);
    }

    public function markPaid(int $year, int $month): array
    {
        DB::table('arknox_invoices')
            ->where('year', $year)
            ->where('month', $month)
            ->update(['status' => 'paid', 'paid_at' => now(), 'updated_at' => now()]);

        return $this->invoice($year, $month);
    }

    public function markUnpaid(int $year, int $month): array
    {
        DB::table('arknox_invoices')
            ->where('year', $year)
            ->where('month', $month)
            ->update(['status' => 'unpaid', 'paid_at' => null, 'updated_at' => now()]);

        return $this->invoice($year, $month);
    }

    public function allInvoices(): array
    {
        $rows = DB::table('arknox_invoices')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        return $rows->map(fn($r) => $this->format($r))->all();
    }

    private function format(object $row): array
    {
        $freeQuota = (int) config('arknoxmonitor.free_queries', 10000);
        $queries   = (int) $row->query_count;
        $usage     = DB::table('arknox_usage_monthly')
            ->where('year', $row->year)
            ->where('month', $row->month)
            ->first();

        return [
            'period'           => ['year' => (int) $row->year, 'month' => (int) $row->month],
            'query_count'      => $queries,
            'total_time_ms'    => (int) ($usage?->total_time_ms ?? 0),
            'avg_query_ms'     => $queries > 0 ? round(($usage?->total_time_ms ?? 0) / $queries, 2) : 0,
            'free_quota'       => $freeQuota,
            'overage_queries'  => max(0, $queries - $freeQuota),
            'base_rent_usd'    => (float) $row->base_rent,
            'overage_amount'   => (float) $row->overage_amount,
            'total_usd'        => (float) $row->total_amount,
            'status'           => $row->status,
            'paid_at'          => $row->paid_at ?? null,
        ];
    }
}
