<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_email_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('smtp_host');
            $table->string('smtp_port', 10)->default('465');
            $table->string('smtp_username');
            $table->string('smtp_password');
            $table->string('encryption', 10)->default('ssl');
            $table->boolean('is_default')->default(false);
            $table->string('status', 20)->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_email_accounts');
    }
};
