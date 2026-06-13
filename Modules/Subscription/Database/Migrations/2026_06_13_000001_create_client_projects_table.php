<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->integer('slots')->default(1);
            $table->enum('payment_type', ['split', 'monthly'])->default('split');
            $table->decimal('monthly_amount', 10, 2)->nullable();
            $table->tinyInteger('gst_enabled')->default(0);
            $table->decimal('gst_percent', 5, 2)->default(0);
            $table->enum('status', ['active', 'paused', 'completed'])->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_projects');
    }
};
