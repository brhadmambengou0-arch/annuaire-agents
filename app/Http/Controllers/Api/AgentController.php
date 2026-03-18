<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class AgentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $agents = Agent::query()
            ->with(['entity.parent', 'fonction'])
            ->where('is_active', true)
            ->when($request->search, fn($q) => $q->search($request->search))
            ->when($request->entity_id, fn($q) => $q->where('entity_id', $request->entity_id))
            ->when($request->fonction_id, fn($q) => $q->where('fonction_id', $request->fonction_id))
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
        $agent = Agent::with(['entity.parent.parent', 'fonction'])
                      ->findOrFail($id);

        return response()->json($agent);
    }

    public function store(StoreAgentRequest $request): JsonResponse
    {
        Gate::authorize('create', Agent::class);

        $validated = $request->validated();

        if (isset($validated['nom'])) {
            $validated['nom'] = strtoupper($validated['nom']);
        }

        $agent = Agent::create($validated);

        return response()->json(
            $agent->load(['entity', 'fonction']),
            201
        );
    }

    public function update(UpdateAgentRequest $request, int $id): JsonResponse
    {
        $agent = Agent::findOrFail($id);

        Gate::authorize('update', $agent);

        $validated = $request->validated();

        if (isset($validated['nom'])) {
            $validated['nom'] = strtoupper($validated['nom']);
        }

        $agent->update($validated);

        return response()->json($agent->load(['entity', 'fonction']));
    }

    public function destroy(int $id): JsonResponse
    {
        $agent = Agent::findOrFail($id);

        Gate::authorize('delete', $agent);

        $agent->update(['is_active' => false]);

        return response()->json([
            'message' => 'Agent desactive avec succes.',
            'id'      => $agent->id,
        ]);
    }
}
