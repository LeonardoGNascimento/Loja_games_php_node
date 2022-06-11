<?php

namespace App\src\Produtora\Controller;

use App\Enum\HttpStatus;
use App\Http\Controllers\Controller;
use App\src\Produtora\Request\ProdutoraRequest;
use App\src\Produtora\Service\ProdutoraService;
use Illuminate\Http\JsonResponse;

class ProdutoraController extends Controller
{
    
    public function __construct(
        protected ProdutoraService $produtoraService
    )
    {}

    public function index(): JsonResponse
    {
        $resultado = $this->produtoraService->index();

        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function store(ProdutoraRequest $request): JsonResponse
    {
        $resultado = $this->produtoraService->store($request);

        return response()->json($resultado, HttpStatus::HTTP_CREATED->value);
    }

    public function show(int $id): JsonResponse
    {
        $resultado = $this->produtoraService->show($id);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function update(int $id, ProdutoraRequest $request): JsonResponse
    {
        $nomeProdutora = $request['nome'];
        $resultado = $this->produtoraService->update($id, $nomeProdutora);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }
}
