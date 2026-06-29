<?php

namespace Modules\PaymentGateway\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\PaymentGateway\App\Models\PaymentGateway;
use Modules\PaymentGateway\App\Http\Requests\BankRequest;
use Modules\PaymentGateway\App\Http\Requests\PaypalRequest;
use Modules\PaymentGateway\App\Http\Requests\StripeRequest;
use Modules\PaymentGateway\App\Http\Requests\PaystackRequest;
use Modules\PaymentGateway\App\Http\Requests\RazorpayRequest;
use Modules\PaymentGateway\App\Http\Requests\InstamojoRequest;


class PaymentGatewayController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_data = PaymentGateway::all();


        $payment_setting = array();

        foreach($payment_data as $data_item){
            $payment_setting[$data_item->key] = $data_item->value;
        }

        $payment_setting = (object) $payment_setting;


        return view('paymentgateway::index', ['payment_setting' => $payment_setting]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function update_stripe(StripeRequest $request)
    {
        PaymentGateway::where('key', 'stripe_currency_id')->update(['value' => $request->currency_id]);
        PaymentGateway::where('key', 'stripe_key')->update(['value' => $request->stripe_key]);
        PaymentGateway::where('key', 'stripe_secret')->update(['value' => $request->stripe_secret]);
        PaymentGateway::where('key', 'stripe_status')->update(['value' => $request->status ? 1 : 0]);

        $exist_image = PaymentGateway::where('key', 'stripe_image')->first();

        if($request->image){
            $old_image = $exist_image->value;
            $exist_image->value = app(\App\Services\UploadManager::class)->upload($request->image, 'uploads/website-images', ['prefix' => 'stripe']);
            $exist_image->save();
            if($old_image){
                app(\App\Services\UploadManager::class)->delete($old_image);
            }
        }


        $notify_message = trans('Updated successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }


    public function update_paypal(PaypalRequest $request)
    {
        PaymentGateway::where('key', 'paypal_account_mode')->update(['value' => $request->account_mode]);
        PaymentGateway::where('key', 'paypal_currency_id')->update(['value' => $request->currency_id]);
        PaymentGateway::where('key', 'paypal_client_id')->update(['value' => $request->paypal_client_id]);
        PaymentGateway::where('key', 'paypal_secret_key')->update(['value' => $request->paypal_secret_key]);
        PaymentGateway::where('key', 'paypal_status')->update(['value' => $request->status ? 1 : 0]);

        $exist_image = PaymentGateway::where('key', 'paypal_image')->first();

        if($request->image){
            $old_image = $exist_image->value;
            $exist_image->value = app(\App\Services\UploadManager::class)->upload($request->image, 'uploads/website-images', ['prefix' => 'paypal']);
            $exist_image->save();
            if($old_image){
                app(\App\Services\UploadManager::class)->delete($old_image);
            }
        }


        $notify_message = trans('Updated successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function update_razorpay(RazorpayRequest $request)
    {
        PaymentGateway::where('key', 'razorpay_currency_id')->update(['value' => $request->currency_id]);
        PaymentGateway::where('key', 'razorpay_key')->update(['value' => $request->razorpay_key]);
        PaymentGateway::where('key', 'razorpay_secret')->update(['value' => $request->razorpay_secret]);
        PaymentGateway::where('key', 'razorpay_name')->update(['value' => $request->name]);
        PaymentGateway::where('key', 'razorpay_description')->update(['value' => $request->description]);
        PaymentGateway::where('key', 'razorpay_theme_color')->update(['value' => $request->theme_color]);

        PaymentGateway::where('key', 'razorpay_status')->update(['value' => $request->status ? 1 : 0]);

        $exist_image = PaymentGateway::where('key', 'razorpay_image')->first();

        if($request->image){
            $old_image = $exist_image->value;
            $exist_image->value = app(\App\Services\UploadManager::class)->upload($request->image, 'uploads/website-images', ['prefix' => 'razorpay']);
            $exist_image->save();
            if($old_image){
                app(\App\Services\UploadManager::class)->delete($old_image);
            }
        }


        $notify_message = trans('Updated successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }



    public function update_paystack(PaystackRequest $request)
    {
        PaymentGateway::where('key', 'paystack_currency_id')->update(['value' => $request->paystack_currency_id]);
        PaymentGateway::where('key', 'paystack_public_key')->update(['value' => $request->paystack_public_key]);
        PaymentGateway::where('key', 'paystack_secret_key')->update(['value' => $request->paystack_secret_key]);
        PaymentGateway::where('key', 'paystack_status')->update(['value' => $request->status ? 1 : 0]);

        $exist_image = PaymentGateway::where('key', 'paystack_image')->first();

        if($request->image){
            $old_image = $exist_image->value;
            $exist_image->value = app(\App\Services\UploadManager::class)->upload($request->image, 'uploads/website-images', ['prefix' => 'paystack']);
            $exist_image->save();
            if($old_image){
                app(\App\Services\UploadManager::class)->delete($old_image);
            }
        }


        $notify_message = trans('Updated successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function update_instamojo(InstamojoRequest $request)
    {
        PaymentGateway::where('key', 'instamojo_account_mode')->update(['value' => $request->account_mode]);
        PaymentGateway::where('key', 'instamojo_currency_id')->update(['value' => $request->currency_id]);
        PaymentGateway::where('key', 'instamojo_api_key')->update(['value' => $request->api_key]);
        PaymentGateway::where('key', 'instamojo_auth_token')->update(['value' => $request->auth_token]);

        PaymentGateway::where('key', 'instamojo_status')->update(['value' => $request->status ? 1 : 0]);

        $exist_image = PaymentGateway::where('key', 'instamojo_image')->first();

        if($request->image){
            $old_image = $exist_image->value;
            $exist_image->value = app(\App\Services\UploadManager::class)->upload($request->image, 'uploads/website-images', ['prefix' => 'instamojo']);
            $exist_image->save();
            if($old_image){
                app(\App\Services\UploadManager::class)->delete($old_image);
            }
        }


        $notify_message = trans('Updated successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function update_bank(BankRequest $request)
    {
        PaymentGateway::where('key', 'bank_account_info')->update(['value' => $request->account_info]);
        PaymentGateway::where('key', 'bank_status')->update(['value' => $request->status ? 1 : 0]);

        $exist_image = PaymentGateway::where('key', 'bank_image')->first();

        if($request->image){
            $old_image = $exist_image->value;
            $exist_image->value = app(\App\Services\UploadManager::class)->upload($request->image, 'uploads/website-images', ['prefix' => 'bank']);
            $exist_image->save();
            if($old_image){
                app(\App\Services\UploadManager::class)->delete($old_image);
            }
        }


        $notify_message = trans('Updated successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }
}
