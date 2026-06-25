<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sent_mail_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->string('from_email');
            $table->text('to_email');
            $table->text('cc')->nullable();
            $table->string('subject');
            $table->longText('body')->nullable();
            $table->string('status', 20)->default('sent');
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('business_email_accounts')->nullOnDelete();
            $table->index(['status', 'sent_at']);
            $table->index('account_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sent_mail_logs');
    }
};
