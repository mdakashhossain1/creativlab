<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('email_templates')->where('id', 10)->exists()) {
            return;
        }

        DB::table('email_templates')->insert([
            'id'          => 10,
            'name'        => 'User Welcome Email',
            'subject'     => 'Welcome to CreativLab!',
            'description' => '<p>Dear <strong>{{user_name}}</strong>,</p>
<p>Welcome to <strong>CreativLab</strong>! We\'re thrilled to have you on board.</p>
<p>Your account has been successfully created. You can now log in and start exploring everything we have to offer.</p>
<p>If you ever need help, our support team is always happy to assist.</p>
<p>Best regards,<br>The CreativLab Team</p>',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('email_templates')->where('id', 10)->delete();
    }
};
