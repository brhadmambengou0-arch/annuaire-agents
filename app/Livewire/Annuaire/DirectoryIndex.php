<?php

namespace App\Livewire\Annuaire;

use Livewire\Component;
use App\Models\Agent;

class DirectoryIndex extends Component
{
    public $search = '';

    public function render()
    {
        $agents = Agent::with('fonction')
            ->where('is_active', true)
            ->when($this->search, function ($q) {
                $q->where('nom', 'like', '%'.$this->search.'%')
                  ->orWhere('prenom', 'like', '%'.$this->search.'%');
            })
            ->get();

        return view('livewire.annuaire.directory-index', [
            'agents' => $agents
        ]);
    }
}