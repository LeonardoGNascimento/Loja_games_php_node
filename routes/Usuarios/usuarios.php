<?php

use App\src\Usuario\Controller\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('usuarios')->group(function () {
    Route::post('/', [UsuarioController::class, 'store'])->middleware('auth:sanctum');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [UsuarioController::class, 'login'])->name('login');
