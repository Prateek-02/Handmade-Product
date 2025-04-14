<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // ✅ Log entry for debugging (optional)
        Log::info('RoleMiddleware is working');

        // 🔒 Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(Auth::user()->role);
        $requiredRole = strtolower($role);

        // ❌ If user doesn't match the required role
        if ($userRole !== $requiredRole) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        // ✅ All good — proceed
        return $next($request);
    }
}
