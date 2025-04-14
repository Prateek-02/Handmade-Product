<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Handle redirection based on the user role
                if ($user->isBuyer()) {
                    return redirect()->route('buyer.home');
                }

                if ($user->isSeller()) {
                    return redirect()->route('seller.dashboard');
                }

                // Default route for others, like admin (if applicable)
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
