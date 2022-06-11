<?php

use App\src\Venda\Controller\VendaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('vendas')->group(function () {
    Route::post('/', [VendaController::class, 'store']);
});
