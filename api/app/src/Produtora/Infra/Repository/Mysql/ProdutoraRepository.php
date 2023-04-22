<?php

namespace App\src\Produtora\Infra\Repository\Mysql;

use App\src\Produtora\Dominio\Command\AtualizarProdutoraCommand;
use App\src\Produtora\Dominio\Model\Produtora;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class ProdutoraRepository
{
    public function index(): array | null
    {
        try {
            $resultado = (Produtora::all())->all();

            if (empty($resultado)) {
                return null;
            }

            return $resultado;
        } catch (Exception $error) {
            return null;
        }
    }

    public function store(Produtora $nomeProdutora)
    {
        return $nomeProdutora->save();
    }

    public function show(int $id): Produtora | null
    {
        $resultado = Produtora::find($id);

        if (empty($resultado)) {
            return null;
        }

        return $resultado;
    }

    public function update(AtualizarProdutoraCommand $atualizarProdutoraCommand): bool
    {
        try {
            if (!empty($atualizarProdutoraCommand->nome)) {
                $dados['nome'] = $atualizarProdutoraCommand->nome;
            }

            if (empty($dados)) {
                return false;
            }

            Produtora::where('id', $atualizarProdutoraCommand->id)
                ->update($dados);

            return true;
        } catch (Exception $error) {
            return false;
        }
    }

    public function buscarPorNome($nome)
    {
        $resultado = Produtora::where('nome', $nome)->first();

        if (empty($resultado)) {
            return null;
        }

        return $resultado;
    }
}
