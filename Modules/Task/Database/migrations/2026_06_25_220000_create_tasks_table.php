<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->json('tags')->nullable();
            $table->enum('status', ['inbox', 'done', 'important', 'trash'])->default('inbox');
            $table->dateTime('meeting_at')->nullable();
            $table->unsignedSmallInteger('notify_before_minutes')->default(30);
            $table->dateTime('reminder_sent_at')->nullable();
            $table->dateTime('meeting_notified_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('meeting_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
