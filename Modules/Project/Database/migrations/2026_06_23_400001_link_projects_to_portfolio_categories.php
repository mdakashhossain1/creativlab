<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add portfolio_category_id to projects (replaces category_id / sub_category_id)
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('portfolio_category_id')->nullable()->after('id');
        });

        // Add project_id to portfolio_items so items belong to a project
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable()->after('portfolio_category_id');
            $table->index('project_id');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('portfolio_category_id');
        });

        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropIndex(['project_id']);
            $table->dropColumn('project_id');
        });
    }
};
