<?php

use Illuminate\Support\Facades\Route;

// Redirection racine vers login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes protégées — utilisateurs connectés
Route::middleware('auth')->group(function () {

    // Annuaire — accessible à tous les connectés
    Route::get('/annuaire', \App\Livewire\Annuaire\DirectoryIndex::class)
         ->name('annuaire.index');

    // Administration — réservée aux admins
    Route::middleware('App\Http\Middleware\AdminOnly')
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::get('/entites',   \App\Livewire\Admin\EntityManager::class)->name('entities');
             Route::get('/fonctions', \App\Livewire\Admin\FonctionManager::class)->name('fonctions');
         });
});

require __DIR__.'/auth.php';