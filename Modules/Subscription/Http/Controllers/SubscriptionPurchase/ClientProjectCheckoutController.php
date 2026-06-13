<?php

namespace Modules\Subscription\Http\Controllers\SubscriptionPurchase;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Currency\App\Models\Currency;
use Modules\PaymentGateway\App\Models\PaymentGateway;
use Modules\SeoSetting\App\Models\SeoSetting;
use Modules\Subscription\Entities\ClientProjectInstallment;

class ClientProjectCheckoutController extends Controller
{
    public $payment_setting;

    public function __construct()
    {
        $payment_data = PaymentGateway::all();
        $this->payment_setting = array();
        foreach ($payment_data as $data_item) {
            $payment_setting[$data_item->key] = $data_item->value;
        }
        $this->payment_setting = (object) $payment_setting;
    }

    public function payInstallment($installmentId)
    {
        $installment = ClientProjectInstallment::with('project')->findOrFail($installmentId);
        $project     = $installment->project;

        // Ownership check
        if ($project->user_id !== Auth::id()) {
            abort(403, trans('Unauthorized'));
        }

        // Must be pending
        if ($installment->status !== 'pending') {
            return redirect()->route('user.client-projects.show', $project->id)
                ->with(['messege' => trans('This installment is not pending'), 'alert-type' => 'error']);
        }

        // Set session data
        session([
            'clientProjectOrderData' => [
                'installment_id' => $installment->id,
                'project_id'     => $project->id,
                'project_name'   => $project->name,
                'subtotal'       => (float) $installment->base_amount,
                'gst'            => (float) $installment->gst_amount,
                'total'          => (float) $installment->total_amount,
            ],
        ]);

        $breadcrumb     = 'Project Payment';
        $seo_setting    = SeoSetting::first();
        $cta_content    = getContent('template_1_cta.content', true);
        $user           = Auth::guard('web')->user();
        $payment_setting = $this->payment_setting;
        $payable_amount = $installment->total_amount;
        $currency_code  = Session::get('currency_code');

        $paypal      = PaymentGateway::where(['key' => 'paypal_currency_id'])->first();
        $stripe      = PaymentGateway::where(['key' => 'stripe_currency_id'])->first();
        $paypalStatus = PaymentGateway::where('key', 'paypal_status')->value('value');
        $razorpay    = PaymentGateway::where(['key' => 'razorpay_currency_id'])->first();
        $paystack    = PaymentGateway::where(['key' => 'paystack_currency_id'])->first();
        $instamojo   = PaymentGateway::where(['key' => 'instamojo_currency_id'])->first();
        $bank        = PaymentGateway::where(['key' => 'bank_status'])->first();

        $razorpay_currency = isset($this->payment_setting->razorpay_currency_id)
            ? Currency::find($this->payment_setting->razorpay_currency_id)
            : null;

        $paystack_currency = isset($this->payment_setting->paystack_currency_id)
            ? Currency::find($this->payment_setting->paystack_currency_id)
            : null;

        return view('subscription::frontend.client-project-payment', compact(
            'breadcrumb',
            'paypalStatus',
            'user',
            'seo_setting',
            'paypal',
            'stripe',
            'razorpay',
            'paystack',
            'instamojo',
            'bank',
            'payment_setting',
            'razorpay_currency',
            'payable_amount',
            'paystack_currency',
            'cta_content',
            'installment',
            'project'
        ));
    }
}
