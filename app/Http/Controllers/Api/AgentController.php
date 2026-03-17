<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AgentController extends Controller
{
  
    public function index(Request $request): JsonResponse
    {
        $agents = Agent::query()
            ->with(['entity.parent', 'fonction'])
            ->where('is_active', true)
            // Filtre par recherche texte
            ->when($request->search, fn($q) =>
                $q->search($request->search)
            )
            // Filtre par entité précise
            ->when($request->entity_id, fn($q) =>
                $q->where('entity_id', $request->entity_id)
            )
            // Filtre par fonction
            ->when($request->fonction_id, fn($q) =>
                $q->where('fonction_id', $request->fonction_id)
            )
            // Filtre par direction (cascade vers services et départements)
            ->when($request->direction_id, function ($q) use ($request) {
                $q->whereHas('entity', function ($eq) use ($request) {
                    $eq->where('id', $request->direction_id)
                       ->orWhere('parent_id', $request->direction_id)
                       ->orWhereHas('parent', fn($p) =>
                           $p->where('parent_id', $request->direction_id)
                       );
                });
            })
            ->orderBy('nom')
            ->paginate($request->per_page ?? 25);

        return response()->json($agents);
    }

   
    public function show(int $id): JsonResponse
    {
        $agent = Agent::with([
            'entity.parent.parent',
            'fonction'
        ])->findOrFail($id);

        return response()->json($agent);
    }

   
    public function store(Request $request): JsonResponse
    {
        // Validation des données
        $validated = $request->validate([
            'matricule'           => 'required|string|max:20|unique:agents',
            'nom'                 => 'required|string|max:100',
            'prenom'              => 'required|string|max:100',
            'email'               => 'nullable|email|unique:agents',
            'telephone'           => 'nullable|string|max:25',
            'telephone_interne'   => 'nullable|string|max:10',
            'entity_id'           => 'required|exists:entities,id',
            'fonction_id'         => 'required|exists:fonctions,id',
            'bureau'              => 'nullable|string|max:50',
            'date_prise_fonction' => 'nullable|date',
        ]);

        // Le nom est toujours en majuscules
        $validated['nom'] = strtoupper($validated['nom']);

        // Créer l'agent
        $agent = Agent::create($validated);

        // Retourner l'agent créé avec ses relations
        return response()->json(
            $agent->load(['entity', 'fonction']),
            201 // Code 201 = Created
        );
    }

    
    public function update(Request $request, int $id): JsonResponse
    {
        $agent = Agent::findOrFail($id);

        $validated = $request->validate([
            'nom'                 => 'sometimes|string|max:100',
            'prenom'              => 'sometimes|string|max:100',
            'email'               => 'nullable|email|unique:agents,email,' . $id,
            'telephone'           => 'nullable|string|max:25',
            'telephone_interne'   => 'nullable|string|max:10',
            'entity_id'           => 'sometimes|exists:entities,id',
            'fonction_id'         => 'sometimes|exists:fonctions,id',
            'bureau'              => 'nullable|string|max:50',
            'date_prise_fonction' => 'nullable|date',
        ]);

        // Le nom toujours en majuscules si modifié
        if (isset($validated['nom'])) {
            $validated['nom'] = strtoupper($validated['nom']);
        }

        $agent->update($validated);

        return response()->json($agent->load(['entity', 'fonction']));
    }

    public function destroy(int $id): JsonResponse
    {
        $agent = Agent::findOrFail($id);
        $agent->update(['is_active' => false]);

        return response()->json([
            'message' => 'Agent désactivé avec succès.',
            'id'      => $agent->id,
        ]);
    }
} 