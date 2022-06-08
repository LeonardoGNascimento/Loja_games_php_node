<?php

namespace App\src\Usuario\Controller;

use App\Dominio\Usuario\Request\UsuarioRequest;
use App\Dominio\Usuario\Service\UsuarioService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    private UsuarioService $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
    }

    public function store(UsuarioRequest $request): JsonResponse
    {
        $resultado = $this->usuarioService->store($request);
        return response()->json($resultado, 201);
    }
}
