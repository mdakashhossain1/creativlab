<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $exists = DB::table('email_templates')->where('id', 7)->exists();

        if (!$exists) {
            DB::table('email_templates')->insert([
                'id'          => 7,
                'name'        => 'Digital Product Delivery',
                'subject'     => 'Your Download Is Ready — Order #{{order_id}}',
                'description' => '<p>Hi <strong>{{name}}</strong>,</p>
<p>Thank you for your purchase! Your digital product(s) are ready. Please find your download link(s) below.</p>
<p><strong>Order ID:</strong> {{order_id}}<br>
<strong>Amount Paid:</strong> {{amount}}<br>
<strong>Payment Method:</strong> {{payment_method}}</p>
<p>{{download_links}}</p>
<p>These links are also permanently available in your <a href="{{dashboard_url}}">dashboard</a> for future re-downloads.</p>
<p>Thank you for shopping with us!</p>',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('email_templates')->where('id', 7)->delete();
    }
};
