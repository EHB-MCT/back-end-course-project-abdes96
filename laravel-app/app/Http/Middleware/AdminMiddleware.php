<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle($request, Closure $next, string $role)
    {
        if ($request->user()->role === $role) {
            return $next($request);

        }
        abort(403);

    }
}


