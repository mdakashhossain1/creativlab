<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('email_templates')->where('id', 9)->exists()) {
            return;
        }

        DB::table('email_templates')->insert([
            'id'          => 9,
            'name'        => 'Client Project Created',
            'subject'     => 'New Project Assigned: {{project_name}}',
            'description' => '<p>Hi <strong>{{name}}</strong>,</p>
<p>A new project has been created for you. Please find the details below.</p>
<table style="width:100%;border-collapse:collapse;margin-bottom:20px;">
  <tr><td style="padding:6px 0;color:#666;width:45%;">Project Name</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{project_name}}</td></tr>
  <tr><td style="padding:6px 0;color:#666;">Project Title</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{project_title}}</td></tr>
  <tr><td style="padding:6px 0;color:#666;">Total Price</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{total_price}}</td></tr>
  <tr><td style="padding:6px 0;color:#666;">Payment Type</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{payment_type}}</td></tr>
  <tr><td style="padding:6px 0;color:#666;">Start Date</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{start_date}}</td></tr>
  <tr><td style="padding:6px 0;color:#666;">End Date</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{end_date}}</td></tr>
</table>
<p>You can view your project and upcoming payment schedule in your dashboard.</p>
<p><a href="{{dashboard_url}}" style="display:inline-block;padding:10px 24px;background:#794AFF;color:#fff;text-decoration:none;border-radius:6px;font-weight:600;">View Project</a></p>
<p>If you have any questions, please do not hesitate to contact us.</p>',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('email_templates')->where('id', 9)->delete();
    }
};
