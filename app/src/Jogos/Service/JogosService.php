<?php

namespace App\src\Jogos\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Jogos\Model\Jogo;
use App\src\Jogos\Repository\JogosRepository;
use App\src\Produtora\Repository\ProdutoraRepository;

class JogosService
{

    public function __construct(
        protected JogosRepository $jogosRepository,
        protected ProdutoraRepository $produtoraRepository
    )
    {}

    public function store($request)
    {
        $produtora = $this->produtoraRepository->show($request['id_produtora']);

        if(!$produtora){
            throw new HttpException('Produtora não encontrada!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        $jogo = new Jogo();
        $jogo->nome = $request['nome'];
        $jogo->faixa_etaria = $request['faixa_etaria'];
        $jogo->genero = $request['genero'];
        $jogo->id_produtora = $request['id_produtora'];

        $this->jogosRepository->store($jogo);
        
        return $jogo;
    }
}
