<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /*
     * POST /api/v1/auth/token
     * L'utilisateur envoie email + password
     * Il reçoit un token Bearer en retour
     */
    public function token(Request $request): JsonResponse
    {
        // Validation des données reçues
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Chercher l'utilisateur par email
        $user = User::where('email', $request->email)->first();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects.'],
            ]);
        }

        // Créer et retourner le token
        $token = $user->createToken('annuaire-api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'type'  => 'Bearer',
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ]);
    }

    /**
     * DELETE /api/v1/auth/token
     * L'utilisateur envoie son token
     * Le token est supprimé (déconnexion API)
     */
    public function revoke(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie.'
        ]);
    }
}