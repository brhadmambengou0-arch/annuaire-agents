<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
<<<<<<< HEAD
        if (!$auth->check() || $auth->user()?->role !== 'admin') {
            abort(403, 'Accès interdit - Vous devez être administrateur pour accéder à cette page.');
=======
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
>>>>>>> origin/main
        }

        abort(403, 'Accès réservé aux administrateurs.');
    }
}