<?php

namespace App\src\Usuario\Aplicacao\Controller;

use App\Http\Controllers\Controller;
use App\src\Usuario\Aplicacao\Service\UsuarioService;
use App\src\Usuario\Dominio\Command\CriarUsuarioCommand;
use App\src\Usuario\Request\UsuarioRequest;
use Illuminate\Http\JsonResponse;

class UsuarioController extends Controller implements IUsuarioController
{
    public function __construct(
        private UsuarioService $usuarioService
    ) {
    }

    public function salvar(UsuarioRequest $request): JsonResponse
    {
        $resultado = $this->usuarioService->salvar(
            new CriarUsuarioCommand(
                $request->nome,
                $request->email,
                $request->senha
            )
        );
        return response()->json($resultado, 201);
    }

    public function listar(): JsonResponse
    {
        $resultado = $this->usuarioService->listar();

        return response()->json($resultado, 201);
    }
}
