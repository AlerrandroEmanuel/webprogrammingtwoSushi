
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('pedidos.index');
});

Route::get('/pedidos', [\PedidoController::class, 'index'])
    ->name('pedidos.index');

Route::get('/pedidos/criar', [\PedidoController::class, 'create'])
    ->name('pedidos.create');

Route::post('/pedidos', [\PedidoController::class, 'store'])
    ->name('pedidos.store');

Route::get('/clientes/{cliente}/pedidos', [\PedidoController::class, 'pedidosCliente'])
    ->name('clientes.pedidos');

Route::get('/clientes', [\ClienteController::class, 'index'])
    ->name('clientes.index');

Route::get('/produtos', [\ProdutoController::class, 'index'])
    ->name('produtos.index');

Route::get('/produtos', [\ProdutoController::class, 'index'])
    ->name('produtos.index');