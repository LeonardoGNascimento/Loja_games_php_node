<?php

namespace App\src\Usuario\Aplicacao\Controller;

use App\src\Usuario\Request\UsuarioRequest;
use Illuminate\Http\JsonResponse;

interface IUsuarioController
{
    public function salvar(UsuarioRequest $request): JsonResponse;
    public function listar(): JsonResponse;
}
