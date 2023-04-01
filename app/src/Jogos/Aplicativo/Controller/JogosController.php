<?php

namespace App\src\Jogos\Aplicativo\Controller;


use App\Enum\HttpStatus;
use App\Http\Controllers\Controller;
use App\src\Jogos\Aplicativo\Request\JogoRequest;
use App\src\Jogos\Aplicativo\Service\JogosService;
use App\src\Jogos\Dominio\Model\Jogo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JogosController extends Controller implements IJogosController
{
    public function __construct(
        protected JogosService $jogosService
    ) {
    }

    public function store(JogoRequest $request): JsonResponse
    {
        $jogo = new Jogo();
        $jogo->fill($request->all());

        $resultado = $this->jogosService->store($jogo);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function index(Request $request)
    {
        $resultado = $this->jogosService->index();
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }

    public function show($idJogo)
    {
        $resultado = $this->jogosService->show($idJogo);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }
}
