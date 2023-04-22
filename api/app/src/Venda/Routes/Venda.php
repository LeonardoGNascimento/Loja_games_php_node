<?php

namespace App\src\Venda\Routes;

use App\src\Venda\Aplicacao\Controller\NotaController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendas')->group(function () {
    Route::post('/', [NotaController::class, 'store']);
});
