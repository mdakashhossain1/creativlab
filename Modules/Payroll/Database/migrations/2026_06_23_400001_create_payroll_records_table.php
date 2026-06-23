<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->smallInteger('year')->unsigned();
            $table->tinyInteger('month')->unsigned();
            $table->decimal('base_salary', 10, 2);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->decimal('deductions', 10, 2)->default(0);
            $table->decimal('net_salary', 10, 2);
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unique(['team_id', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_records');
    }
};
