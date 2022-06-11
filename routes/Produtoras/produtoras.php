<?php

use App\src\Produtora\Controller\ProdutoraController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('produtoras')->group(function () {
    Route::get('/', [ProdutoraController::class, 'index']);
    Route::get('/{id}', [ProdutoraController::class, 'show']);
    Route::post('/', [ProdutoraController::class, 'store']);
    Route::patch('/{id}', [ProdutoraController::class, 'update']);
});
