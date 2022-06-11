<?php

use App\src\Usuario\Controller\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UsuarioController::class, 'login'])->name('login');

Route::prefix('usuarios')->group(function () {
    Route::post('/', [UsuarioController::class, 'store'])->middleware('auth:sanctum');
});
