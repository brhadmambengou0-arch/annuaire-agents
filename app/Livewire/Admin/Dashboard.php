<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;

class Dashboard extends Component
{
    public $showForm = false;

    public function openCreate()
    {
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'total_users'    => User::count(),
            'total_agents'   => Agent::count(),
            'total_entities' => Entity::count(),
            'total_fonctions'=> Fonction::count(),
            'recent_users'   => User::latest()->take(5)->get(),
            'recent_agents'  => Agent::latest()->take(5)->get(),
            'allEntities'    => Entity::orderBy('nom')->get(),
            'fonctions'      => Fonction::orderBy('niveau')->get(),
        ]);
    }
}