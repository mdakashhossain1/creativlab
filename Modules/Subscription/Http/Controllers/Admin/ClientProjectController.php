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

        return redirect()->route('admin.client-projects.index')
            ->with(['messege' => trans('Project created successfully'), 'alert-type' => 'success']);
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

    public function approveInstallment($id)
    {
        $installment = ClientProjectInstallment::with('project.user')->findOrFail($id);

        $installment->status         = 'paid';
        $installment->paid_at        = now();
        $installment->payment_method = 'Bank_Payment';
        $installment->invoice_number = 'INV-' . strtoupper(uniqid());
        $installment->save();

        try {
            EmailHelper::mail_setup();
            $project = $installment->project;
            $user    = $project->user;
            Mail::to($user->email)->send(new ClientProjectInvoice($installment, $project, $user));
        } catch (\Exception $e) {
            Log::error('ClientProject invoice mail error: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with(['messege' => trans('Installment approved and invoice sent'), 'alert-type' => 'success']);
    }
}
