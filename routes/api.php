<?php

use App\Http\Controllers\Api\BrokerController;
use App\Http\Controllers\Api\TeamController;
use Illuminate\Support\Facades\Route;

// Use web middleware for session-based SPA authentication with Sanctum
Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::get('/teams', [TeamController::class, 'index']);
    Route::get('/teams/{team}', [TeamController::class, 'show']);
    Route::delete('/teams/{team}', [TeamController::class, 'destroy']);

    Route::get('/brokers', [BrokerController::class, 'index']);
    Route::get('/brokers/{broker}', [BrokerController::class, 'show']);
    Route::post('/teams/{team}/brokers', [BrokerController::class, 'store']);
});

