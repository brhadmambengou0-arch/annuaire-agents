<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Security;

Route::get('/', function () {
    return redirect()->route('annuaire.index');
});

Route::middleware(['auth'])->group(function () {

    // Annuaire — accessible à tous les utilisateurs connectés
    Route::get('/annuaire', function () {
        return view('annuaire.index');
    })->name('annuaire.index');

    // Administration — réservée aux admins uniquement
    Route::middleware(['admin'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::get('/entites', function () {
                 return view('admin.entities');
             })->name('entities');

             Route::get('/fonctions', function () {
                 return view('admin.fonctions');
             })->name('fonctions');
         });
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile',    Profile::class)->name('profile.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');
    Route::get('settings/security',   Security::class)->name('security.edit');
});
