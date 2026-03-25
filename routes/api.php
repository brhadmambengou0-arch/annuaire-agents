<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EntityController;
use App\Http\Controllers\Admin\FonctionController;

Route::prefix('v1')->group(function () {

    // 🔓 accès public (lecture)
    Route::get('/entities', [EntityController::class, 'index']);
    Route::get('/fonctions', [FonctionController::class, 'index']);

    // 🔐 routes protégées
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {

        // ENTITÉS
        Route::post('/entities', [EntityController::class, 'store']);
        Route::put('/entities/{id}', [EntityController::class, 'update']);
        Route::delete('/entities/{id}', [EntityController::class, 'destroy']);

        // FONCTIONS
        Route::post('/fonctions', [FonctionController::class, 'store']);
        Route::put('/fonctions/{id}', [FonctionController::class, 'update']);
        Route::delete('/fonctions/{id}', [FonctionController::class, 'destroy']);
    });

});