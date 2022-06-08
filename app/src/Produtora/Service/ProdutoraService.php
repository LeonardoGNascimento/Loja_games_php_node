<?php

namespace App\src\Produtora\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Produtora\Model\Produtora;
use App\src\Produtora\Repository\ProdutoraRepository;
use App\src\Produtora\Request\ProdutoraRequest;
use Illuminate\Database\Eloquent\Collection;

class ProdutoraService
{
    public function __construct(
        protected ProdutoraRepository $produtoraRepository
    ) {
    }

    public function index(): Collection
    {
        $resultado = $this->produtoraRepository->index();

        if (!$resultado) {
            throw new HttpException(code: HttpStatus::HTTP_NO_CONTENT->value);
        }

        return $resultado;
    }

    public function store(ProdutoraRequest $request)
    {
        $produtora = new Produtora();
        $produtora->nome = $request['nome'];

        $this->produtoraRepository->store($produtora);

        return $produtora;
    }

    public function show($id)
    {
        $resultado = $this->produtoraRepository->show($id);

        if (!$resultado) {
            throw new HttpException('Produtora não encontrada!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $resultado;
    }

    public function update($id, $nomeProdutora)
    {
        $produtora = $this->produtoraRepository->show($id);

        if (!$produtora) {
            throw new HttpException('Produtora não encontrada!', HttpStatus::HTTP_NOT_FOUND->value);
        }

        return $this->produtoraRepository->update($produtora, $nomeProdutora);
    }
}
