<?php

namespace App\src\Venda\Aplicacao\Controller;

use App\Enum\HttpStatus;
use App\Http\Controllers\Controller;
use App\src\Usuario\Dominio\Model\Usuario;
use App\src\Venda\Aplicacao\Request\VendaRequest;
use App\src\Venda\Aplicacao\Service\NotaService;

class NotaController extends Controller
{
    public function __construct(
        public NotaService $notaService
    ) {
    }

    public function store(VendaRequest $request)
    {
        $usuario = new Usuario();
        $usuario->id = 1; 
        // $request->user();
        $jogos = $request->id_jogo;

        $resultado = $this->notaService->salvar($usuario, $jogos);
        return response()->json($resultado, HttpStatus::HTTP_OK->value);
    }
}
