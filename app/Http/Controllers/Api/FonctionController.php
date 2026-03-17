<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fonction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FonctionController extends Controller
{
    /**
     * GET /api/v1/fonctions
     * Liste toutes les fonctions actives
     */
    public function index(): JsonResponse
    {
        return response()->json(
            Fonction::active()->get()
        );
    }

    /**
     * GET /api/v1/fonctions/{id}
     * Détail d'une fonction
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(
            Fonction::findOrFail($id)
        );
    }

    /**
     * POST /api/v1/fonctions
     * Créer une nouvelle fonction
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:50|unique:fonctions',
            'libelle'     => 'required|string|max:150',
            'niveau'      => 'required|integer|min:1|max:6',
            'description' => 'nullable|string',
        ]);

        $fonction = Fonction::create($validated);

        return response()->json($fonction, 201);
    }

    /**
     * PUT /api/v1/fonctions/{id}
     * Modifier une fonction
     * Le code est immuable (non modifiable)
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $fonction = Fonction::findOrFail($id);

        $validated = $request->validate([
            'libelle'     => 'sometimes|string|max:150',
            'niveau'      => 'sometimes|integer|min:1|max:6',
            'description' => 'nullable|string',
        ]);

        $fonction->update($validated);

        return response()->json($fonction);
    }

    /**
     * Désactiver une fonction
     * Impossible si des agents actifs l'utilisent
     */
    public function destroy(int $id): JsonResponse
    {
        $fonction = Fonction::findOrFail($id);

        if ($fonction->hasActiveAgents()) {
            return response()->json([
                'message' => 'Impossible : des agents actifs utilisent cette fonction.'
            ], 422);
        }

        $fonction->update(['is_active' => false]);

        return response()->json([
            'message' => 'Fonction désactivée.',
            'id'      => $fonction->id,
        ]);
    }
}