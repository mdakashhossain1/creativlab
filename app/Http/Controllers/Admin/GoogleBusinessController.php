<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoogleBusinessToken;
use App\Services\GoogleBusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Facades\Socialite;

class GoogleBusinessController extends Controller
{
    public function __construct(private GoogleBusinessService $gbs) {}

    public function index()
    {
        $token    = $this->gbs->getToken();
        $accounts = [];
        $reviews  = [];

        if ($token) {
            $accounts = $this->gbs->getAccounts();

            // Auto-fetch reviews for first location found
            if (!empty($accounts)) {
                $accountName = $accounts[0]['name'] ?? null;
                if ($accountName) {
                    $locations = $this->gbs->getLocations($accountName);
                    if (!empty($locations)) {
                        $locationName = $locations[0]['name'] ?? null;
                        if ($locationName) {
                            $parent  = $accountName . '/' . basename($locationName);
                            $reviews = $this->gbs->getReviews($parent);
                        }
                    }
                }
            }
        }

        return view('admin.google.business', compact('token', 'accounts', 'reviews'));
    }

    public function connect()
    {
        return Socialite::driver('google')
            ->redirectUrl(route('admin.google.callback'))
            ->scopes([
                'openid',
                'email',
                'profile',
                'https://www.googleapis.com/auth/business.manage',
            ])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->redirect();
    }

    public function callback(Request $request)
    {
        if ($request->has('error')) {
            return redirect()->route('admin.google.index')
                ->with(['message' => 'Google connection cancelled.', 'alert-type' => 'error']);
        }

        $googleUser = Socialite::driver('google')
            ->redirectUrl(route('admin.google.callback'))
            ->stateless()
            ->user();

        // Replace any existing token (single-account setup)
        GoogleBusinessToken::truncate();

        GoogleBusinessToken::create([
            'access_token'     => $googleUser->token,
            'refresh_token'    => $googleUser->refreshToken,
            'token_type'       => 'Bearer',
            'token_expires_at' => Carbon::now()->addSeconds(($googleUser->expiresIn ?? 3600) - 30),
            'google_email'     => $googleUser->getEmail(),
            'google_name'      => $googleUser->getName(),
            'google_avatar'    => $googleUser->getAvatar(),
        ]);

        return redirect()->route('admin.google.index')
            ->with(['message' => 'Google Business Profile connected successfully!', 'alert-type' => 'success']);
    }

    public function disconnect()
    {
        GoogleBusinessToken::truncate();

        return redirect()->route('admin.google.index')
            ->with(['message' => 'Google account disconnected.', 'alert-type' => 'success']);
    }
}
