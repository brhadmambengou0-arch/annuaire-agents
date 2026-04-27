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

    protected $paginationTheme = 'tailwind';

    public $search      = '';
    public $directionId = null;
    public $serviceId   = null;
    public $fonctionId  = null;

    public $services  = [];
    public $fonctions = [];

    public $showDetail    = false;
    public $selectedAgent = null;

    public function mount()
    {
        $this->fonctions = Fonction::orderBy('libelle')->get();
        $this->services  = collect();
    }

    public function updatedDirectionId()
    {
        $this->serviceId  = null;
        $this->fonctionId = null;
        $this->resetPage();

        if ($this->directionId) {
            $this->services = Entity::where('parent_id', $this->directionId)
                ->where('type', 'service')
                ->where('is_active', true)
                ->orderBy('nom')
                ->get();

            $fonctionIds = Agent::whereHas('entity', function ($q) {
                $q->where('id', $this->directionId)
                  ->orWhere('parent_id', $this->directionId);
            })->pluck('fonction_id')->unique();

            $this->fonctions = Fonction::whereIn('id', $fonctionIds)->orderBy('libelle')->get();

            if ($this->fonctions->isEmpty()) {
                $this->fonctions = Fonction::orderBy('libelle')->get();
            }
        } else {
            $this->services  = collect();
            $this->fonctions = Fonction::orderBy('libelle')->get();
        }
    }

    public function updatingServiceId()  { $this->resetPage(); }
    public function updatingFonctionId() { $this->resetPage(); }
    public function updatingSearch()     { $this->resetPage(); }

    public function openDetail($id)
    {
        $this->selectedAgent = Agent::with(['fonction', 'entity.parent'])->findOrFail($id);
        $this->showDetail    = true;
    }

    public function closeDetail()
    {
        $this->showDetail    = false;
        $this->selectedAgent = null;
    }

    public function render()
    {
        $agents = Agent::query()
            ->with(['fonction', 'entity'])
            ->where('is_active', true)
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('nom',        'like', "%{$this->search}%")
                       ->orWhere('prenom',   'like', "%{$this->search}%")
                       ->orWhere('email',    'like', "%{$this->search}%")
                       ->orWhere('matricule','like', "%{$this->search}%");
                });
            })
            ->when($this->directionId && !$this->serviceId, function ($q) {
                $q->whereHas('entity', function ($e) {
                    $e->where('id', $this->directionId)
                      ->orWhere('parent_id', $this->directionId);
                });
            })
            ->when($this->serviceId, function ($q) {
                $q->where('entity_id', $this->serviceId);
            })
            ->when($this->fonctionId, function ($q) {
                $q->where('fonction_id', $this->fonctionId);
            })
            ->orderBy('nom')
            ->paginate(24);

        $directions = Entity::where('type', 'direction')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('nom')
            ->get();

        return view('livewire.annuaire.directory-index', [
            'agents'     => $agents,
            'directions' => $directions,
        ])->layout('components.app-layout');
    }
}
