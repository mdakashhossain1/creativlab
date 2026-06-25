<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('business_email_accounts', function (Blueprint $table) {
            $table->string('imap_host')->nullable()->after('encryption');
            $table->unsignedSmallInteger('imap_port')->default(993)->after('imap_host');
            $table->string('imap_encryption', 10)->default('ssl')->after('imap_port');
        });
    }

    public function down(): void
    {
        Schema::table('business_email_accounts', function (Blueprint $table) {
            $table->dropColumn(['imap_host', 'imap_port', 'imap_encryption']);
        });
    }
};
