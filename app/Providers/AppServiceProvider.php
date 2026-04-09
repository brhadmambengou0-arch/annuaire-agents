<?php

namespace App\Providers;

use App\Models\Agent;
use App\Policies\AgentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enregistrement de la Policy Agent
        // Cela dit à Laravel : pour le modèle Agent, utilise AgentPolicy
        Gate::policy(Agent::class, AgentPolicy::class);
    }
}