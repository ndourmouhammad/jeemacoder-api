<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\InstallationController;

// Authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout']);

// Installation
Route::get('/installations/disponibles', [InstallationController::class, 'getAvailableInstallations']);

Route::middleware('auth')->group(function () {
    Route::post('/installations/{id}', [InstallationController::class, 'update']);
    Route::put('/installations/{id}/disponible', [InstallationController::class, 'setDisponible']);
    Route::put('/installations/{id}/indisponible', [InstallationController::class, 'setIndisponible']);
    Route::apiResource('/installations', InstallationController::class)->only('index', 'store', 'destroy');
});

// Reservation
Route::middleware('auth')->group(function () {
    Route::post('/installations/{installation_id}/reservations', [ReservationController::class, 'store']);
    Route::put('/reservations/{id}/confirm', [ReservationController::class, 'confirm']);
    Route::put('/reservations/{id}/cancel', [ReservationController::class, 'cancel']);
    Route::get('/mes-reservations', [ReservationController::class, 'myReservations']);
    Route::get('/reservations', [ReservationController::class, 'reservations']);
});
