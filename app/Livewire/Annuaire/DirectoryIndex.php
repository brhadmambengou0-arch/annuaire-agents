<?php

namespace App\Livewire\Annuaire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;

class DirectoryIndex extends Component
{
    use WithPagination;

    // Propriétés publiques (liées aux filtres)
    public $search = '';
    public $directionId = null;
    public $entityId = null;
    public $fonctionId = null;

    // Propriétés pour les statistiques (seront calculées)
    public $totalAgents = 0;
    public $totalDirections = 0;

    // Persister les filtres dans l'URL
    protected $queryString = ['search', 'directionId', 'entityId', 'fonctionId'];

    public function mount()
    {
        $this->totalAgents = Agent::where('is_active', true)->count();
        $this->totalDirections = Entity::where('type', 'direction')
            ->where('is_active', true)
            ->count();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedDirectionId()
    {
        $this->resetPage();
    }

    public function updatedEntityId()
    {
        $this->resetPage();
    }

    public function updatedFonctionId()
    {
        $this->resetPage();
    }

    public function filterByEntity($entityId)
    {
        $this->entityId = $entityId;
        $this->directionId = null;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'directionId', 'entityId', 'fonctionId']);
        $this->resetPage();
    }

    public function getEntityTreeProperty()
    {
        return Entity::with('children')
            ->whereNull('parent_uuid')
            ->where('is_active', true)
            ->orderBy('ordre')
            ->get();
    }

    public function getFonctionsProperty()
    {
        return Fonction::where('is_active', true)
             ->orderBy('libelle')
            ->get();
    }

    public function getAgentsProperty()
    {
        $query = Agent::query()->with(['entity', 'fonction']);

        // Filtre par recherche
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nom', 'ilike', '%' . $this->search . '%')
                  ->orWhere('prenom', 'ilike', '%' . $this->search . '%')
                  ->orWhere('matricule', 'ilike', '%' . $this->search . '%')
                  ->orWhere('email', 'ilike', '%' . $this->search . '%');
            });
        }

        // Filtre par entité (direction ou service)
if (!empty($this->entityId)) {
    $query->where('entity_id', $this->entityId);
} elseif (!empty($this->directionId)) {
    $entityIds = Entity::where('parent_uuid', $this->directionId)  // ← au lieu de parent_id
        ->orWhere('uuid', $this->directionId)  // ← utilise uuid au lieu de id
        ->pluck('uuid');  // ← pluck('uuid') au lieu de pluck('id')
    $query->whereIn('entity_id', $entityIds);
}

        // Filtre par fonction
        if (!empty($this->fonctionId)) {
            $query->where('fonction_id', $this->fonctionId);
        }

        // Seulement les agents actifs
        $query->where('is_active', true);

        // Tri
        $query->orderBy('ordre')->orderBy('nom');

        return $query->paginate(12);
    }

    public function render()
    {
        return view('livewire.annuaire.directory-index', [
            'agents' => $this->agents,
            'entityTree' => $this->entityTree,
            'fonctions' => $this->fonctions,
            'totalAgents' => $this->totalAgents,
            'totalDirections' => $this->totalDirections,
        ]);
    }
}