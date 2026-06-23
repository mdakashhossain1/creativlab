<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('email_verified_at');
            }
            if (!Schema::hasColumn('users', 'is_seller')) {
                $table->string('is_seller')->default(0)->after('is_banned');
            }
            if (!Schema::hasColumn('users', 'online_status')) {
                $table->string('online_status')->default(0);
            }
            if (!Schema::hasColumn('users', 'feez_status')) {
                $table->string('feez_status')->default(0);
            }
            if (!Schema::hasColumn('users', 'online')) {
                $table->boolean('online')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_filter(
                ['avatar', 'is_seller', 'online_status', 'feez_status', 'online'],
                fn($col) => Schema::hasColumn('users', $col)
            ));
        });
    }
};
