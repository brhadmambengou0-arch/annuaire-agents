<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agent;

class AgentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Agent $agent): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Agent $agent): bool
    {
        return $user->role === 'admin';
    }
}