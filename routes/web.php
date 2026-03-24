<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Security;
use App\Livewire\Admin\EntityManager;
use App\Livewire\Admin\FonctionManager;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
