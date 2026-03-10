<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $key = 'register:'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 0)) {
            return redirect()->route('register')
                ->withErrors(['email' => 'You cannot create a new account for 24 hours. Try again later.']);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        RateLimiter::hit($key, 86400);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $emailInput = trim($validated['email']);
        $passwordInput = $validated['password'];

        $email = str_contains($emailInput, '@')
            ? strtolower(trim($emailInput))
            : strtolower(trim($emailInput)).'@gmail.com';

        $adminEmail = config('admin.email');
        $adminPassword = config('admin.password');

        $isAdminCredentials = $adminEmail
            && $adminPassword
            && strtolower($email) === strtolower($adminEmail)
            && $passwordInput === $adminPassword;

        if ($isAdminCredentials) {
            $user = User::query()->firstOrNew(['email' => $adminEmail]);
            $user->name = $user->name ?: 'Admin';
            $user->email = $adminEmail;
            $user->password = Hash::make($adminPassword);
            $user->save();

            Auth::login($user, (bool) $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended(route('admin.products.index'));
        }

        if (! Auth::attempt(['email' => $email, 'password' => $passwordInput], (bool) $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => __('The provided credentials do not match our records.'),
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();
        if (strtolower($user->email ?? '') === strtolower((string) $adminEmail)) {
            return redirect()->intended(route('admin.products.index'));
        }

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
