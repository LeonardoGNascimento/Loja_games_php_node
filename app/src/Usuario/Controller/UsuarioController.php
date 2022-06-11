<?php

namespace App\src\Usuario\Controller;

use App\Http\Controllers\Controller;
use App\src\Usuario\Request\LoginRequest;
use App\src\Usuario\Request\UsuarioRequest;
use App\src\Usuario\Service\UsuarioService;
use Illuminate\Http\JsonResponse;

class UsuarioController extends Controller
{

    public function __construct(
        private UsuarioService $usuarioService
    ) {
    }

    public function store(UsuarioRequest $request): JsonResponse
    {
        $resultado = $this->usuarioService->store($request);
        return response()->json($resultado, 201);
    }

    public function login(LoginRequest $request)
    {
        $resultado = $this->usuarioService->login($request);
        return response()->json($resultado, 200);
    }
}
