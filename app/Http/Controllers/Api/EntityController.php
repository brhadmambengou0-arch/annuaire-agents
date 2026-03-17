<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EntityController extends Controller
{
    
    public function index(): JsonResponse
    {
        $entities = Entity::roots()
            ->with('childrenRecursive')
            ->get();

        return response()->json($entities);
    }

    
    public function tree(): JsonResponse
    {
        $tree = Entity::roots()
            ->with('childrenRecursive')
            ->get();

        return response()->json($tree);
    }

    
    public function show(int $id): JsonResponse
    {
        $entity = Entity::with([
            'childrenRecursive',
            'parent'
        ])->findOrFail($id);

        return response()->json($entity);
    }

    
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nom'         => 'required|string|max:150',
            'code'        => 'required|string|max:30|unique:entities',
            'type'        => 'required|in:direction,service,departement',
            'parent_id'   => 'nullable|exists:entities,id',
            'description' => 'nullable|string',
            'ordre'       => 'nullable|integer',
        ]);

        $entity = Entity::create($validated);

        return response()->json($entity, 201);
    }

    
    public function update(Request $request, int $id): JsonResponse
    {
        $entity = Entity::findOrFail($id);

        $validated = $request->validate([
            'nom'         => 'sometimes|string|max:150',
            'type'        => 'sometimes|in:direction,service,departement',
            'parent_id'   => 'nullable|exists:entities,id',
            'description' => 'nullable|string',
            'ordre'       => 'nullable|integer',
        ]);

        $entity->update($validated);

        return response()->json($entity);
    }

    
    public function destroy(int $id): JsonResponse
    {
        $entity = Entity::findOrFail($id);

        // Vérifier qu'aucun agent actif n'est rattaché
        if ($entity->agents()->where('is_active', true)->exists()) {
            return response()->json([
                'message' => 'Impossible : des agents actifs sont rattachés à cette entité.'
            ], 422);
        }

        $entity->update(['is_active' => false]);

        return response()->json([
            'message' => 'Entité désactivée.',
            'id'      => $entity->id,
        ]);
    }
}