<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('portfolio_categories')) {
            Schema::create('portfolio_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('portfolio_items')) {
            Schema::create('portfolio_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('portfolio_category_id')->constrained()->onDelete('cascade');
                $table->string('type'); // image | video | bunny
                $table->text('content_source'); // image URL, direct video URL, or Bunny embed URL
                $table->string('thumbnail')->nullable(); // thumbnail for video/bunny cards
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
        Schema::dropIfExists('portfolio_categories');
    }
};
