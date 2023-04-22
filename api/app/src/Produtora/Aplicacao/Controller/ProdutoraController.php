<?php

namespace App\src\Produtora\Aplicacao\Controller;

use App\Enum\HttpStatus;
use App\Http\Controllers\Controller;
use App\src\Produtora\Aplicacao\Request\ProdutoraRequest;
use App\src\Produtora\Aplicacao\Service\ProdutoraService;
use App\src\Produtora\Dominio\Model\Produtora;
use Illuminate\Http\JsonResponse;

class ProdutoraController extends Controller
{
    public function __construct(
        protected ProdutoraService $produtoraService
    ) {
    }

    public function index(): JsonResponse
    {
        $resultado = $this->produtoraService->index();

        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function store(ProdutoraRequest $request): JsonResponse
    {
        $produtora = new Produtora();
        $produtora->fill($request->all());

        $resultado = $this->produtoraService->store($produtora);

        return response()->json($resultado, HttpStatus::HTTP_CREATED->value);
    }

    public function show(int $id): JsonResponse
    {
        $resultado = $this->produtoraService->show($id);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function update(int $id, ProdutoraRequest $request): JsonResponse
    {
        $produtora = new Produtora();
        $produtora->id = $id;
        $produtora->fill($request->all());

        $resultado = $this->produtoraService->update($produtora);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }
}
