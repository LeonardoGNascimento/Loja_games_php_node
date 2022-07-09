<?php

namespace App\src\Jogos\Repository;

use App\src\Jogos\Dominio\Model\Jogo;
use Doctrine\Common\Collections\ArrayCollection;

class JogosRepository
{
    public function store(Jogo $jogo)
    {
        return $jogo->save();
    }

    public function index()
    {
        $resultados = Jogo::all()->toArray();

        if (empty($resultados)) {
            return null;
        }

        $jogos = new ArrayCollection();

        foreach ($resultados as $resultado) {
            $jogo = new Jogo();
            $jogo->fill($resultado);

            $jogos->add($jogo);
        }

        return $jogos->toArray();
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
