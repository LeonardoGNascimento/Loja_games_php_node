<?php

namespace App\src\Jogos\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Jogos\Model\Jogo;
use App\src\Jogos\Model\Query\JogoQuery;
use App\src\Jogos\Repository\JogosRepository;
use App\src\Produtora\Service\ProdutoraService;
use Exception;

class JogosService
{
    public function __construct(
        protected JogosRepository $jogosRepository,
        private GenerosService $generosService,
        private ProdutoraService $produtoraService
    )
    {}

    public function store(Jogo $jogo): Jogo
    {
        try {
            $this->generosService->show($jogo->id_genero);
            $this->produtoraService->show($jogo->id_produtora);
        }catch (Exception $error) {
            throw new HttpException($error->getMessage(), $error->getCode());
        }

        $this->jogosRepository->store($jogo);

        return $jogo;
    }

    public function index()
    {
        return $this->jogosRepository->index();
    }

    public function show(int $idJogo)
    {
        $jogo = $this->jogosRepository->show($idJogo);

        if(empty($jogo)) {
            throw new HttpException('Jogo não encontrado!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        try {
            $produtora = $this->produtoraService->show($jogo->id_produtora);
        } catch (Exception $error) {
            throw new HttpException($error->getMessage(), $error->getCode());
        }

        $jogoQuery = new JogoQuery();
        $jogoQuery->setJogo($jogo);
        $jogoQuery->setProdutora($produtora);

        return $jogoQuery;
    }
}
