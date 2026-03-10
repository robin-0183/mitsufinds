<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DevAccessController extends Controller
{
    public function showComingSoon(): View
    {
        $countdownEndsAtMs = Cache::remember('coming_soon_ends_at_ms', now()->addDays(4), function () {
            $configured = config('app.coming_soon_ends_at');
            $fixedDateOnly = is_string($configured) && preg_match('/^\d{4}-\d{2}-\d{2}/', $configured)
                ? $configured
                : null;
            if ($fixedDateOnly !== null) {
                $endsAt = Carbon::parse($fixedDateOnly, config('app.timezone'));
                if ($endsAt->isFuture()) {
                    return (int) ($endsAt->getTimestamp() * 1000);
                }
            }
            return (int) (now()->addDays(3)->getTimestamp() * 1000);
        });

        return view('coming-soon', [
            'countdownEndsAtMs' => $countdownEndsAtMs,
        ]);
    }

    public function showDevLoginForm(): View|RedirectResponse
    {
        if (session('dev_authenticated')) {
            return redirect()->route('admin.products.index');
        }

        return view('dev-login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $password = config('dev.password');

        if (! $password) {
            return back()->withErrors(['dev_password' => 'Developer access is not configured.']);
        }

        $request->validate([
            'dev_password' => ['required', 'string'],
        ]);

        if ($request->input('dev_password') !== $password) {
            return back()->withErrors(['dev_password' => 'Invalid developer password.']);
        }

        session(['dev_authenticated' => true]);
        $request->session()->save();

        return redirect()->route('admin.products.index');
    }

    public function exit(Request $request): RedirectResponse
    {
        $request->session()->forget('dev_authenticated');

        return redirect()->route('coming-soon');
    }
}
