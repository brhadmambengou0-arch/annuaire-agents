<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirection racine vers login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes protégées — utilisateurs connectés
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/settings.php';