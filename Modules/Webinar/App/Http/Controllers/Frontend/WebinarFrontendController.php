<?php

namespace Modules\Webinar\App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\PaymentGateway\App\Models\PaymentGateway;
use Modules\Webinar\App\Models\Webinar;
use Modules\Webinar\App\Models\WebinarRegistration;
use Stripe;

class WebinarFrontendController extends Controller
{
    protected $payment;

    protected function getPayment(): object
    {
        if ($this->payment === null) {
            try {
                $settings = [];
                foreach (PaymentGateway::all() as $row) {
                    $settings[$row->key] = $row->value;
                }
                $this->payment = (object) $settings;
            } catch (\Throwable $e) {
                $this->payment = (object) [];
            }
        }
        return $this->payment;
    }

    public function show(string $slug)
    {
        $webinar = Webinar::where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('webinar::frontend.show', compact('webinar'));
    }

    public function register(Request $request, string $slug)
    {
        $webinar = Webinar::where('slug', $slug)->where('status', 1)->firstOrFail();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
        ]);

        if (!$webinar->payment_enabled) {
            WebinarRegistration::create([
                'webinar_id'     => $webinar->id,
                'name'           => $request->input('name'),
                'email'          => $request->input('email'),
                'phone'          => $request->input('phone', ''),
                'payment_method' => 'free',
                'payment_status' => 'approved',
                'amount'         => 0,
            ]);

            session()->put('webinar_registered_' . $webinar->id, true);

            return redirect()->route('webinar.show', $slug)
                ->with(['message' => 'You have been registered successfully!', 'alert-type' => 'success']);
        }

        session()->put('webinar_checkout_' . $webinar->id, [
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone', ''),
        ]);

        return redirect()->route('webinar.checkout', $slug);
    }

    public function checkout(string $slug)
    {
        $webinar  = Webinar::where('slug', $slug)->where('status', 1)->firstOrFail();
        $attendee = session()->get('webinar_checkout_' . $webinar->id);

        if (!$attendee) {
            return redirect()->route('webinar.show', $slug)
                ->with(['message' => 'Please fill the registration form first.', 'alert-type' => 'error']);
        }

        $payment = $this->getPayment();
        return view('webinar::frontend.checkout', compact('webinar', 'attendee', 'payment'));
    }

    public function stripePayment(Request $request, string $slug)
    {
        $webinar  = Webinar::where('slug', $slug)->firstOrFail();
        $attendee = session()->get('webinar_checkout_' . $webinar->id);

        if (!$attendee || !$request->stripeToken) {
            return redirect()->route('webinar.show', $slug)->with(['message' => 'Payment failed.', 'alert-type' => 'error']);
        }

        try {
            Stripe\Stripe::setApiKey($this->getPayment()->stripe_secret ?? '');
            $charge = Stripe\Charge::create([
                'amount'      => (int) ($webinar->price * 100),
                'currency'    => 'usd',
                'source'      => $request->stripeToken,
                'description' => 'Webinar: ' . $webinar->title,
            ]);

            $this->saveRegistration($webinar, $attendee, 'Stripe', 'approved', $charge->balance_transaction);
            session()->forget('webinar_checkout_' . $webinar->id);
            session()->put('webinar_registered_' . $webinar->id, true);

            return redirect()->route('webinar.show', $slug)
                ->with(['message' => 'Payment successful! You are registered.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'alert-type' => 'error']);
        }
    }

    public function bankPayment(Request $request, string $slug)
    {
        $request->validate(['tnx_info' => 'required|string']);
        $webinar  = Webinar::where('slug', $slug)->firstOrFail();
        $attendee = session()->get('webinar_checkout_' . $webinar->id);

        if (!$attendee) {
            return redirect()->route('webinar.show', $slug)->with(['message' => 'Session expired.', 'alert-type' => 'error']);
        }

        $this->saveRegistration($webinar, $attendee, 'Bank', 'pending', $request->input('tnx_info'));
        session()->forget('webinar_checkout_' . $webinar->id);

        return redirect()->route('webinar.show', $slug)
            ->with(['message' => 'Registration submitted! Payment under review.', 'alert-type' => 'success']);
    }

    public function razorpayPayment(Request $request, string $slug)
    {
        $webinar  = Webinar::where('slug', $slug)->firstOrFail();
        $attendee = session()->get('webinar_checkout_' . $webinar->id);

        if (!$attendee || !$request->razorpay_payment_id) {
            return redirect()->route('webinar.show', $slug)->with(['message' => 'Payment failed.', 'alert-type' => 'error']);
        }

        try {
            $api     = new \Razorpay\Api\Api($this->getPayment()->razorpay_key ?? '', $this->getPayment()->razorpay_secret ?? '');
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            $payment->capture(['amount' => (int) ($webinar->price * 100)]);

            $this->saveRegistration($webinar, $attendee, 'Razorpay', 'approved', $request->razorpay_payment_id);
            session()->forget('webinar_checkout_' . $webinar->id);
            session()->put('webinar_registered_' . $webinar->id, true);

            return redirect()->route('webinar.show', $slug)
                ->with(['message' => 'Payment successful! You are registered.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'alert-type' => 'error']);
        }
    }

    private function saveRegistration(Webinar $webinar, array $attendee, string $method, string $status, ?string $txnId)
    {
        WebinarRegistration::create([
            'webinar_id'     => $webinar->id,
            'name'           => $attendee['name'],
            'email'          => $attendee['email'],
            'phone'          => $attendee['phone'] ?? '',
            'payment_method' => $method,
            'payment_status' => $status,
            'transaction_id' => $txnId,
            'amount'         => $webinar->price,
        ]);
    }
}
