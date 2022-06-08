<?php

namespace App\src\Produtora\Repository;

use App\src\Produtora\Model\Produtora;
use Illuminate\Database\Eloquent\Collection;

class ProdutoraRepository
{
    public function index(): Collection
    {
        return Produtora::all();
    }

    public function store(Produtora $nomeProdutora)
    {
        return $nomeProdutora->save();
    }

    public function show($id)
    {
        return Produtora::find($id);
    }

    public function update($recurso, $nomeProdutora)
    {
        $recurso->fill(['nome' => $nomeProdutora]);
        $recurso->save();

        return $recurso;
    }

}
