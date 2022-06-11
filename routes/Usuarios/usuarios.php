<?php

use App\src\Usuario\Controller\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::prefix('usuarios')->group(function () {
    Route::post('/', [UsuarioController::class, 'store']);
});
