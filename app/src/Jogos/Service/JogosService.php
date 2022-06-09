<?php

namespace App\src\Jogos\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Jogos\Model\Jogo;
use App\src\Jogos\Repository\GenerosRepository;
use App\src\Jogos\Repository\JogosRepository;
use App\src\Produtora\Repository\ProdutoraRepository;

class JogosService
{
    public function __construct(
        protected JogosRepository $jogosRepository,
        protected ProdutoraRepository $produtoraRepository,
        protected GenerosRepository $generosRepository,
    )
    {}

    public function store($request): Jogo
    {
        $produtora = $this->produtoraRepository->show($request['id_produtora']);
        $genero = $this->generosRepository->show($request['genero']);

        if(!$produtora){
            throw new HttpException('Produtora não encontrada!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        $jogo = new Jogo();
        $jogo->nome = $request['nome'];
        $jogo->faixa_etaria = $request['faixa_etaria'];
        $jogo->genero = $genero->id;
        $jogo->id_produtora = $produtora->id;

        $this->jogosRepository->store($jogo);

        return $jogo;
    }
}
