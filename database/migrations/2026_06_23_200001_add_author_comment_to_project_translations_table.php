<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_translations', function (Blueprint $table) {
            if (!Schema::hasColumn('project_translations', 'author_comment')) {
                $table->text('author_comment')->nullable()->after('seo_description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('project_translations', function (Blueprint $table) {
            if (Schema::hasColumn('project_translations', 'author_comment')) {
                $table->dropColumn('author_comment');
            }
        });
    }
};
