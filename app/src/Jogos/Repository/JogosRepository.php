<?php

namespace App\src\Jogos\Repository;

use App\src\Jogos\Model\Jogo;

class JogosRepository
{
    public function store(Jogo $jogo)
    {
        return $jogo->save();
    }
}
