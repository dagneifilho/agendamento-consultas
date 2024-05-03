<?php

use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(\App\Http\Controllers\EspecialidadesController::class)->group(function () {
    Route::get('/especialidades', 'index')->name('especialidades.index');
    Route::get('/especialidades/create', 'create')->name('especialidades.create');
    Route::post('/especialidades', 'store')->name('especialidades.store');
});

Route::controller(PacientesController::class)->group(function () {
   Route::get('/pacientes', 'index')->name('pacientes.index');
   Route::get('/pacientes/create', 'create')->name('pacientes.create');
   Route::post('/pacientes', 'store')->name('pacientes.store');
   Route::get('/pacientes/{id}', 'show')->name('pacientes.show');
});

Route::controller(MedicosController::class)->group(function () {
    Route::get('/medicos', 'index')->name('medicos.index');
    Route::get('/medicos/create', 'create')->name('medicos.create');
    Route::post('/medicos', 'store')->name('medicos.store');
    Route::get('/medicos/{id}', 'show')->name('medicos.show');
});

Route::controller(ConsultasController::class)->group(function () {
    Route::get('/medicos/{id}/agendar', 'create')->name('consultas.create');
    Route::post('/consultas', 'store')->name('consultas.store');
    Route::get('/consultas/{id}', 'show')->name('consultas.show');
    Route::get('/pacientes/{id}/consultas', 'getByPaciente')->name('consultas.pacientes');
    Route::get('/medicos/{id}/consultas', 'getByMedico')->name('consultas.medicos');
});
