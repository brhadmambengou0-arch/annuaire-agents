<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;

class Dashboard extends Component
{
    public function render()
    {
        // Récupérer les données
        $total_users = User::count();
        $total_agents = Agent::count();
        $total_entities = Entity::count();
        $total_fonctions = Fonction::count();
        $recent_users = User::latest()->take(5)->get();
        $recent_agents = Agent::latest()->take(5)->get();

        return view('livewire.admin.dashboard', [
            'total_users' => $total_users,
            'total_agents' => $total_agents,
            'total_entities' => $total_entities,
            'total_fonctions' => $total_fonctions,
            'recent_users' => $recent_users,
            'recent_agents' => $recent_agents,
        ]);
    }
}