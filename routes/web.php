<?php

use Illuminate\Support\Facades\Route;

// Page d'accueil (protégée)
Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');

// Annuaire des agents (protégée)
Route::get('/annuaire', function () {
    return view('annuaire');
})->middleware('auth')->name('annuaire');

// Détail d'un agent (protégée)
Route::get('/agent/{id}', function ($id) {
    return view('agent', ['id' => $id]);
})->middleware('auth')->name('agent.detail');

// Dashboard admin (protégée)
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

// Inclure les routes d'auth (login, register, logout…)
require __DIR__.'/auth.php';