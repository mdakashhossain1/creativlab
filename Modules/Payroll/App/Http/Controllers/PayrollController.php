<?php

namespace Modules\Payroll\App\Http\Controllers;

use App\Helper\EmailHelper;
use App\Mail\PayrollPaid;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\EmailSetting\App\Models\EmailTemplate;
use Modules\Payroll\App\Models\PayrollRecord;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $year  = (int) $request->input('year',  now()->year);
        $month = (int) $request->input('month', now()->month);

        $teams   = Team::latest()->get();
        $records = PayrollRecord::forMonth($year, $month)
                                ->get()
                                ->keyBy('team_id');

        return view('payroll::index', compact('teams', 'records', 'year', 'month'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'team_id'      => 'required|exists:teams,id',
            'year'         => 'required|integer|min:2020|max:2100',
            'month'        => 'required|integer|min:1|max:12',
            'base_salary'  => 'required|numeric|min:0',
            'bonus'        => 'nullable|numeric|min:0',
            'deductions'   => 'nullable|numeric|min:0',
            'notes'        => 'nullable|string|max:500',
        ]);

        $base       = (float) $request->input('base_salary', 0);
        $bonus      = (float) $request->input('bonus', 0);
        $deductions = (float) $request->input('deductions', 0);

        $existing = PayrollRecord::where([
            'team_id' => $request->team_id,
            'year'    => $request->year,
            'month'   => $request->month,
        ])->first();

        $values = [
            'base_salary'  => $base,
            'bonus'        => $bonus,
            'deductions'   => $deductions,
            'net_salary'   => PayrollRecord::computeNet($base, $bonus, $deductions),
            'notes'        => $request->input('notes'),
        ];

        // Editing a paid record resets it to pending so it can be re-approved and re-emailed.
        if ($existing && $existing->status === 'paid') {
            $values['status']  = 'pending';
            $values['paid_at'] = null;
        }

        PayrollRecord::updateOrCreate(
            [
                'team_id' => $request->team_id,
                'year'    => $request->year,
                'month'   => $request->month,
            ],
            $values
        );

        $wasReset = $existing && $existing->status === 'paid';
        $notification = ['messege' => $wasReset ? 'Salary updated and reset to pending.' : 'Payroll record saved successfully.', 'alert-type' => 'success'];
        return redirect()->route('admin.payroll.index', ['year' => $request->year, 'month' => $request->month])
                         ->with($notification);
    }

    public function markPaid(Request $request, $id)
    {
        $record = PayrollRecord::findOrFail($id);

        if ($record->status === 'paid') {
            return redirect()->back()->with(['messege' => 'Already marked as paid.', 'alert-type' => 'info']);
        }

        $record->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        // Send email
        try {
            $team     = $record->team;
            $template = EmailTemplate::find(11);

            if ($template && $team?->mail) {
                $monthLabel = Carbon::createFromDate($record->year, $record->month, 1)->format('F Y');
                $subject    = str_replace('{{month_year}}', $monthLabel, $template->subject);
                $message    = $template->description;
                $message    = str_replace('{{name}}',        $team->translate?->name ?? $team->mail,    $message);
                $message    = str_replace('{{designation}}', $team->translate?->designation ?? '—',     $message);
                $message    = str_replace('{{month_year}}',  $monthLabel,                               $message);
                $message    = str_replace('{{base_salary}}', number_format($record->base_salary, 2),    $message);
                $message    = str_replace('{{bonus}}',       number_format($record->bonus, 2),          $message);
                $message    = str_replace('{{deductions}}',  number_format($record->deductions, 2),     $message);
                $message    = str_replace('{{net_salary}}',  number_format($record->net_salary, 2),     $message);
                $message    = str_replace('{{paid_date}}',   $record->paid_at->format('d M Y'),         $message);

                EmailHelper::mail_setup();
                Mail::to($team->mail)->send(new PayrollPaid($message, $subject));
            }
        } catch (\Exception $e) {
            Log::error('Payroll mark-paid email error: ' . $e->getMessage());
        }

        $notification = ['messege' => 'Marked as paid successfully.', 'alert-type' => 'success'];
        return redirect()->route('admin.payroll.index', ['year' => $record->year, 'month' => $record->month])
                         ->with($notification);
    }

    public function export(Request $request)
    {
        $year  = (int) $request->input('year',  now()->year);
        $month = (int) $request->input('month', now()->month);

        $records = PayrollRecord::with('team')
                                ->forMonth($year, $month)
                                ->get();

        $filename = 'payroll-' . $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($records) {
            $handle = fopen('php://output', 'w');
            // Write UTF-8 BOM to make it open correctly in Excel
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($handle, ['#', 'Name', 'Designation', 'Base Salary', 'Bonus', 'Deductions', 'Net Salary', 'Status', 'Paid At']);

            foreach ($records as $i => $rec) {
                fputcsv($handle, [
                    $i + 1,
                    $rec->team?->translate?->name ?? '',
                    $rec->team?->translate?->designation ?? '',
                    number_format($rec->base_salary, 2),
                    number_format($rec->bonus, 2),
                    number_format($rec->deductions, 2),
                    number_format($rec->net_salary, 2),
                    ucfirst($rec->status),
                    $rec->paid_at ? $rec->paid_at->format('d M Y') : '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
