<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('about_us_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('about_us_id');
            $table->string('lang_code');
            $table->string('short_title');
            $table->string('title');
            $table->text('description');
            $table->text('item1');
            $table->text('item2');
            $table->text('item3');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('about_us_translations'); }
};
