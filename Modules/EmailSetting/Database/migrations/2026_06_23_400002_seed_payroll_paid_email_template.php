<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('email_templates')->where('id', 11)->exists()) {
            return;
        }

        DB::table('email_templates')->insert([
            'id'          => 11,
            'name'        => 'Salary Payment Confirmation',
            'subject'     => 'Salary Paid — {{month_year}}',
            'description' => '<p>Dear <strong>{{name}}</strong>,</p>
<p>We are pleased to inform you that your salary for <strong>{{month_year}}</strong> has been processed and paid.</p>
<table style="width:100%;border-collapse:collapse;margin:16px 0;">
  <tr style="border-bottom:1px solid #eee;">
    <td style="padding:8px 0;color:#666;width:50%;">Designation</td>
    <td style="padding:8px 0;font-weight:600;text-align:right;">{{designation}}</td>
  </tr>
  <tr style="border-bottom:1px solid #eee;">
    <td style="padding:8px 0;color:#666;">Base Salary</td>
    <td style="padding:8px 0;font-weight:600;text-align:right;">{{base_salary}}</td>
  </tr>
  <tr style="border-bottom:1px solid #eee;">
    <td style="padding:8px 0;color:#666;">Bonus</td>
    <td style="padding:8px 0;font-weight:600;text-align:right;">{{bonus}}</td>
  </tr>
  <tr style="border-bottom:1px solid #eee;">
    <td style="padding:8px 0;color:#666;">Deductions</td>
    <td style="padding:8px 0;font-weight:600;text-align:right;">{{deductions}}</td>
  </tr>
  <tr>
    <td style="padding:8px 0;color:#333;font-weight:700;">Net Salary</td>
    <td style="padding:8px 0;font-weight:700;text-align:right;">{{net_salary}}</td>
  </tr>
</table>
<p><strong>Date Paid:</strong> {{paid_date}}</p>
<p>If you have any questions about this payment, please contact the admin.</p>
<p>Best regards,<br>CreativLab Team</p>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('email_templates')->where('id', 11)->delete();
    }
};
