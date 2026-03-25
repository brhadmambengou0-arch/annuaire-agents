<?php

namespace App\Livewire\Annuaire;

use App\Models\Agent;
use Livewire\Component;

class AgentCard extends Component
{
    public Agent $agent;

    // Couleurs d'avatar assignées selon les initiales
    protected array $avatarPalette = [
        ['bg' => '#dbeafe', 'color' => '#1e40af'],
        ['bg' => '#dcfce7', 'color' => '#166534'],
        ['bg' => '#fef9c3', 'color' => '#854d0e'],
        ['bg' => '#fce7f3', 'color' => '#9d174d'],
        ['bg' => '#ede9fe', 'color' => '#5b21b6'],
        ['bg' => '#ffedd5', 'color' => '#9a3412'],
        ['bg' => '#e0f2fe', 'color' => '#075985'],
        ['bg' => '#f0fdf4', 'color' => '#14532d'],
    ];

    public function getAvatarBgProperty(): string
    {
        $index = ord(strtoupper($this->agent->nom[0])) % count($this->avatarPalette);
        return $this->avatarPalette[$index]['bg'];
    }

    public function getAvatarColorProperty(): string
    {
        $index = ord(strtoupper($this->agent->nom[0])) % count($this->avatarPalette);
        return $this->avatarPalette[$index]['color'];
    }

    public function render()
    {
        return view('livewire.annuaire.agent-card');
    }
}
