<?php

namespace App\src\Jogos\Aplicativo\Controller;

use App\Enum\HttpStatus;
use App\Http\Controllers\Controller;
use App\src\Jogos\Aplicativo\Request\GeneroRequest;
use App\src\Jogos\Aplicativo\Service\GenerosService;
use App\src\Jogos\Dominio\Command\CriarGeneroCommand;
use App\src\Jogos\Dominio\Model\Genero;
use App\src\Jogos\Request\GeneroRequest as RequestGeneroRequest;
use Illuminate\Http\JsonResponse;

class GenerosController extends Controller implements IGenerosController
{
    public function __construct(
        protected GenerosService $generosService
    ) {
    }

    public function index(): JsonResponse
    {
        $resultado = $this->generosService->index();
        return response()->json($resultado->all(), HttpStatus::HTTP_OK->value);
    }

    public function store(GeneroRequest $request): JsonResponse
    {
        $resultado = $this->generosService->store(
            new CriarGeneroCommand($request->nome)
        );
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function show($idGenero): JsonResponse
    {
        $resultado = $this->generosService->show($idGenero);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }
}
