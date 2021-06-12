<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AuthLogin
{
    protected $_ignoreRoutes = [
        'login',
        'post.login',
    ];

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}