<?php

use App\Http\Controllers\BrokerController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');

Route::get('/api/teams/{team}/brokers', [BrokerController::class, 'index'])->name('api.brokers.index');
Route::get('/api/brokers/{broker}', [BrokerController::class, 'show'])->name('api.brokers.show');
Route::post('/teams/{team}/brokers', [BrokerController::class, 'store'])->name('brokers.store');
