<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CronController extends Controller
{
    public function run(Request $request)
    {
        $expected = substr(hash('sha256', config('app.key')), 0, 32);

        if ($request->get('token') !== $expected) {
            abort(403, 'Invalid cron token.');
        }

        Artisan::call('schedule:run');

        return response()->json([
            'status' => 'ok',
            'ran_at' => now()->toDateTimeString(),
        ]);
    }
}
