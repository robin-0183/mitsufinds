<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDevAccess
{
    /**
     * Show coming soon page unless the user has entered the correct dev password.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('dev_authenticated')) {
            return $next($request);
        }

        if ($request->path() === 'coming-soon') {
            return $next($request);
        }

        if ($request->path() === 'dev-auth' && $request->isMethod('POST')) {
            return $next($request);
        }

        return redirect()->route('coming-soon');
    }
}
