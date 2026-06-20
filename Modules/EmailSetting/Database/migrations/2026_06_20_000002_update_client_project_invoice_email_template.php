<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('email_templates')->where('id', 8)->update([
            'description' => '
<div style="font-family:Arial,sans-serif;max-width:620px;margin:0 auto;background:#ffffff;">

  <!-- Header -->
  <div style="background:#794AFF;padding:36px 40px;border-radius:10px 10px 0 0;text-align:center;">
    <h1 style="margin:0;color:#ffffff;font-size:26px;font-weight:700;letter-spacing:-0.5px;">Payment Invoice</h1>
    <p style="margin:8px 0 0;color:rgba(255,255,255,0.8);font-size:14px;">Thank you for your payment!</p>
  </div>

  <!-- Body -->
  <div style="padding:36px 40px;background:#ffffff;border:1px solid #e8e8e8;border-top:none;">

    <p style="margin:0 0 24px;font-size:15px;color:#374151;">Hi <strong>{{name}}</strong>,</p>
    <p style="margin:0 0 28px;font-size:15px;color:#374151;line-height:1.6;">
      Your payment has been received and the invoice is ready. Please find the details below.
    </p>

    <!-- Invoice Meta -->
    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-bottom:28px;background:#f9f5ff;border-radius:10px;overflow:hidden;">
      <tr>
        <td style="padding:12px 20px;font-size:13px;color:#6b7280;width:45%;border-bottom:1px solid #ede9fe;">Invoice Number</td>
        <td style="padding:12px 20px;font-size:13px;font-weight:700;color:#101828;text-align:right;border-bottom:1px solid #ede9fe;">{{invoice_number}}</td>
      </tr>
      <tr>
        <td style="padding:12px 20px;font-size:13px;color:#6b7280;border-bottom:1px solid #ede9fe;">Date Paid</td>
        <td style="padding:12px 20px;font-size:13px;font-weight:600;color:#101828;text-align:right;border-bottom:1px solid #ede9fe;">{{paid_date}}</td>
      </tr>
      <tr>
        <td style="padding:12px 20px;font-size:13px;color:#6b7280;border-bottom:1px solid #ede9fe;">Email</td>
        <td style="padding:12px 20px;font-size:13px;font-weight:600;color:#101828;text-align:right;border-bottom:1px solid #ede9fe;">{{email}}</td>
      </tr>
      <tr>
        <td style="padding:12px 20px;font-size:13px;color:#6b7280;border-bottom:1px solid #ede9fe;">Project</td>
        <td style="padding:12px 20px;font-size:13px;font-weight:600;color:#101828;text-align:right;border-bottom:1px solid #ede9fe;">{{project_name}} — {{project_title}}</td>
      </tr>
      <tr>
        <td style="padding:12px 20px;font-size:13px;color:#6b7280;border-bottom:1px solid #ede9fe;">Installment</td>
        <td style="padding:12px 20px;font-size:13px;font-weight:600;color:#101828;text-align:right;border-bottom:1px solid #ede9fe;">{{installment_info}}</td>
      </tr>
      <tr>
        <td style="padding:12px 20px;font-size:13px;color:#6b7280;">Payment Method</td>
        <td style="padding:12px 20px;font-size:13px;font-weight:600;color:#101828;text-align:right;">{{payment_method}}</td>
      </tr>
    </table>

    <!-- Payment Breakdown -->
    <h3 style="margin:0 0 14px;font-size:15px;font-weight:700;color:#101828;">Payment Breakdown</h3>
    {{payment_breakdown}}

    <!-- Divider -->
    <hr style="border:none;border-top:1px solid #e8e8e8;margin:28px 0;">

    <p style="margin:0;font-size:14px;color:#6b7280;line-height:1.6;">
      Thank you for your payment! If you have any questions, please do not hesitate to contact us.
    </p>

  </div>

  <!-- Footer -->
  <div style="background:#f9fafb;padding:20px 40px;border-radius:0 0 10px 10px;border:1px solid #e8e8e8;border-top:none;text-align:center;">
    <p style="margin:0;font-size:12px;color:#9ca3af;">This is an automated invoice email. Please do not reply directly to this email.</p>
  </div>

</div>',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // restore original is not needed — leave as-is on rollback
    }
};
