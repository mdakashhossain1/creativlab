<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('frontends', 'data_translations')) {
            Schema::table('frontends', function (Blueprint $table) {
                $table->longText('data_translations')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('frontends', function (Blueprint $table) {
            $table->dropColumn('data_translations');
        });
    }
};
