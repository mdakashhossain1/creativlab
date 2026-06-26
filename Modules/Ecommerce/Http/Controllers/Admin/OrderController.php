<?php

namespace Modules\Ecommerce\Http\Controllers\Admin;

use App\Constants\Status;
use App\Helper\EmailHelper;
use App\Http\Controllers\Controller;
use App\Mail\DigitalProductDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Ecommerce\Entities\Order;
use Modules\Ecommerce\Entities\OrderDetail;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::with('order_detail.singleProduct.translate')->latest()->get();
        return view('ecommerce::admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('ecommerce::admin.orders.view', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $wasApproved = $order->payment_status == Status::APPROVED;
        $order->order_status = $request->input('order_status');
        $order->payment_status = $request->input('payment_status');
        $order->save();

        if (!$wasApproved && $order->payment_status == Status::APPROVED) {
            $this->dispatchDigitalDelivery($order);
        }

        $notification=  trans('Status updated successfully');
        $notification=array('message'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    public function paymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $wasApproved = $order->payment_status == Status::APPROVED;
        $order->payment_status = $request->input('payment_status');
        $order->save();

        if (!$wasApproved && $order->payment_status == Status::APPROVED) {
            $this->dispatchDigitalDelivery($order);
        }

        $notification=  trans('Payment status updated successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return back()->with($notification);
    }

    private function dispatchDigitalDelivery(Order $order): void
    {
        $digitalItems = OrderDetail::with('singleProduct')
            ->where('order_id', $order->id)
            ->whereHas('singleProduct', fn($q) => $q->where('is_digital', true))
            ->whereNull('download_token')
            ->get();

        if ($digitalItems->isEmpty()) {
            return;
        }

        foreach ($digitalItems as $item) {
            $item->update(['download_token' => hash('sha256', Str::random(40))]);
        }

        $digitalItems = $digitalItems->fresh('singleProduct');

        try {
            EmailHelper::mail_setup();

            $template = \Modules\EmailSetting\App\Models\EmailTemplate::find(7);
            if (!$template) {
                return;
            }

            $user = $order->user;
            $downloadLinksHtml = $this->buildDownloadLinksHtml($digitalItems);

            $subject = str_replace('{{order_id}}', $order->order_id, $template->subject);

            $message = $template->description;
            $message = str_replace('{{name}}',           $user->name,                  $message);
            $message = str_replace('{{order_id}}',       $order->order_id,             $message);
            $message = str_replace('{{amount}}',         currency($order->total),       $message);
            $message = str_replace('{{payment_method}}', $order->payment_method,        $message);
            $message = str_replace('{{download_links}}', $downloadLinksHtml,            $message);
            $message = str_replace('{{dashboard_url}}',  url('/user/downloads'),        $message);

            Mail::to($user->email)->send(new DigitalProductDelivery($message, $subject));
        } catch (\Exception $e) {
            \Log::error('Digital delivery mail error (admin approval): ' . $e->getMessage());
        }
    }

    private function buildDownloadLinksHtml($digitalItems): string
    {
        $html  = '<table style="width:100%;border-collapse:collapse;">';
        $html .= '<thead><tr style="background:#f4f4f4;">';
        $html .= '<th style="padding:8px 12px;text-align:left;border:1px solid #e0e0e0;">Product</th>';
        $html .= '<th style="padding:8px 12px;text-align:center;border:1px solid #e0e0e0;">Download</th>';
        $html .= '</tr></thead><tbody>';

        foreach ($digitalItems as $item) {
            $productName = $item->singleProduct->translate->name ?? $item->singleProduct->slug ?? 'Product';
            $downloadUrl = url('/user/downloads/' . $item->download_token);
            $html .= '<tr>';
            $html .= '<td style="padding:10px 12px;border:1px solid #e0e0e0;">' . e($productName) . '</td>';
            $html .= '<td style="padding:10px 12px;text-align:center;border:1px solid #e0e0e0;">';
            $html .= '<a href="' . $downloadUrl . '" style="display:inline-block;padding:8px 18px;background:#794AFF;color:#fff;text-decoration:none;border-radius:5px;font-size:13px;font-weight:600;">Download</a>';
            $html .= '</td></tr>';
        }

        $html .= '</tbody></table>';
        return $html;
    }

}
