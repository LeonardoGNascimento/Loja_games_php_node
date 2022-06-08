<?php

namespace App\src\Jogos\Controller;

use App\Enum\HttpStatus;
use App\Http\Controllers\Controller;
use App\src\Jogos\Request\GeneroRequest;
use App\src\Jogos\Service\GenerosService;
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
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function store(GeneroRequest $request)
    {
        $resultado = $this->generosService->store($request);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function show($idGenero)
    {
        $resultado = $this->generosService->show($idGenero);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }
}
