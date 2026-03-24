<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next, Guard $auth): Response
    {
        if (!$auth->check() || $auth->user()?->role !== 'admin') {
            abort(403, 'Accès interdit : réservé aux administrateurs.');
        }

        return $next($request);
    }
}