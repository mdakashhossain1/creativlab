<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!DB::table('email_templates')->where('id', 12)->exists()) {
            DB::table('email_templates')->insert([
                'id'          => 12,
                'name'        => 'Task Meeting Reminder',
                'subject'     => 'Reminder: {{title}} — meeting in {{minutes_left}} min',
                'description' => '<p>Hi,</p><p>This is a reminder that your scheduled meeting <strong>{{title}}</strong> is coming up in <strong>{{minutes_left}} minutes</strong> at <strong>{{meeting_time}}</strong>.</p><p>{{description}}</p><p>— CreativLab Task System</p>',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        if (!DB::table('email_templates')->where('id', 13)->exists()) {
            DB::table('email_templates')->insert([
                'id'          => 13,
                'name'        => 'Task Meeting Starting Now',
                'subject'     => 'Meeting Now: {{title}}',
                'description' => '<p>Hi,</p><p>Your scheduled meeting <strong>{{title}}</strong> is starting now (<strong>{{meeting_time}}</strong>).</p><p>{{description}}</p><p>— CreativLab Task System</p>',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('email_templates')->whereIn('id', [12, 13])->delete();
    }
};
