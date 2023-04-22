<?php

use App\src\Jogos\Aplicativo\Controller\GenerosController;
use Illuminate\Support\Facades\Route;

Route::prefix('generos')->group(function () {
  Route::get('/', [GenerosController::class, 'index']);
  Route::get('/{id}', [GenerosController::class, 'show']);
  Route::post('/', [GenerosController::class, 'store']);
});
