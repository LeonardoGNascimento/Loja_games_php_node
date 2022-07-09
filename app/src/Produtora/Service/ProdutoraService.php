<?php

namespace App\src\Produtora\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\src\Produtora\Model\Produtora;
use App\src\Produtora\Repository\ProdutoraRepository;
use Exception;
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

    public function store(Produtora $produtora)
    {

        $verificarProdutoraExistente = $this->produtoraRepository->buscarPorNome($produtora->nome);

        if(!empty($verificarProdutoraExistente)) {
            throw new HttpException('Produtora já cadastrada', HttpStatus::HTTP_BAD_REQUEST->value);
        }

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

    public function update(Produtora $produtora)
    {
        try{
            $this->show($produtora->id);
        } catch (Exception $error) {
            throw new HttpException($error->getMessage(), $error->getCode());
        }

        return $this->produtoraRepository->update($produtora);
    }
}
