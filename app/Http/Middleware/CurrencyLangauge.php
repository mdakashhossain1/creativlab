<?php

namespace App\Http\Middleware;

use Closure;
use Session, Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\Currency\App\Models\Currency;
use Modules\Language\App\Models\Language;
use Symfony\Component\HttpFoundation\Response;


class CurrencyLangauge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Session::get('front_lang')){
            $default_lang = Language::where('is_default','Yes')->first();
            if($default_lang){
                Session::put('front_lang', $default_lang->lang_code);
                Session::put('lang_dir', $default_lang->lang_direction);
                Session::put('front_lang_name', $default_lang->lang_name);
            }else{
                $default_lang = Language::where('id', 1)->first();
                if($default_lang){
                    Session::put('front_lang', $default_lang->lang_code);
                    Session::put('lang_dir', $default_lang->lang_direction);
                    Session::put('front_lang_name', $default_lang->lang_name);
                }
            }

            app()->setLocale($default_lang->lang_code ?? 'en');
        }else{
            $is_exist = Language::where('lang_code', Session::get('front_lang'))->first();
            if(!$is_exist){
                Session::put('front_lang', 'en');
                Session::put('lang_dir', 'left_to_right');
                Session::put('front_lang_name', 'English');
            }

            app()->setLocale(Session::get('front_lang'));
        }

        // for currency
        if(!Session::get('currency_code')){
            // On first visit, try to auto-detect currency from visitor's IP location
            $geo_set = false;
            if (!Session::get('geo_currency_checked')) {
                $geo_set = $this->detectCurrencyFromIp($request);
                Session::put('geo_currency_checked', true);
            }

            if (!$geo_set) {
                $default_currency = Currency::where('is_default','yes')->first();
                if($default_currency){
                    Session::put('currency_name', $default_currency->currency_name);
                    Session::put('currency_code', $default_currency->currency_code);
                    Session::put('currency_icon', $default_currency->currency_icon);
                    Session::put('currency_rate', $default_currency->currency_rate);
                    Session::put('currency_position', $default_currency->currency_position);
                }else{
                    $default_currency = Currency::where('id', 1)->first();
                    if($default_currency){
                        Session::put('currency_name', $default_currency->currency_name);
                        Session::put('currency_code', $default_currency->currency_code);
                        Session::put('currency_icon', $default_currency->currency_icon);
                        Session::put('currency_rate', $default_currency->currency_rate);
                        Session::put('currency_position', $default_currency->currency_position);
                    }
                }
            }

        }else{
            $session_currency = Currency::where('currency_code', Session::get('currency_code'))->first();
            if(!$session_currency){
                $default_currency = Currency::where('id', 1)->first();
                if($default_currency){
                    Session::put('currency_name', $default_currency->currency_name);
                    Session::put('currency_code', $default_currency->currency_code);
                    Session::put('currency_icon', $default_currency->currency_icon);
                    Session::put('currency_rate', $default_currency->currency_rate);
                    Session::put('currency_position', $default_currency->currency_position);
                }
            }
        }

        app()->setLocale(Session::get('front_lang'));

        return $next($request);
    }

    private function detectCurrencyFromIp(Request $request): bool
    {
        $apiKey = config('services.ipstack.key');
        if (empty($apiKey)) {
            return false;
        }

        $ip = $request->ip();

        // Skip loopback / local IPs — IPstack cannot resolve these
        if (in_array($ip, ['127.0.0.1', '::1']) || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return false;
        }

        try {
            $response = Http::timeout(3)->get("http://api.ipstack.com/{$ip}", [
                'access_key' => $apiKey,
                'fields'     => 'currency',
            ]);

            if ($response->successful()) {
                $currencyCode = $response->json('currency.code');
                if ($currencyCode) {
                    $currency = Currency::where('currency_code', $currencyCode)->where('status', 'active')->first();
                    if ($currency) {
                        Session::put('currency_name', $currency->currency_name);
                        Session::put('currency_code', $currency->currency_code);
                        Session::put('currency_icon', $currency->currency_icon);
                        Session::put('currency_rate', $currency->currency_rate);
                        Session::put('currency_position', $currency->currency_position);
                        return true;
                    }
                }
            }
        } catch (\Throwable $e) {
            // fail open — never block a page load due to geo-detection failure
        }

        return false;
    }
}
