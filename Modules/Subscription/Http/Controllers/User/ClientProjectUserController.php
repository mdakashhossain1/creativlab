<?php

namespace Modules\Subscription\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Entities\ClientProject;

class ClientProjectUserController extends Controller
{
    public function index()
    {
        $projects = ClientProject::with('pendingInstallments')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('subscription::User.client-projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = ClientProject::with(['installments' => function ($q) {
            $q->orderBy('installment_number');
        }])->where('user_id', Auth::id())->findOrFail($id);

        return view('subscription::User.client-projects.show', compact('project'));
    }
}
