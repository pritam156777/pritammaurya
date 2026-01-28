<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1️⃣ Must be logged in
        if (!auth()->check()) {
            abort(401, 'Not authenticated');
        }

        // 2️⃣ Get user role
        $userRole = auth()->user()->role;

        // 3️⃣ Check role
        if (!in_array($userRole, $roles)) {
            abort(403, 'Forbidden - role mismatch');
        }

        // 4️⃣ Allow request
        return $next($request);
    }
}
