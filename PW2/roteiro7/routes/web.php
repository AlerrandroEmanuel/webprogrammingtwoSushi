
<?php

use Illuminate\Support\Facades\Route;

Route::get('/relatorios/painel-gerencial', [RelatorioController::class, 'painelGerencial'])
    ->name('relatorios.painel-gerencial');

Route::get('/relatorios/produtos', [RelatorioController::class, 'produtos'])
    ->name('relatorios.produtos');

Route::get('/relatorios/pedidos', [RelatorioController::class, 'pedidos'])
    ->name('relatorios.pedidos');

Route::get('/relatorios/resumo-status', [RelatorioController::class, 'resumoStatus'])
    ->name('relatorios.resumo-status');

Route::get('/relatorios/pedidos/exportar-csv', [RelatorioController::class, 'exportarCsv'])
    ->name('relatorios.pedidos.csv');

Route::get('/relatorios/pedidos/exportar-pdf', [RelatorioController::class, 'exportarPdf'])
    ->name('relatorios.pedidos.pdf');
