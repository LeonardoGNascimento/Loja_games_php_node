<?php

namespace App\src\Venda\Controller;

use App\Enum\HttpStatus;
use App\Http\Controllers\Controller;
use App\src\Venda\Request\VendaRequest;
use App\src\Venda\Service\VendaService;

class VendaController extends Controller
{
    public function __construct(
        private VendaService $vendaService
    ) {
    }

    public function store(VendaRequest $request)
    {
        $usuario = $request->user();
        $jogos = $request->id_jogo;

        $resultado = $this->vendaService->store($usuario, $jogos);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }
}
