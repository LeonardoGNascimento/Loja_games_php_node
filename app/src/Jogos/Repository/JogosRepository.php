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
        return Jogo::find($idJogo);
    }
}
