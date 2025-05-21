<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CareersController;

Route::get('/', function () {
    return view('index');
})->name('index');


// Rutas para el login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Dashboard protegido
Route::middleware('auth')->group(function () {
    Route::get('/reclutador/dashboard', function () {
        return view('reclutador.dashboard');
    })->name('reclutador.dashboard');

    Route::get('/reclutador/credenciales', function () {
        return view('reclutador.credenciales');
    })->name('reclutador.credenciales');
});


// Ruta para los términos y condiciones
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Formulario paso 1: Información personal
Route::get('/form/formulario', [ApplicantController::class, 'create'])->name('form.formulario');
Route::post('/form/formulario', [ApplicantController::class, 'store'])->name('form.formulario.store');

// Formulario paso 2: Perfil técnico
Route::get('/form/formulario_tecnico/{applicant}', [ApplicantController::class, 'perfilTecnico'])->name('form.formularioTecnico');
Route::post('/form/formulario_tecnico/{applicant}', [ApplicantController::class, 'guardarPerfilTecnico'])->name('form.guardarPerfilTecnico');


// Formulario paso 3: Experiencia en Metodologías Ágiles
Route::get('/form/formulario_metodologia/{applicant}', [ApplicantController::class, 'formularioMetodologia'])->name('form.formularioMetodologia');
Route::post('/form/formulario_metodologia/{applicant}', [ApplicantController::class, 'guardarFormularioMetodologia'])->name('form.guardarFormularioMetodologia');

// Evaluación Scrum (solo si experiencia_scrum = si)
Route::get('/evaluacion/{applicant}', [ApplicantController::class, 'evaluacionScrum'])->name('evaluacion.scrum');
Route::post('/evaluacion/{applicant}', [ApplicantController::class, 'guardarEvaluacionScrum'])->name('evaluacion.guardar');

// Resultados
Route::get('/resultado_scrum/{applicant}', [ApplicantController::class, 'resultadoScrum'])->name('resultado.scrum');
Route::get('/resultado_general/{applicant}', [ApplicantController::class, 'resultadoGeneral'])->name('resultado.general');


// Rutas para la evaluación de scrum
//Route::get('/evaluacion', function () {
//    return view('examscrum.evaluacion');
//});

//Route::get('/evaluacion2', function () {
//    return view('examscrum.evaluacion2');
//});


// Rutas para los resultados
//Route::get('/resultado_scrum', function () {
//    return view('results.resultado_scrum');
//});


