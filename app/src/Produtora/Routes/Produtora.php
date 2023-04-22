<?php

namespace App\src\Produtora\Routes;

use App\src\Produtora\Aplicacao\Controller\ProdutoraController;
use Illuminate\Support\Facades\Route;

Route::prefix('produtoras')->group(function () {
    Route::get('/', [ProdutoraController::class, 'index']);
    Route::get('/{id}', [ProdutoraController::class, 'show']);
    Route::post('/', [ProdutoraController::class, 'store']);
    Route::patch('/{id}', [ProdutoraController::class, 'update']);
});
