<?php

namespace App\src\Jogos\Repository;

use App\src\Jogos\Model\Genero;

class GenerosRepository
{
    public function index()
    {
        return Genero::all();
    }

    public function store(Genero $genero)
    {
        return $genero->save();
    }
    public function show($idGenero)
    {
        return Genero::find($idGenero);
    }
}
