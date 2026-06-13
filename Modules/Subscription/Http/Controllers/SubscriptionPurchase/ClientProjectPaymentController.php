<?php

namespace Modules\Subscription\Http\Controllers\SubscriptionPurchase;

use App\Constants\Status;
use App\Helper\EmailHelper;
use App\Http\Controllers\Controller;
use App\Mail\ClientProjectInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Modules\Currency\App\Models\Currency;
use Modules\PaymentGateway\App\Models\PaymentGateway;
use Modules\Subscription\Entities\ClientProjectInstallment;
use Razorpay\Api\Api;
use Stripe;

class ClientProjectPaymentController extends Controller
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

    private function recordPayment(string $method, string $transactionId, string $status): void
    {
        $orderData   = session()->get('clientProjectOrderData');
        $installment = ClientProjectInstallment::findOrFail($orderData['installment_id']);

        $installment->status         = ($status === 'approved') ? 'paid' : 'pending';
        $installment->payment_method = $method;
        $installment->transaction_id = $transactionId;
        $installment->invoice_number = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), 0, 8));
        $installment->paid_at        = now();
        $installment->save();

        $this->sendInvoiceEmail($installment);

        Session::forget('clientProjectOrderData');
    }

    private function sendInvoiceEmail(ClientProjectInstallment $installment): void
    {
        try {
            $installment->loadMissing('project.user');
            $project = $installment->project;
            $user    = $project->user;

            EmailHelper::mail_setup();
            Mail::to($user->email)->send(new ClientProjectInvoice($installment, $project, $user));
        } catch (\Exception $e) {
            Log::error('ClientProject invoice mail error: ' . $e->getMessage());
        }
    }

    public function stripe(Request $request)
    {
        if (env('APP_MODE') == 'DEMO') {
            return redirect()->back()->with([
                'messege'    => trans('This Is Demo Version. You Can Not Change Anything'),
                'alert-type' => 'error',
            ]);
        }

        try {
            $user      = Auth::guard('web')->user();
            $orderData = session()->get('clientProjectOrderData');
            if (!$user || !$orderData) {
                throw new \Exception(trans('Invalid session or user'));
            }

            $stripeCurrency = Currency::findOrFail($this->payment_setting->stripe_currency_id);
            $payable_amount = round($orderData['total'] * $stripeCurrency->currency_rate, 2);

            Stripe\Stripe::setApiKey($this->payment_setting->stripe_secret);
            $result = Stripe\Charge::create([
                'amount'      => (int) ($payable_amount * 100),
                'currency'    => $stripeCurrency->currency_code,
                'source'      => $request->stripeToken,
                'description' => env('APP_NAME') . ' Project Payment',
            ]);

            $this->recordPayment('Stripe', $result->balance_transaction, 'approved');

            return redirect()->route('user.client-projects.index')
                ->with(['messege' => trans('Your payment has been made successfully.'), 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'messege'    => $e->getMessage() ?? trans('Something went wrong, please try again'),
                'alert-type' => 'error',
            ]);
        }
    }

    public function bank(Request $request)
    {
        if (env('APP_MODE') == 'DEMO') {
            return redirect()->back()->with([
                'messege'    => trans('This Is Demo Version. You Can Not Change Anything'),
                'alert-type' => 'error',
            ]);
        }

        $request->validate(
            ['tnx_info' => 'required'],
            ['tnx_info.required' => trans('Transaction information is required')]
        );

        $orderData   = session()->get('clientProjectOrderData');
        $installment = ClientProjectInstallment::findOrFail($orderData['installment_id']);

        $installment->status         = 'pending';
        $installment->payment_method = 'Bank_Payment';
        $installment->transaction_id = $request->tnx_info;
        $installment->save();

        Session::forget('clientProjectOrderData');

        return redirect()->route('user.client-projects.index')
            ->with(['messege' => trans('Your payment has been submitted. Please wait for admin approval.'), 'alert-type' => 'success']);
    }

    public function razorpay(Request $request)
    {
        $input = $request->all();
        $api   = new Api($this->payment_setting->razorpay_key, $this->payment_setting->razorpay_secret);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $payment  = $api->payment->fetch($input['razorpay_payment_id']);
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(['amount' => $payment['amount']]);
                $this->recordPayment('Razorpay', $response->id, 'approved');

                return redirect()->route('user.client-projects.index')
                    ->with(['messege' => trans('Your payment has been made successfully.'), 'alert-type' => 'success']);
            } catch (\Exception $e) {
                return redirect()->back()->with([
                    'messege'    => trans('Something went wrong, please try again'),
                    'alert-type' => 'error',
                ]);
            }
        }

        return redirect()->back()->with([
            'messege'    => trans('Something went wrong, please try again'),
            'alert-type' => 'error',
        ]);
    }

    public function paystack(Request $request)
    {
        $reference  = $request->reference;
        $secret_key = $this->payment_setting->paystack_secret_key;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                "Authorization: Bearer $secret_key",
                'Cache-Control: no-cache',
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $final_data = json_decode($response);

        if ($final_data && $final_data->status == true) {
            $this->recordPayment('Paystack', $reference, 'approved');
            return response()->json([
                'status'  => 'success',
                'message' => trans('Your payment has been made successfully.'),
            ]);
        }

        return response()->json([
            'status'  => 'failed',
            'message' => trans('Something went wrong, please try again'),
        ]);
    }

    public function instamojo(Request $request)
    {
        if (env('APP_MODE') == 'DEMO') {
            return redirect()->back()->with([
                'messege'    => trans('This Is Demo Version. You Can Not Change Anything'),
                'alert-type' => 'error',
            ]);
        }

        try {
            $orderData           = session()->get('clientProjectOrderData');
            $instamojo_currency  = Currency::findOrFail($this->payment_setting->instamojo_currency_id);
            $price               = round($orderData['total'] * $instamojo_currency->currency_rate, 2);
            $environment         = $this->payment_setting->instamojo_account_mode;
            $api_key             = $this->payment_setting->instamojo_api_key;
            $auth_token          = $this->payment_setting->instamojo_auth_token;

            if (empty($api_key) || empty($auth_token)) {
                throw new \Exception('Instamojo API credentials are missing');
            }

            $url = ($environment === 'Sandbox')
                ? 'https://test.instamojo.com/api/1.1/'
                : 'https://www.instamojo.com/api/1.1/';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url . 'payment-requests/');
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "X-Api-Key: $api_key",
                "X-Auth-Token: $auth_token",
                'Content-Type: application/x-www-form-urlencoded',
            ]);

            $payload = [
                'purpose'                => env('APP_NAME') . ' Project Payment',
                'amount'                 => $price,
                'phone'                  => Auth::user()->phone,
                'buyer_name'             => Auth::user()->name,
                'redirect_url'           => route('user.client-projects.instamojo.response'),
                'send_email'             => true,
                'email'                  => Auth::user()->email,
                'allow_repeated_payments' => false,
            ];

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

            $response    = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($http_status !== 200) {
                throw new \Exception('Invalid API response (Status: ' . $http_status . ')');
            }

            $response_data = json_decode($response);
            if (!$response_data || !isset($response_data->payment_request)) {
                throw new \Exception('Invalid API response format');
            }

            return redirect($response_data->payment_request->longurl);
        } catch (\Exception $e) {
            Log::error('ClientProject Instamojo Error: ' . $e->getMessage());
            return redirect()->back()->with([
                'messege'    => 'Payment initialization failed: ' . $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }

    public function instamojoResponse(Request $request)
    {
        $environment = $this->payment_setting->instamojo_account_mode;
        $api_key     = $this->payment_setting->instamojo_api_key;
        $auth_token  = $this->payment_setting->instamojo_auth_token;
        $url         = ($environment === 'Sandbox')
            ? 'https://test.instamojo.com/api/1.1/'
            : 'https://www.instamojo.com/api/1.1/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . 'payments/' . $request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-Api-Key:$api_key", "X-Auth-Token:$auth_token"]);
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return redirect()->back()->with([
                'messege'    => trans('Something went wrong, please try again'),
                'alert-type' => 'error',
            ]);
        }

        $data = json_decode($response);
        if ($data && $data->success == true && $data->payment->status === 'Credit') {
            $this->recordPayment('Instamojo', $request->get('payment_id'), 'approved');
            return redirect()->route('user.client-projects.index')
                ->with(['messege' => trans('Your payment has been made successfully.'), 'alert-type' => 'success']);
        }

        return redirect()->back()->with([
            'messege'    => trans('Something went wrong, please try again'),
            'alert-type' => 'error',
        ]);
    }

    public function paypal(Request $request)
    {
        // PayPal redirect handled by gateway — session-aware
        $orderData = session()->get('clientProjectOrderData');
        if (!$orderData) {
            return redirect()->route('user.client-projects.index')
                ->with(['messege' => trans('Session expired, please try again'), 'alert-type' => 'error']);
        }

        $paypalCurrency = Currency::find($this->payment_setting->paypal_currency_id);
        $amount         = round($orderData['total'] * ($paypalCurrency->currency_rate ?? 1), 2);

        $paypal = new \PayPalCheckoutSdk\Core\PayPalHttpClient(
            env('APP_ENV') === 'production'
                ? new \PayPalCheckoutSdk\Core\ProductionEnvironment(
                    $this->payment_setting->paypal_client_id,
                    $this->payment_setting->paypal_secret_key
                )
                : new \PayPalCheckoutSdk\Core\SandboxEnvironment(
                    $this->payment_setting->paypal_client_id,
                    $this->payment_setting->paypal_secret_key
                )
        );

        $paypalRequest = new \PayPalCheckoutSdk\Orders\OrdersCreateRequest();
        $paypalRequest->prefer('return=representation');
        $paypalRequest->body = [
            'intent'              => 'CAPTURE',
            'purchase_units'      => [[
                'amount' => [
                    'currency_code' => strtoupper($paypalCurrency->currency_code ?? 'USD'),
                    'value'         => $amount,
                ],
            ]],
            'application_context' => [
                'return_url' => route('user.client-projects.paypal.success'),
                'cancel_url' => route('user.client-projects.paypal.failed'),
            ],
        ];

        try {
            $response = $paypal->execute($paypalRequest);
            foreach ($response->result->links as $link) {
                if ($link->rel === 'approve') {
                    return redirect($link->href);
                }
            }
        } catch (\Exception $e) {
            Log::error('ClientProject PayPal Error: ' . $e->getMessage());
            return redirect()->back()->with([
                'messege'    => trans('PayPal initialization failed'),
                'alert-type' => 'error',
            ]);
        }

        return redirect()->back()->with([
            'messege'    => trans('Something went wrong with PayPal'),
            'alert-type' => 'error',
        ]);
    }

    public function paypalSuccess(Request $request)
    {
        try {
            $paypalCurrency = Currency::find($this->payment_setting->paypal_currency_id);
            $paypal         = new \PayPalCheckoutSdk\Core\PayPalHttpClient(
                env('APP_ENV') === 'production'
                    ? new \PayPalCheckoutSdk\Core\ProductionEnvironment(
                        $this->payment_setting->paypal_client_id,
                        $this->payment_setting->paypal_secret_key
                    )
                    : new \PayPalCheckoutSdk\Core\SandboxEnvironment(
                        $this->payment_setting->paypal_client_id,
                        $this->payment_setting->paypal_secret_key
                    )
            );

            $captureRequest = new \PayPalCheckoutSdk\Orders\OrdersCaptureRequest($request->token);
            $response       = $paypal->execute($captureRequest);

            if ($response->result->status === 'COMPLETED') {
                $this->recordPayment('PayPal', $response->result->id, 'approved');
                return redirect()->route('user.client-projects.index')
                    ->with(['messege' => trans('Your payment has been made successfully.'), 'alert-type' => 'success']);
            }
        } catch (\Exception $e) {
            Log::error('ClientProject PayPal capture error: ' . $e->getMessage());
        }

        return redirect()->route('user.client-projects.index')
            ->with(['messege' => trans('PayPal payment failed'), 'alert-type' => 'error']);
    }

    public function paypalFailed(Request $request)
    {
        return redirect()->route('user.client-projects.index')
            ->with(['messege' => trans('PayPal payment was cancelled'), 'alert-type' => 'error']);
    }
}
