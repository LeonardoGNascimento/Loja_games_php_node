<?php

use App\src\Jogos\Aplicativo\Controller\JogosController;
use Illuminate\Support\Facades\Route;

Route::prefix('jogos')->group(function () {
    Route::get('/', [JogosController::class, 'index']);
    Route::get('/{id}', [JogosController::class, 'show']);
    Route::post('/', [JogosController::class, 'store']);
});
