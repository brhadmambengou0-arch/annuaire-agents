<?php

namespace App\Livewire\Annuaire;

use Livewire\Component;

class AgentCard extends Component
{
    public $agent;
    public $showModal = false;

    public function showDetails()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.annuaire.agent-card');
    }
}