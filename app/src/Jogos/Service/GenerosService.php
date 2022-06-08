<?php

namespace App\src\Jogos\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Jogos\Model\Genero;
use App\src\Jogos\Repository\GenerosRepository;

class GenerosService
{

    public function __construct(
        protected GenerosRepository $generosRepository
    )
    {}

    public function index()
    {
        return $this->generosRepository->index();
    }

    public function store($request)
    {
        $genero = new Genero();
        $genero->nome = $request['nome'];

        $resultado = $this->generosRepository->store($genero);
        
        return $genero;
    }

    public function show($idGenero)
    {
        $resultado = $this->generosRepository->show($idGenero);

        if(empty($resultado)) {
            throw new HttpException('Nenhum gênero encontrado', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $resultado;
    }
}
