<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
})->name('index');


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

// Ruta para el logout


// Ruta para los términos y condiciones
Route::get('/terms', function () {
    return view('terms');
})->name('terms');


Route::get('/form/formulario', function () {
    return view('form.formulario');
})->name('form.formulario');


// Rutas para la evaluación de scrum
Route::get('/evaluacion', function () {
    return view('examscrum.evaluacion');
});

Route::get('/evaluacion2', function () {
    return view('examscrum.evaluacion2');
});


// Rutas para los resultados
Route::get('/resultado_scrum', function () {
    return view('results.resultado_scrum');
});


















