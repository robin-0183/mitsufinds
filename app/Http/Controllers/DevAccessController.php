<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DevAccessController extends Controller
{
    public function showComingSoon(): View
    {
        return view('coming-soon');
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

        return redirect()->intended(route('home'));
    }
}
