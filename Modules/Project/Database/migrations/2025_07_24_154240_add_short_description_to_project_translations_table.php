<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create partners table
        if (!Schema::hasTable('partners')) {
            Schema::create('partners', function (Blueprint $table) {
                $table->id();
                $table->string('logo');
                $table->string('home_three_icon')->nullable();
                $table->string('home_four_icon')->nullable();
                $table->string('home_six_icon')->nullable();
                $table->text('link')->nullable();
                $table->enum('status', ['enable', 'disable'])->default('enable');
                $table->timestamps();
            });
        } else {
            // Add missing columns if table already exists
            Schema::table('partners', function (Blueprint $table) {
                if (!Schema::hasColumn('partners', 'home_three_icon')) {
                    $table->string('home_three_icon')->nullable()->after('logo');
                }
                if (!Schema::hasColumn('partners', 'home_four_icon')) {
                    $table->string('home_four_icon')->nullable()->after('home_three_icon');
                }
                if (!Schema::hasColumn('partners', 'home_six_icon')) {
                    $table->string('home_six_icon')->nullable()->after('home_four_icon');
                }
            });
        }

        // Add short_description to project_translations
        if (Schema::hasTable('project_translations') && !Schema::hasColumn('project_translations', 'short_description')) {
            Schema::table('project_translations', function (Blueprint $table) {
                $table->string('short_description')->nullable()->after('title');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
