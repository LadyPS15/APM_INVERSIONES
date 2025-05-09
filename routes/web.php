<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

// Rutas para el login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Ruta para el dashboard del reclutador, protegida por autenticación

Route::get('/reclutador/dashboard', function () {
    return view('reclutador.dashboard');
})->middleware('auth')->name('reclutador.dashboard');

// Ruta para credenciales
Route::get('/reclutador/credenciales', function () {
    return view('reclutador.credenciales');
})->middleware('auth')->name('reclutador.credenciales');
