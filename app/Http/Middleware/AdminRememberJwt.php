<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin;

class AdminRememberJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check() && Cookie::has('admin_remember_jwt')) {
            $token = Cookie::get('admin_remember_jwt');
            $payload = verify_admin_jwt($token);
            if ($payload && isset($payload['admin_id'])) {
                $admin = Admin::find($payload['admin_id']);
                if ($admin && $admin->status == Admin::STATUS_ACTIVE) {
                    Auth::guard('admin')->login($admin);
                }
            }
        }
        return $next($request);
    }
}
