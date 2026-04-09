<?php

namespace App\Livewire\Annuaire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;

class AgentIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $entity_id = '';
    public $fonction_id = '';
    public $is_active = '';

    protected $queryString = [
        'search',
        'entity_id',
        'fonction_id',
        'is_active'
    ];

    public function updating($field)
    {
        $this->resetPage();
    }

    public function render()
    {
        $agents = Agent::query()
            ->with(['entity', 'fonction'])

            // 🔍 Recherche
            ->when($this->search, function ($q) {
                $q->search($this->search);
            })

            // 🏢 Filtre entité
            ->when($this->entity_id, function ($q) {
                $q->where('entity_id', $this->entity_id);
            })

            // 🎯 Filtre fonction
            ->when($this->fonction_id, function ($q) {
                $q->where('fonction_id', $this->fonction_id);
            })

            // ✅ Statut
            ->when($this->is_active !== '', function ($q) {
                $q->where('is_active', $this->is_active);
            })

            ->latest()
            ->paginate(10);

        return view('livewire.annuaire.agent-index', [
            'agents'     => $agents,
            'entities'   => Entity::active()->get(),
            'fonctions'  => Fonction::where('is_active', true)->get(),
        ]);
    }
}