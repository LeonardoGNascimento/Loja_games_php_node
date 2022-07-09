<?php

namespace App\src\Jogos\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Jogos\Model\Genero;
use App\src\Jogos\Repository\GenerosRepository;

class GenerosService
{
    public function __construct(
        private GenerosRepository $generosRepository
    )
    {}

    public function index()
    {
        return $this->generosRepository->index();
    }

    public function store(Genero $genero)
    {
        $verificarGeneroExiste = $this->generosRepository->buscarGeneroPorNome($genero->nome);

        if(!empty($verificarGeneroExiste)) {
            throw new HttpException('Gênero já cadastrado', HttpStatus::HTTP_BAD_REQUEST->value);
        }

        $this->generosRepository->store($genero);
        
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

    public function buscarGeneroPorNome($nome)
    {
        $resultado = $this->generosRepository->buscarGeneroPorNome($nome);

        if(empty($resultado->nome)) {
            throw new HttpException('Nenhum gênero encontrado', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $resultado;
    }
}
