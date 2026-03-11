<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDevAccess
{
    /**
     * Redirect to home unless the user has entered the correct dev password.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('dev_authenticated')) {
            return $next($request);
        }

        if ($request->path() === 'dev-auth' && $request->isMethod('POST')) {
            return $next($request);
        }

        if ($request->path() === 'dev-login') {
            return $next($request);
        }

        $publicPaths = ['', 'products', 'links', 'trusted-sellers', 'login', 'register'];
        if (in_array($request->path(), $publicPaths, true)) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
