<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Livewire\Annuaire\DirectoryIndex;
use App\Livewire\Annuaire\AgentIndex;
use App\Livewire\Admin\EntityManager;
use App\Livewire\Admin\FonctionManager;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\AgentManager;
use App\Livewire\Admin\EntityHierarchyManager;
use App\Livewire\AgentProfile;
use App\Models\User;
use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;

// Route publique
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('annuaire.index')
            : redirect()->route('agents.index');
    }
    return redirect()->route('login');
})->name('home');

// Routes d'authentification (Breeze)
require __DIR__.'/auth.php';

// Routes protégées
Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Profil agent
    Route::get('/mon-profil', AgentProfile::class)->name('agent.profile');

    // Annuaire
    Route::get('/annuaire', DirectoryIndex::class)->name('annuaire.index');
    Route::get('/agents', AgentIndex::class)->name('agents.index');

    // Dashboard consultant (vue livewire/pages/dashboard.blade.php)
    Route::get('/dashboard', function () {
        return view('livewire.pages.dashboard', [
            'total_users'     => User::count(),
            'total_agents'    => Agent::where('is_active', true)->count(),
            'total_entities'  => Entity::count(),
            'total_fonctions' => Fonction::count(),
            'recent_agents'   => Agent::with(['entity', 'fonction'])
                                    ->where('is_active', true)
                                    ->latest()->take(5)->get(),
            'recent_users'    => User::latest()->take(5)->get(),
            'agents_inactifs' => Agent::where('is_active', false)->count(),
            'repartition'     => Entity::withCount([
                                    'agents' => fn($q) => $q->where('is_active', true)
                                 ])
                                   ->whereHas('agents', fn($q) => $q->where('is_active', true))
                                   ->orderByDesc('agents_count')
                                   ->get()
                                   ->map(fn($e) => (object)[
                                       'nom'       => $e->nom,
                                       'type'      => $e->type ?? 'direction',
                                       'nb_agents' => $e->agents_count,
                                   ]),
            'agents'          => Agent::with(['entity.parent', 'fonction'])
                                    ->where('is_active', true)->get(),
            'directions'      => Entity::whereNull('parent_uuid')
                                    ->where('is_active', true)->get(),
            'fonctions'       => Fonction::where('is_active', true)->get(),
        ]);
    })->name('dashboard');

    // Admin
    Route::middleware([\App\Http\Middleware\AdminOnly::class])->group(function () {
        Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
        Route::get('/admin/agents', AgentManager::class)->name('admin.agents');
        Route::get('/admin/entites', EntityHierarchyManager::class)->name('admin.entities');
        Route::get('/admin/fonctions', FonctionManager::class)->name('admin.fonctions');
    });

});
