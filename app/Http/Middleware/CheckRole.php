<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        // Superadmin has access to everything
        if ($request->user()->role && $request->user()->role->name === 'Superadmin') {
            return $next($request);
        }

        foreach ($roles as $role) {
            if ($request->user()->role && $request->user()->role->name === $role) {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'Unauthorized access');
    }
}
