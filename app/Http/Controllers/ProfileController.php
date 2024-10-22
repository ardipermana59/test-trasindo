<?php

namespace App\Http\Controllers;


use Laravel\Jetstream\Http\Controllers\Inertia\Concerns\ConfirmsTwoFactorAuthentication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Carbon;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Agent;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\User;

class ProfileController extends Controller
{
    use ConfirmsTwoFactorAuthentication;

    /**
     * Show the general profile settings screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function show(Request $request)
    {

        $role = Auth::user()->role;
    
        if ($role == 'customer') {
            $profiles = Customer::where('user_id', Auth::user()->id)->first();
        } else if ($role == 'merchant') {
            $profiles = Merchant::where('user_id', Auth::user()->id)->first();
        } else {
            $profiles = User::where('id', Auth::user()->id)->first();
        }

        return Jetstream::inertia()->render($request, 'Settings/Profile', [
            'profiles' => $profiles
        ]);
    }

    /**
     * Show the security settings screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function showSecurityView(Request $request)
    {
        $this->validateTwoFactorAuthenticationState($request);

        return Inertia::render('Settings/Security', [
            'confirmsTwoFactorAuthentication' => Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm'),
            'sessions' => $this->sessions($request)->all(),
        ]);
    }

    /**
     * Get the current sessions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function sessions(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', $request->user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) use ($request) {
            $agent = $this->createAgent($session);

            return (object) [
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     * @return \Laravel\Jetstream\Agent
     */
    protected function createAgent($session)
    {
        return tap(new Agent(), fn($agent) => $agent->setUserAgent($session->user_agent));
    }
}
