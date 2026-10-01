<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

Route::get('/cursos', [CursoController::class, 'index'])
    ->name('cursos.index');

Route::get('/cursos/criar', [CursoController::class, 'create'])
    ->name('cursos.create');

Route::post('/cursos', [CursoController::class, 'store'])
    ->name('cursos.store');

Route::get('/cursos/{curso}', [CursoController::class, 'show'])
    ->name('cursos.show');

Route::delete('/cursos/{curso}', [CursoController::class, 'destroy'])
    ->name('cursos.destroy');