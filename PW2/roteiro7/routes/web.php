<?php

use Illuminate\Support\Facades\Route;

Route::get(
    '/relatorios/pedidos',
    [RelatorioController::class, 'pedidos']
)->name('relatorios.pedidos');