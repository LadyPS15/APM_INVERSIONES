<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
})->name('index');


// Rutas para el login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard protegido
Route::middleware('auth')->group(function () {
    Route::get('/reclutador/dashboard', function () {
        return view('reclutador.dashboard');
    })->name('reclutador.dashboard');

    Route::get('/reclutador/credenciales', function () {
        return view('reclutador.credenciales');
    })->name('reclutador.credenciales');

    // dashboard del practicante
    Route::get('/practicante/dashboard', function () {
        return view('practicante.dashboard');
    })->name('practicante.dashboard');
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


// Evaluación parte 1 - mostrar y guardar
Route::get('/evaluacion/{applicant}', [ApplicantController::class, 'evaluacionScrum'])->name('evaluacion.scrum');
Route::post('/evaluacion/{applicant}', [ApplicantController::class, 'guardarEvaluacionScrum'])->name('evaluacion.guardar');

// Evaluación parte 2 - mostrar y guardar
Route::get('/evaluacion2/{applicant}', [ApplicantController::class, 'evaluacionScrum2'])->name('evaluacion.scrum2');
Route::post('/evaluacion2/{applicant}', [ApplicantController::class, 'guardarEvaluacionScrum2'])->name('evaluacion.guardar2');


// Resultados
Route::get('/resultado_scrum/{applicant}', [ApplicantController::class, 'resultadoScrum'])->name('resultado.scrum');
Route::get('/resultado_general/{applicant}', [ApplicantController::class, 'resultadoGeneral'])->name('resultado.general');


// Dashboard reclutador
Route::get('/reclutador/dashboard', [ApplicantController::class, 'index'])->name('reclutador.dashboard');
// Aceptar postulante
Route::post('/applicants/{id}/accept', [ApplicantController::class, 'accept'])->name('applicants.accept');

// Eliminar postulante
Route::delete('/applicants/{id}', [ApplicantController::class, 'destroy'])->name('applicants.destroy');

Route::get('/reclutador/credenciales', [UserController::class, 'index'])->name('reclutador.credenciales');

Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Mostrar perfil
Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil.show')->middleware('auth');

// Actualizar perfil
Route::post('/perfil/update', [ProfileController::class, 'update'])->name('perfil.update')->middleware('auth');

// practicante dashboard
// Route::get('/practicante/dashboard', [ApplicantController::class, 'index'])->name('practicante.dashboard');

Route::get('/practicante/recuroscrum', [ApplicantController::class, 'recuroScrum'])->name('practicante.recursoscrum');

Route::get('/practicante/comunidad', [ApplicantController::class, 'comunidad'])->name('practicante.comunidad');
// Mostrar perfil del practicante
Route::get('/practicante/perfil', [ProfileController::class, 'perfilPracticante'])->name('practicante.perfil')->middleware('auth');