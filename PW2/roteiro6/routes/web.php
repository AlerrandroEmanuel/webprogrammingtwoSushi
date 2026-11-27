
<?php

use Illuminate\Support\Facades\Route;

require_once app_path('Http/Controllers/ProdutoController.php');
require_once app_path('Http/Controllers/CursoController.php');

Route::get('/produtos', [ProdutoController::class, 'index'])
    ->name('produtos.index');

Route::get('/cursos', [CursoController::class, 'index'])
    ->name('cursos.index');
