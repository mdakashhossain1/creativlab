<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('email_templates')->where('id', 8)->exists()) {
            return;
        }

        DB::table('email_templates')->insert([
            'id'          => 8,
            'name'        => 'Client Project Invoice',
            'subject'     => 'Invoice #{{invoice_number}} — {{project_name}}',
            'description' => '<p>Hi <strong>{{name}}</strong>,</p>
<p>Your payment has been received and the invoice is ready. Please find the details below.</p>
<table style="width:100%;border-collapse:collapse;margin-bottom:20px;">
  <tr><td style="padding:6px 0;color:#666;width:45%;">Invoice Number</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{invoice_number}}</td></tr>
  <tr><td style="padding:6px 0;color:#666;">Date Paid</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{paid_date}}</td></tr>
  <tr><td style="padding:6px 0;color:#666;">Email</td><td style="padding:6px 0;font-weight:600;text-align:right;">{{email}}</td></tr>
</table>
<p><strong>Project:</strong> {{project_name}} — {{project_title}}<br>
<strong>Installment:</strong> {{installment_info}}</p>
<p>{{payment_breakdown}}</p>
<p>Thank you for your payment! If you have any questions, please contact us.</p>',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('email_templates')->where('id', 8)->delete();
    }
};
