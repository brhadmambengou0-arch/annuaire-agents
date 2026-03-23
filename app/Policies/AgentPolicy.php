<?php

namespace App\Policies;

use App\Models\Agent;
use App\Models\User;

class AgentPolicy
{
    /**
     * Tout utilisateur connecté peut voir la liste des agents
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Tout utilisateur connecté peut voir la fiche d'un agent
     */
    public function view(User $user, Agent $agent): bool
    {
        return true;
    }

    /**
     * Seul l'admin peut créer un agent
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Seul l'admin peut modifier un agent
     */
    public function update(User $user, Agent $agent): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Seul l'admin peut désactiver un agent
     */
    public function delete(User $user, Agent $agent): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Seul l'admin peut réactiver un agent
     */
    public function restore(User $user, Agent $agent): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Personne ne peut supprimer définitivement un agent
     * On utilise le soft delete uniquement
     */
    public function forceDelete(User $user, Agent $agent): bool
    {
        return false;
    }
}
