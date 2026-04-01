<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Settings\Profile;
use App\Livewire\Pages\Settings\Appearance;
use App\Livewire\Pages\Settings\Security;

Route::middleware(['auth', 'password.confirm'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');
    Route::get('settings/security', Security::class)->name('security.edit');
});
