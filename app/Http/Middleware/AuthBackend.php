<?php

namespace App\Http\Middleware;

use Closure;

class AuthBackend
{
    public function handle($request, Closure $next)
    {
        if (!backendIsLogin()) {
            return redirect()->route(backendRouterName('login'));
        }
        return $next($request);
    }
}