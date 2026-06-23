<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email2')->nullable();
            $table->text('map_code')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('contact_us'); }
};
