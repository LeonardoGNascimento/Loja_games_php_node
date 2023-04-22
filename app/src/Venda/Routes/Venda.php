<?php

namespace App\src\Venda\Routes;

use App\src\Venda\Aplicacao\Controller\VendaController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendas')->group(function () {
    Route::post('/', [VendaController::class, 'store']);
});
