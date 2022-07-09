<?php

namespace App\src\Jogos\Repository;

use App\src\Jogos\Model\Jogo;

class JogosRepository
{
    public function store(Jogo $jogo)
    {
        return $jogo->save();
    }

    public function index()
    {
        return Jogo::all();
    }

    public function show(int $idJogo)
    {
        $resultado = Jogo::where('id', $idJogo)->first();

        if (empty($resultado)) {
            return null;
        }

        return $resultado;
    }
}
