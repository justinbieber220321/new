<?php

namespace App\Http\Middleware;

use Closure;

class AuthFrontend
{
    public function handle($request, Closure $next)
    {
        if (!frontendIsLogin()) {
            return redirect()->route(frontendRouterName('login.get'));
        }
        return $next($request);
    }
}