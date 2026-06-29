<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('page_html')->nullable();
            $table->text('page_css')->nullable();
            $table->dateTime('webinar_date')->nullable();
            $table->integer('total_seats')->default(0);
            $table->boolean('payment_enabled')->default(false);
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency_symbol', 10)->default('$');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinars');
    }
};
