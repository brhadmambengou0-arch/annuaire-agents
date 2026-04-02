<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Vérification sécurisée avant d'accéder à $user->role
        if (!$user) {
            abort(403, 'Accès non autorisé. Veuillez vous connecter.');
        }

        if ($user->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        return $next($request);  
    }
}