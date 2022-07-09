<?php

namespace App\src\Jogos\Model\Query;

use App\src\Jogos\Model\Jogo;
use App\src\Produtora\Model\Produtora;

class JogoQuery
{
    public Jogo $jogo;
    public Produtora $produtora;

    public function setJogo(Jogo $jogo)
    {
        $this->jogo = $jogo;
    }

    public function setProdutora(Produtora $produtora)
    {
        $this->produtora = $produtora;
    }
}