<?php

namespace App\Http\Middleware;

use App\Models\AdminCredential;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request. Only the configured admin user may access admin routes.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('dev_authenticated')) {
            return $next($request);
        }

        $adminCredential = AdminCredential::get();
        $adminEmail = $adminCredential?->email;
        if (! Auth::check() || ! $adminEmail || strtolower(trim(Auth::user()->email ?? '')) !== strtolower(trim($adminEmail))) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
