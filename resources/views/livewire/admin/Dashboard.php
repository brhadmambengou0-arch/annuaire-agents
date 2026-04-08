<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $total_users = 0;
    public $total_agents = 0;
    public $total_entities = 0;
    public $total_fonctions = 0;
    public $recent_users = [];
    public $recent_agents = [];
    public $agent = null;

    public function mount()
    {
        // ── Comptage global ──────────────
        $this->total_users     = User::count();
        $this->total_agents    = Agent::where('is_active', 1)->count();
        $this->total_entities  = Entity::where('is_active', 1)->count();
        $this->total_fonctions = Fonction::where('is_active', 1)->count();

        $this->recent_users  = User::latest()->take(5)->get();
        $this->recent_agents = Agent::where('is_active', 1)->latest()->take(5)->get();

        // ── Agent lié à l'utilisateur connecté ──────────────
        $user = Auth::user();

        if ($user) {
            // Option 1 — user_id
            $this->agent = Agent::where('user_id', $user->id)->first();

            // Option 2 — user_uuid
            // $this->agent = Agent::where('user_uuid', $user->uuid)->first();

            // Option 3 — email
            // $this->agent = Agent::where('email', $user->email)->first();
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'total_users'     => $this->total_users,
            'total_agents'    => $this->total_agents,
            'total_entities'  => $this->total_entities,
            'total_fonctions' => $this->total_fonctions,
            'recent_users'    => $this->recent_users,
            'recent_agents'   => $this->recent_agents,
            'agent'           => $this->agent,
        ]);
    }
}