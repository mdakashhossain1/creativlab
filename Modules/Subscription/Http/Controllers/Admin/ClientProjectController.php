<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use App\Helper\EmailHelper;
use App\Http\Controllers\Controller;
use App\Mail\ClientProjectInvoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Entities\ClientProject;
use Modules\Subscription\Entities\ClientProjectInstallment;

class ClientProjectController extends Controller
{
    public function index()
    {
        $projects = ClientProject::with('user')->latest()->paginate(20);
        return view('subscription::admin.client-projects.index', compact('projects'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('subscription::admin.client-projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'         => 'required|string|max:255',
            'title'        => 'required|string|max:255',
            'user_id'      => 'required|exists:users,id',
            'payment_type' => 'required|in:split,monthly',
            'total_price'  => 'required|numeric|min:0',
            'slots'        => 'required|integer|min:1',
        ];

        if ($request->payment_type === 'monthly') {
            $rules['monthly_amount'] = 'required|numeric|min:0';
        }

        if ($request->payment_type === 'split') {
            $rules['installments']            = 'required|array|min:1';
            $rules['installments.*.amount']   = 'required|numeric|min:0';
            $rules['installments.*.due_date'] = 'required|date';
        }

        $request->validate($rules);

        $project = ClientProject::create([
            'user_id'        => $request->user_id,
            'name'           => $request->name,
            'title'          => $request->title,
            'description'    => $request->description,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'total_price'    => $request->total_price,
            'slots'          => $request->slots,
            'payment_type'   => $request->payment_type,
            'monthly_amount' => $request->monthly_amount,
            'gst_enabled'    => $request->has('gst_enabled') ? 1 : 0,
            'gst_percent'    => $request->gst_percent ?? 0,
            'status'         => 'active',
            'created_by'     => auth()->id(),
        ]);

        if ($request->payment_type === 'split') {
            foreach ($request->installments as $index => $item) {
                $baseAmount = (float) $item['amount'];
                $gstAmount  = $project->gst_enabled
                    ? round($baseAmount * ($project->gst_percent / 100), 2)
                    : 0;
                $totalAmount = $baseAmount + $gstAmount;

                ClientProjectInstallment::create([
                    'project_id'          => $project->id,
                    'installment_number'  => $index + 1,
                    'base_amount'         => $baseAmount,
                    'gst_amount'          => $gstAmount,
                    'total_amount'        => $totalAmount,
                    'due_date'            => $item['due_date'],
                    'status'              => 'pending',
                ]);
            }
        } elseif ($request->payment_type === 'monthly') {
            $baseAmount  = (float) $request->monthly_amount;
            $gstAmount   = $project->gst_enabled
                ? round($baseAmount * ($project->gst_percent / 100), 2)
                : 0;
            $totalAmount = $baseAmount + $gstAmount;

            ClientProjectInstallment::create([
                'project_id'         => $project->id,
                'installment_number' => 1,
                'base_amount'        => $baseAmount,
                'gst_amount'         => $gstAmount,
                'total_amount'       => $totalAmount,
                'due_date'           => now()->toDateString(),
                'status'             => 'pending',
            ]);
        }

        $this->sendProjectCreatedEmail($project);

        return redirect()->route('admin.client-projects.index')
            ->with(['messege' => trans('Project created successfully'), 'alert-type' => 'success']);
    }

    private function sendProjectCreatedEmail(ClientProject $project): void
    {
        try {
            $user     = $project->user;
            $template = \Modules\EmailSetting\App\Models\EmailTemplate::find(9);

            if (!$template || !$user) {
                return;
            }

            $subject = str_replace(
                ['{{project_name}}', '{{name}}'],
                [$project->name, $user->name],
                $template->subject
            );

            $message = $template->description;
            $message = str_replace('{{name}}',          $user->name,                                                          $message);
            $message = str_replace('{{email}}',         $user->email,                                                         $message);
            $message = str_replace('{{project_name}}',  $project->name,                                                       $message);
            $message = str_replace('{{project_title}}', $project->title ?? $project->name,                                    $message);
            $message = str_replace('{{total_price}}',   number_format($project->total_price, 2),                              $message);
            $message = str_replace('{{payment_type}}',  ucfirst($project->payment_type),                                      $message);
            $message = str_replace('{{start_date}}',    $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '—', $message);
            $message = str_replace('{{end_date}}',      $project->end_date   ? \Carbon\Carbon::parse($project->end_date)->format('d M Y')   : '—', $message);
            $message = str_replace('{{dashboard_url}}', route('user.client-projects.index'),                                  $message);

            EmailHelper::mail_setup();
            Mail::to($user->email)->send(new ClientProjectInvoice($message, $subject));
        } catch (\Exception $e) {
            Log::error('ClientProject created mail error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $project = ClientProject::with(['installments', 'user'])->findOrFail($id);
        return view('subscription::admin.client-projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = ClientProject::findOrFail($id);
        $users   = User::orderBy('name')->get();
        return view('subscription::admin.client-projects.edit', compact('project', 'users'));
    }

    public function update(Request $request, $id)
    {
        $project = ClientProject::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'user_id'     => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0',
            'slots'       => 'required|integer|min:1',
        ]);

        $project->update([
            'user_id'        => $request->user_id,
            'name'           => $request->name,
            'title'          => $request->title,
            'description'    => $request->description,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'total_price'    => $request->total_price,
            'slots'          => $request->slots,
            'monthly_amount' => $request->monthly_amount,
            'gst_enabled'    => $request->has('gst_enabled') ? 1 : 0,
            'gst_percent'    => $request->gst_percent ?? 0,
        ]);

        return redirect()->route('admin.client-projects.index')
            ->with(['messege' => trans('Project updated successfully'), 'alert-type' => 'success']);
    }

    public function destroy($id)
    {
        $project = ClientProject::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.client-projects.index')
            ->with(['messege' => trans('Project deleted successfully'), 'alert-type' => 'success']);
    }

    public function toggleStatus($id)
    {
        $project = ClientProject::findOrFail($id);
        $project->status = $project->status === 'active' ? 'paused' : 'active';
        $project->save();

        return redirect()->back()
            ->with(['messege' => trans('Project status updated'), 'alert-type' => 'success']);
    }

    public function markAsPaid(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:Cash,Bank_Payment,Cheque,Other',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        $installment = ClientProjectInstallment::with('project.user')->findOrFail($id);

        if ($installment->status === 'paid') {
            return redirect()->back()
                ->with(['messege' => trans('This installment is already paid'), 'alert-type' => 'error']);
        }

        $installment->status         = 'paid';
        $installment->paid_at        = now();
        $installment->payment_method = $request->payment_method;
        $installment->transaction_id = $request->transaction_id ?? null;
        $installment->invoice_number = 'INV-' . strtoupper(uniqid());
        $installment->save();

        try {
            $installment->loadMissing('project.installments', 'project.user');
            $project = $installment->project;
            $user    = $project->user;

            $template = \Modules\EmailSetting\App\Models\EmailTemplate::find(8);
            if ($template) {
                $breakdownHtml = $this->buildPaymentBreakdownHtml($installment, $project);
                $subject = str_replace(
                    ['{{invoice_number}}', '{{project_name}}'],
                    [$installment->invoice_number, $project->name],
                    $template->subject
                );
                $message = $template->description;
                $message = str_replace('{{name}}',             $user->name,                                                               $message);
                $message = str_replace('{{email}}',            $user->email,                                                              $message);
                $message = str_replace('{{invoice_number}}',   $installment->invoice_number,                                              $message);
                $message = str_replace('{{paid_date}}',        optional($installment->paid_at)->format('d M Y') ?? now()->format('d M Y'),$message);
                $message = str_replace('{{project_name}}',     $project->name,                                                            $message);
                $message = str_replace('{{project_title}}',    $project->title ?? $project->name,                                         $message);
                $message = str_replace('{{installment_info}}', 'Payment ' . $installment->installment_number . ' of ' . $project->installments->count(), $message);
                $message = str_replace('{{payment_method}}',   $installment->payment_method,                                              $message);
                $message = str_replace('{{transaction_id}}',   $installment->transaction_id ?? '—',                                       $message);
                $message = str_replace('{{base_amount}}',      number_format($installment->base_amount, 2),                               $message);
                $message = str_replace('{{gst_amount}}',       number_format($installment->gst_amount ?? 0, 2),                           $message);
                $message = str_replace('{{total_amount}}',     number_format($installment->total_amount, 2),                              $message);
                $message = str_replace('{{payment_breakdown}}', $breakdownHtml,                                                            $message);

                EmailHelper::mail_setup();
                Mail::to($user->email)->send(new ClientProjectInvoice($message, $subject));
            }
        } catch (\Exception $e) {
            Log::error('ClientProject mark-paid mail error: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with(['messege' => trans('Installment marked as paid and invoice sent'), 'alert-type' => 'success']);
    }

    public function approveInstallment($id)
    {
        $installment = ClientProjectInstallment::with('project.user')->findOrFail($id);

        $installment->status         = 'paid';
        $installment->paid_at        = now();
        $installment->payment_method = 'Bank_Payment';
        $installment->invoice_number = 'INV-' . strtoupper(uniqid());
        $installment->save();

        try {
            $installment->loadMissing('project.installments', 'project.user');
            $project = $installment->project;
            $user    = $project->user;

            $template = \Modules\EmailSetting\App\Models\EmailTemplate::find(8);
            if ($template) {
                $breakdownHtml = $this->buildPaymentBreakdownHtml($installment, $project);

                $subject = str_replace(
                    ['{{invoice_number}}', '{{project_name}}'],
                    [$installment->invoice_number, $project->name],
                    $template->subject
                );

                $message = $template->description;
                $message = str_replace('{{name}}',             $user->name,                                              $message);
                $message = str_replace('{{email}}',            $user->email,                                             $message);
                $message = str_replace('{{invoice_number}}',   $installment->invoice_number,                             $message);
                $message = str_replace('{{paid_date}}',        optional($installment->paid_at)->format('d M Y') ?? now()->format('d M Y'), $message);
                $message = str_replace('{{project_name}}',     $project->name,                                           $message);
                $message = str_replace('{{project_title}}',    $project->title ?? $project->name,                        $message);
                $message = str_replace('{{installment_info}}', 'Payment ' . $installment->installment_number . ' of ' . $project->installments->count(), $message);
                $message = str_replace('{{payment_method}}',   $installment->payment_method ?? '—',                      $message);
                $message = str_replace('{{transaction_id}}',   $installment->transaction_id ?? '—',                      $message);
                $message = str_replace('{{base_amount}}',      number_format($installment->base_amount, 2),               $message);
                $message = str_replace('{{gst_amount}}',       number_format($installment->gst_amount ?? 0, 2),           $message);
                $message = str_replace('{{total_amount}}',     number_format($installment->total_amount, 2),              $message);
                $message = str_replace('{{payment_breakdown}}', $breakdownHtml,                                           $message);

                EmailHelper::mail_setup();
                Mail::to($user->email)->send(new ClientProjectInvoice($message, $subject));
            }
        } catch (\Exception $e) {
            Log::error('ClientProject invoice mail error: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with(['messege' => trans('Installment approved and invoice sent'), 'alert-type' => 'success']);
    }

    private function buildPaymentBreakdownHtml(ClientProjectInstallment $installment, ClientProject $project): string
    {
        $html  = '<table style="width:100%;border-collapse:collapse;">';
        $html .= '<thead><tr style="background:#f4f4f4;">';
        $html .= '<th style="padding:8px 12px;text-align:left;border:1px solid #e0e0e0;">Description</th>';
        $html .= '<th style="padding:8px 12px;text-align:right;border:1px solid #e0e0e0;">Amount</th>';
        $html .= '</tr></thead><tbody>';

        $html .= '<tr><td style="padding:8px 12px;border:1px solid #e0e0e0;">Base Amount</td>';
        $html .= '<td style="padding:8px 12px;text-align:right;border:1px solid #e0e0e0;">' . number_format($installment->base_amount, 2) . '</td></tr>';

        if (!empty($installment->gst_amount) && $installment->gst_amount > 0) {
            $html .= '<tr><td style="padding:8px 12px;border:1px solid #e0e0e0;">GST (' . $project->gst_percent . '%)</td>';
            $html .= '<td style="padding:8px 12px;text-align:right;border:1px solid #e0e0e0;">' . number_format($installment->gst_amount, 2) . '</td></tr>';
        }

        if (!empty($installment->transaction_id)) {
            $html .= '<tr><td style="padding:8px 12px;border:1px solid #e0e0e0;">Transaction ID</td>';
            $html .= '<td style="padding:8px 12px;text-align:right;border:1px solid #e0e0e0;">' . e($installment->transaction_id) . '</td></tr>';
        }

        $html .= '<tr style="font-weight:700;color:#794AFF;">';
        $html .= '<td style="padding:10px 12px;border:1px solid #e0e0e0;">Total Paid</td>';
        $html .= '<td style="padding:10px 12px;text-align:right;border:1px solid #e0e0e0;">' . number_format($installment->total_amount, 2) . '</td></tr>';

        $html .= '</tbody></table>';
        return $html;
    }
}
