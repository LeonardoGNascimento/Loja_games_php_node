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
        $genero = $this->generosRepository->show($request['id_genero']);

        if(empty($produtora)){
            throw new HttpException('Produtora não encontrada!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        if(empty($genero)){
            throw new HttpException('Gênero não encontrado!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        $jogo = new Jogo();
        $jogo->nome = $request['nome'];
        $jogo->faixa_etaria = $request['faixa_etaria'];
        $jogo->id_genero = $genero->id;
        $jogo->id_produtora = $produtora->id;
        $jogo->valor = $request['valor'];

        $this->jogosRepository->store($jogo);

        return $jogo;
    }

    public function index()
    {
        return $this->jogosRepository->index();
    }

    public function show(int $idJogo)
    {
        $resultado = $this->jogosRepository->show($idJogo);

        if(empty($resultado)) {
            throw new HttpException('Jogo não encontrado!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $resultado;
    }
}
