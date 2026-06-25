<?php

use Illuminate\Support\Facades\Route;
use Modules\EmailSetting\App\Http\Controllers\EmailSettingController;
use Modules\EmailSetting\App\Http\Controllers\BusinessEmailAccountController;
use Modules\EmailSetting\App\Http\Controllers\MailboxController;


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin']], function () {

    // ── Email Settings & Templates ────────────────────────────────────────────
    Route::get('email-setting', [EmailSettingController::class, 'index'])->name('email-setting');
    Route::put('update-email-setting', [EmailSettingController::class, 'update'])->name('update-email-setting');

    Route::get('email-template', [EmailSettingController::class, 'email_template'])->name('email-template');
    Route::get('edit-email-template/{id}', [EmailSettingController::class, 'edit_email_template'])->name('edit-email-template');
    Route::put('update-email-template/{id}', [EmailSettingController::class, 'update_email_template'])->name('update-email-template');

    // ── Business Email Accounts ───────────────────────────────────────────────
    Route::get('email-accounts', [BusinessEmailAccountController::class, 'index'])->name('email-accounts.index');
    Route::get('email-accounts/create', [BusinessEmailAccountController::class, 'create'])->name('email-accounts.create');
    Route::post('email-accounts', [BusinessEmailAccountController::class, 'store'])->name('email-accounts.store');
    Route::get('email-accounts/{id}/edit', [BusinessEmailAccountController::class, 'edit'])->name('email-accounts.edit');
    Route::put('email-accounts/{id}', [BusinessEmailAccountController::class, 'update'])->name('email-accounts.update');
    Route::delete('email-accounts/{id}', [BusinessEmailAccountController::class, 'destroy'])->name('email-accounts.destroy');
    Route::post('email-accounts/{id}/set-default', [BusinessEmailAccountController::class, 'setDefault'])->name('email-accounts.set-default');
    Route::post('email-accounts/{id}/toggle-status', [BusinessEmailAccountController::class, 'toggleStatus'])->name('email-accounts.toggle-status');

    // ── Mailbox: Sent ─────────────────────────────────────────────────────────
    Route::get('mailbox', [MailboxController::class, 'index'])->name('mailbox.index');
    Route::post('mailbox/compose', [MailboxController::class, 'compose'])->name('mailbox.compose');
    Route::delete('mailbox/sent/{id}', [MailboxController::class, 'destroy'])->name('mailbox.destroy');
    Route::get('mailbox/sent/{id}', [MailboxController::class, 'show'])->name('mailbox.show');

    // ── Mailbox: Inbox (IMAP) ─────────────────────────────────────────────────
    Route::get('mailbox/inbox', [MailboxController::class, 'inbox'])->name('mailbox.inbox');
    Route::post('mailbox/fetch-inbox', [MailboxController::class, 'fetchInbox'])->name('mailbox.fetch-inbox');
    Route::get('mailbox/received/{id}', [MailboxController::class, 'showReceived'])->name('mailbox.show-received');
    Route::delete('mailbox/received/{id}', [MailboxController::class, 'destroyReceived'])->name('mailbox.destroy-received');
});
