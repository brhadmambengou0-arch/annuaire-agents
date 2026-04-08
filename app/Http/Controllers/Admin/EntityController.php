<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index()
    {
        return response()->json(
            Entity::with('parent')->where('is_active', true)->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:150',
            'code' => 'required|string|max:30|unique:entities,code',
            'type' => 'required|in:direction,service,departement',
            'parent_id' => 'nullable|exists:entities,id'
        ]);

        $entity = Entity::create($data);

        return response()->json($entity, 201);
    }

    public function update(Request $request, $id)
    {
        $entity = Entity::findOrFail($id);

        $data = $request->validate([
            'nom' => 'required|string|max:150',
            'code' => 'required|string|max:30|unique:entities,code,' . $id,
            'type' => 'required|in:direction,service,departement',
            'parent_id' => 'nullable|exists:entities,id'
        ]);

        $entity->update($data);

        return response()->json($entity);
    }

    public function destroy($id)
    {
        $entity = Entity::findOrFail($id);

        // 🔥 règle métier
        if ($entity->agents()->where('is_active', true)->exists()) {
            return response()->json([
                'message' => 'Impossible de supprimer une entité contenant des agents'
            ], 400);
        }

        $entity->update(['is_active' => false]);

        return response()->json(['message' => 'Entité désactivée']);
    }
}