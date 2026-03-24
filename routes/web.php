<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Security;
use App\Livewire\Admin\EntityManager;
use App\Livewire\Admin\FonctionManager;

Route::get('/', function () {
    return redirect()->route('annuaire.index');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/annuaire', function () {
        return view('annuaire.index');
    })->name('annuaire.index');

    Route::middleware(['admin'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {
             Route::get('/entites', EntityManager::class)->name('entities');
            Route::get('/fonctions', FonctionManager::class)->name('fonctions');
         });
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile',    Profile::class)->name('profile.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');
    Route::get('settings/security',   Security::class)->name('security.edit');
});
