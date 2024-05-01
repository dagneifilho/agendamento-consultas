<?php

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
