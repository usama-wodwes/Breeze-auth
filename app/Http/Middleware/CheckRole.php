<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user() || !$request->user()->hasRole($role)) {
            abort(403, 'User does not have the right roles2.');
        }

        return $next($request);
    }
}
