<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice #{{ $installment->invoice_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f7; margin: 0; padding: 0; color: #333; }
        .wrapper { max-width: 620px; margin: 40px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #794AFF; padding: 32px 40px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 28px; letter-spacing: 4px; }
        .header p { color: rgba(255,255,255,.8); margin: 6px 0 0; font-size: 14px; }
        .body { padding: 32px 40px; }
        .meta { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 16px; margin-bottom: 28px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .meta-block p { margin: 0 0 4px; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: .5px; }
        .meta-block strong { font-size: 15px; color: #333; }
        .section-title { font-size: 13px; color: #888; text-transform: uppercase; letter-spacing: .5px; margin: 0 0 10px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 28px; }
        .info-table td { padding: 8px 0; font-size: 14px; border-bottom: 1px solid #f0f0f0; }
        .info-table td:first-child { color: #666; width: 45%; }
        .info-table td:last-child { font-weight: 600; text-align: right; }
        .total-row td { font-size: 17px; font-weight: 700; color: #794AFF; border-bottom: none; padding-top: 14px; }
        .badge { display: inline-block; padding: 3px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #e6f9f0; color: #1a9e5e; }
        .footer { background: #f8f8fb; padding: 24px 40px; text-align: center; }
        .footer p { margin: 0; font-size: 13px; color: #888; }
        .footer strong { color: #794AFF; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>INVOICE</h1>
            <p>{{ config('app.name') }}</p>
        </div>

        <div class="body">
            {{-- Invoice meta --}}
            <div class="meta">
                <div class="meta-block">
                    <p>Invoice Number</p>
                    <strong>{{ $installment->invoice_number }}</strong>
                </div>
                <div class="meta-block">
                    <p>Date</p>
                    <strong>{{ $installment->paid_at?->format('d M Y') ?? now()->format('d M Y') }}</strong>
                </div>
                <div class="meta-block">
                    <p>Status</p>
                    <span class="badge badge-success">Paid</span>
                </div>
            </div>

            {{-- Bill To --}}
            <p class="section-title">Bill To</p>
            <table class="info-table" style="margin-bottom: 20px;">
                <tr>
                    <td>Name</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
            </table>

            {{-- Project Details --}}
            <p class="section-title">Project</p>
            <table class="info-table" style="margin-bottom: 20px;">
                <tr>
                    <td>Project Name</td>
                    <td>{{ $project->name }}</td>
                </tr>
                <tr>
                    <td>Project Title</td>
                    <td>{{ $project->title }}</td>
                </tr>
                <tr>
                    <td>Payment</td>
                    <td>Payment {{ $installment->installment_number }} of {{ $project->installments->count() }}</td>
                </tr>
            </table>

            {{-- Line Items --}}
            <p class="section-title">Payment Breakdown</p>
            <table class="info-table">
                <tr>
                    <td>Base Amount</td>
                    <td>{{ number_format($installment->base_amount, 2) }}</td>
                </tr>
                @if ($installment->gst_amount > 0)
                <tr>
                    <td>GST Amount ({{ $project->gst_percent }}%)</td>
                    <td>{{ number_format($installment->gst_amount, 2) }}</td>
                </tr>
                @endif
                <tr>
                    <td>Payment Method</td>
                    <td>{{ $installment->payment_method ?? '—' }}</td>
                </tr>
                @if ($installment->transaction_id)
                <tr>
                    <td>Transaction ID</td>
                    <td>{{ $installment->transaction_id }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td>Total Paid</td>
                    <td>{{ number_format($installment->total_amount, 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for your payment, <strong>{{ $user->name }}</strong>!</p>
            <p style="margin-top: 8px;">If you have any questions regarding this invoice, please contact us.</p>
            <p style="margin-top: 16px; font-size: 12px;">&copy; {{ date('Y') }} <strong>{{ config('app.name') }}</strong>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
