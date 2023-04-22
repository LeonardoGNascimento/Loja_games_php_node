<?php

namespace App\src\Jogos\Aplicativo\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Jogos\Aplicativo\Service\GenerosService;
use App\src\Jogos\Dominio\Model\Jogo;
use App\src\Jogos\Infra\Repository\JogosRepository;
use App\src\Produtora\Service\ProdutoraService;
use Exception;

class JogosService
{
    public function __construct(
        protected JogosRepository $jogosRepository,
        private GenerosService $generosService,
        private ProdutoraService $produtoraService
    ) {
    }

    public function store(Jogo $jogo): Jogo
    {
        try {
            $this->generosService->show($jogo->id_genero);
            $this->produtoraService->show($jogo->id_produtora);
        } catch (Exception $error) {
            throw new HttpException($error->getMessage(), $error->getCode());
        }

        $this->jogosRepository->store($jogo);

        return $jogo;
    }

    public function index()
    {
        $resultado = $this->jogosRepository->index();

        if (empty($resultado)) {
            throw new HttpException('Nenhum jogo encontrado', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $resultado;
    }

    public function show(int $idJogo)
    {
        $jogo = $this->jogosRepository->show($idJogo);

        if (empty($jogo)) {
            throw new HttpException('Jogo não encontrado!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $jogo;
    }
}
