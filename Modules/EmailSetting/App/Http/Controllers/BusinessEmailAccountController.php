<?php

namespace Modules\EmailSetting\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\EmailSetting\App\Models\BusinessEmailAccount;

class BusinessEmailAccountController extends Controller
{
    public function index()
    {
        $accounts = BusinessEmailAccount::latest()->get();
        return view('emailsetting::email_accounts', compact('accounts'));
    }

    public function create()
    {
        return view('emailsetting::email_account_form', ['account' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|max:150',
            'smtp_host'        => 'required|string|max:150',
            'smtp_port'        => 'required|numeric|between:1,65535',
            'smtp_username'    => 'required|string|max:150',
            'smtp_password'    => 'required|string|max:255',
            'encryption'       => 'required|in:ssl,tls,none',
            'imap_host'        => 'nullable|string|max:150',
            'imap_port'        => 'nullable|numeric|between:1,65535',
            'imap_encryption'  => 'nullable|in:ssl,tls,none',
        ]);

        if ($request->boolean('is_default')) {
            BusinessEmailAccount::where('is_default', true)->update(['is_default' => false]);
        }

        BusinessEmailAccount::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'smtp_host'       => $request->smtp_host,
            'smtp_port'       => $request->smtp_port,
            'smtp_username'   => $request->smtp_username,
            'smtp_password'   => $request->smtp_password,
            'encryption'      => $request->encryption,
            'imap_host'       => $request->input('imap_host') ?: null,
            'imap_port'       => $request->input('imap_port', 993),
            'imap_encryption' => $request->input('imap_encryption', 'ssl'),
            'is_default'      => $request->boolean('is_default'),
            'status'          => $request->input('status', 'active'),
        ]);

        return redirect()->route('admin.email-accounts.index')
            ->with(['message' => trans('Account created successfully'), 'alert-type' => 'success']);
    }

    public function edit($id)
    {
        $account = BusinessEmailAccount::findOrFail($id);
        return view('emailsetting::email_account_form', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $account = BusinessEmailAccount::findOrFail($id);

        $request->validate([
            'name'            => 'required|string|max:100',
            'email'           => 'required|email|max:150',
            'smtp_host'       => 'required|string|max:150',
            'smtp_port'       => 'required|numeric|between:1,65535',
            'smtp_username'   => 'required|string|max:150',
            'smtp_password'   => 'required|string|max:255',
            'encryption'      => 'required|in:ssl,tls,none',
            'imap_host'       => 'nullable|string|max:150',
            'imap_port'       => 'nullable|numeric|between:1,65535',
            'imap_encryption' => 'nullable|in:ssl,tls,none',
        ]);

        if ($request->boolean('is_default')) {
            BusinessEmailAccount::where('is_default', true)->update(['is_default' => false]);
        }

        $account->update([
            'name'            => $request->name,
            'email'           => $request->email,
            'smtp_host'       => $request->smtp_host,
            'smtp_port'       => $request->smtp_port,
            'smtp_username'   => $request->smtp_username,
            'smtp_password'   => $request->smtp_password,
            'encryption'      => $request->encryption,
            'imap_host'       => $request->input('imap_host') ?: null,
            'imap_port'       => $request->input('imap_port', 993),
            'imap_encryption' => $request->input('imap_encryption', 'ssl'),
            'is_default'      => $request->boolean('is_default'),
            'status'          => $request->input('status', 'active'),
        ]);

        return redirect()->route('admin.email-accounts.index')
            ->with(['message' => trans('Account updated successfully'), 'alert-type' => 'success']);
    }

    public function destroy($id)
    {
        $account = BusinessEmailAccount::findOrFail($id);
        $account->delete();

        return redirect()->route('admin.email-accounts.index')
            ->with(['message' => trans('Account deleted successfully'), 'alert-type' => 'success']);
    }

    public function setDefault($id)
    {
        BusinessEmailAccount::where('is_default', true)->update(['is_default' => false]);
        BusinessEmailAccount::where('id', $id)->update(['is_default' => true]);

        return redirect()->back()
            ->with(['message' => trans('Default account updated'), 'alert-type' => 'success']);
    }

    public function toggleStatus($id)
    {
        $account = BusinessEmailAccount::findOrFail($id);
        $account->status = $account->status === 'active' ? 'inactive' : 'active';
        $account->save();

        return response()->json(['status' => $account->status]);
    }
}
