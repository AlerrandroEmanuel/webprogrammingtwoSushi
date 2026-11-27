
<?php

use Illuminate\Support\Facades\Route;

require_once app_path('Models/Produto.php');
require_once app_path('Models/Curso.php');

require_once app_path('Http/Controllers/ProdutoController.php');
require_once app_path('Http/Controllers/CursoController.php');

Route::get('/', function () {
    return redirect()->route('produtos.index');
});

Route::resource('produtos', ProdutoController::class);
Route::resource('cursos', CursoController::class);
