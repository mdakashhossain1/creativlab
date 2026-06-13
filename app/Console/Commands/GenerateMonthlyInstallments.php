<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Subscription\Entities\ClientProject;
use Modules\Subscription\Entities\ClientProjectInstallment;

class GenerateMonthlyInstallments extends Command
{
    protected $signature   = 'installments:generate-monthly';
    protected $description = 'Generate monthly installment rows for active monthly client projects';

    public function handle(): int
    {
        $today        = now();
        $currentMonth = $today->month;
        $currentYear  = $today->year;

        // 1. Mark overdue: pending installments whose due_date is before today
        $overdueCount = ClientProjectInstallment::where('status', 'pending')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', $today->toDateString())
            ->update(['status' => 'overdue']);

        $this->info("Marked {$overdueCount} installment(s) as overdue.");

        // 2. Generate for active monthly projects
        $projects = ClientProject::where('payment_type', 'monthly')
            ->where('status', 'active')
            ->get();

        $generated = 0;

        foreach ($projects as $project) {
            // Check if an installment already exists for the current month
            $existsThisMonth = ClientProjectInstallment::where('project_id', $project->id)
                ->whereMonth('due_date', $currentMonth)
                ->whereYear('due_date', $currentYear)
                ->exists();

            if ($existsThisMonth) {
                continue;
            }

            // Determine installment number
            $lastInstallment = ClientProjectInstallment::where('project_id', $project->id)
                ->orderBy('installment_number', 'desc')
                ->first();

            $nextNumber  = $lastInstallment ? $lastInstallment->installment_number + 1 : 1;
            $baseAmount  = (float) $project->monthly_amount;
            $gstAmount   = $project->gst_enabled
                ? round($baseAmount * ($project->gst_percent / 100), 2)
                : 0;
            $totalAmount = $baseAmount + $gstAmount;

            ClientProjectInstallment::create([
                'project_id'         => $project->id,
                'installment_number' => $nextNumber,
                'base_amount'        => $baseAmount,
                'gst_amount'         => $gstAmount,
                'total_amount'       => $totalAmount,
                'due_date'           => $today->toDateString(),
                'status'             => 'pending',
            ]);

            $generated++;
        }

        $this->info("Generated {$generated} monthly installment(s).");

        return self::SUCCESS;
    }
}
