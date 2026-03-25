<?php

namespace App\Livewire\Annuaire;

use App\Models\Agent;
use App\Models\Entity;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DirectoryIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $directionId = null;
    public ?int $entityId = null;
    public ?int $fonctionId = null;

    // Réinitialise la pagination quand les filtres changent
    public function updatedSearch(): void    { $this->resetPage(); }
    public function updatedDirectionId(): void { $this->resetPage(); }
    public function updatedEntityId(): void  { $this->resetPage(); }
    public function updatedFonctionId(): void { $this->resetPage(); }

    #[Computed]
    public function agents()
    {
        return Agent::query()
            ->with(['entity.parent', 'fonction'])
            ->where('is_active', true)
            ->when($this->search, fn($q) => $q->search($this->search))
            ->when($this->entityId, fn($q) => $q->where('entity_id', $this->entityId))
            ->when($this->directionId, fn($q) => $q->whereHas('entity', function ($eq) {
                $eq->where('id', $this->directionId)
                    ->orWhere('parent_id', $this->directionId)
                    ->orWhereHas('parent', fn($p) => $p->where('parent_id', $this->directionId));
            }))
            ->when($this->fonctionId, fn($q) => $q->where('fonction_id', $this->fonctionId))
            ->orderBy('nom')
            ->paginate(24);
    }

    #[Computed]
    public function entityTree()
    {
        return Entity::roots()->with('childrenRecursive')->get();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'directionId', 'entityId', 'fonctionId']);
        $this->resetPage();
    }

    #[On('agent-saved')]
    #[On('agent-deleted')]
    public function refresh(): void
    {
        // Livewire recalcule automatiquement les computed properties
        unset($this->agents);
    }

    public function render()
    {
        return view('livewire.annuaire.directory-index')
            ->layout('layouts.app', ['title' => 'Annuaire — ANINF']);
    }
}
