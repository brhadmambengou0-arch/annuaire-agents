<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\EntityController;
use App\Http\Controllers\Api\FonctionController;
use App\Http\Controllers\Api\AuthController;

Route::prefix('v1')->group(function () {

    // Authentification
    Route::post('/auth/token',   [AuthController::class, 'token']);
    Route::delete('/auth/token', [AuthController::class, 'revoke'])
         ->middleware('auth:sanctum');

    // Lecture publique sans token
    Route::get('/entities',       [EntityController::class, 'index']);
    Route::get('/entities/tree',  [EntityController::class, 'tree']);
    Route::get('/entities/{id}',  [EntityController::class, 'show']);
    Route::get('/fonctions',      [FonctionController::class, 'index']);
    Route::get('/fonctions/{id}', [FonctionController::class, 'show']);
    Route::get('/agents',         [AgentController::class, 'index']);
    Route::get('/agents/{id}',    [AgentController::class, 'show']);

    // Écriture avec token Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/entities',         [EntityController::class, 'store']);
        Route::put('/entities/{id}',     [EntityController::class, 'update']);
        Route::delete('/entities/{id}',  [EntityController::class, 'destroy']);
        Route::post('/fonctions',        [FonctionController::class, 'store']);
        Route::put('/fonctions/{id}',    [FonctionController::class, 'update']);
        Route::delete('/fonctions/{id}', [FonctionController::class, 'destroy']);
        Route::post('/agents',           [AgentController::class, 'store']);
        Route::put('/agents/{id}',       [AgentController::class, 'update']);
        Route::delete('/agents/{id}',    [AgentController::class, 'destroy']);
    });
});