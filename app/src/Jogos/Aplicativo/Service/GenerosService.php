<?php

namespace App\src\Jogos\Aplicativo\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Jogos\Aplicativo\Request\GeneroRequest;
use App\src\Jogos\Dominio\Command\CriarGeneroCommand;
use App\src\Jogos\Dominio\Model\Genero;
use App\src\Jogos\Infra\Repository\GenerosRepository;
use Illuminate\Database\Eloquent\Collection;

class GenerosService
{
    public function __construct(
        private GenerosRepository $generosRepository
    ) {
    }

    public function index(): Collection
    {
        $resultado = $this->generosRepository->index();

        if (empty($resultado)) {
            throw new HttpException('Nenhum gênero encontrado', 404);
        }

        return $resultado;
    }

    public function store(CriarGeneroCommand $criarGeneroCommand)
    {
        $criarGeneroCommand->validate();

        $verificarGeneroExiste = $this->generosRepository->buscarGeneroPorNome($criarGeneroCommand->nome);

        if (!empty($verificarGeneroExiste)) {
            throw new HttpException('Gênero já cadastrado', HttpStatus::HTTP_BAD_REQUEST->value);
        }

        $resultado = $this->generosRepository->store($criarGeneroCommand);

        if (empty($resultado)) {
            throw new HttpException('Ocorreu um erro ao salvar um novo gênero', 400);
        }

        return $resultado;
    }

    public function show($idGenero)
    {
        $resultado = $this->generosRepository->show($idGenero);

        if (empty($resultado)) {
            throw new HttpException('Nenhum gênero encontrado', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $resultado;
    }

    public function buscarGeneroPorNome($nome)
    {
        $resultado = $this->generosRepository->buscarGeneroPorNome($nome);

        if (empty($resultado)) {
            throw new HttpException('Nenhum gênero encontrado', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $resultado;
    }
}
