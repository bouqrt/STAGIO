<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Redirect guests to the login page.
        if (! auth()->check()) {
            return redirect('/login');
        }

        // Stop access when the user role is not allowed.
        if (! in_array(auth()->user()->role, $roles)) {
            abort(403, 'Access not allowed.');
        }

        return $next($request);
    }
}
