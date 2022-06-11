<?php

use App\src\Jogos\Controller\GenerosController;
use App\src\Jogos\Controller\JogosController;
use Illuminate\Support\Facades\Route;

Route::prefix('jogos')->group(function () {
    Route::get('/', [JogosController::class, 'index']);
    Route::get('/{id}', [JogosController::class, 'show']);
    Route::post('/', [JogosController::class, 'store']);

    Route::prefix('generos')->group(function () {
        Route::get('/', [GenerosController::class, 'index']);
        Route::post('/', [GenerosController::class, 'store']);
        Route::get('/{id}', [GenerosController::class, 'show']);
    });
});
