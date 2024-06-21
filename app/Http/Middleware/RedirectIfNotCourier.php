<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotCourier
{
    public function handle($request, Closure $next, $guard = 'courier')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('courier.login');
        }

        return $next($request);
    }
}
