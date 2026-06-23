<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('contact_us_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('contact_us_id');
            $table->string('lang_code');
            $table->text('address');
            $table->text('title');
            $table->text('description');
            $table->text('contact_description')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('contact_us_translations'); }
};
