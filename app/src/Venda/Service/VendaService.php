<?php

namespace App\src\Venda\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\Models\User;
use App\src\Jogos\Repository\JogosRepository;
use App\src\Venda\Model\Nota;
use App\src\Venda\Model\Venda;
use App\src\Venda\Repository\VendasRepository;

class VendaService
{
    public function __construct(
        private JogosRepository $jogosService,
        private VendasRepository $vendasRepository
    ) {
    }

    public function store(User $usuario, array $id_jogos)
    {
        $valorTotal = 0;
        foreach ($id_jogos as $id_jogo) {
            $jogo = $this->jogosService->show($id_jogo);

            if(empty($jogo)) {
                throw new HttpException("Jogo id {$id_jogo} não encontrado!", HttpStatus::HTTP_NOT_FOUND->value);
            }
            $valorTotal += $jogo->valor;
        }
        
        $nota = new Nota();
        $nota->id_usuario = $usuario->id;
        $nota->total_itens = count($id_jogos);
        $nota->valor = $valorTotal;

        $this->vendasRepository->store($nota);

        foreach ($id_jogos as $id_jogo) {
            $venda = new Venda();
            $venda->id_jogo = $id_jogo;
            $venda->id_nota = $nota->id;
            $this->vendasRepository->salvarVenda($venda);
        }

        return $nota;
    }
}
