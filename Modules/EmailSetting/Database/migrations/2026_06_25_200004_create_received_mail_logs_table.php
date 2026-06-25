<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('received_mail_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('business_email_accounts')->onDelete('cascade');
            $table->unsignedBigInteger('message_uid');
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->string('to_email')->nullable();
            $table->string('subject', 500)->nullable();
            $table->text('body_preview')->nullable();
            $table->longText('body')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('received_at')->nullable();
            $table->timestamps();

            $table->unique(['account_id', 'message_uid']);
            $table->index(['is_read', 'received_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('received_mail_logs');
    }
};
