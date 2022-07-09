<?php

namespace App\src\Jogos\Repository;

use App\src\Jogos\Dominio\Model\Genero;
use Illuminate\Support\Facades\DB;

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
        $resultado = Genero::find($idGenero);

        if (empty($resultado)) {
            return null;
        }

        return $resultado;
    }

    public function buscarGeneroPorNome($nome) 
    {
        $resultado = Genero::where('nome', $nome)->first();

        if(empty($resultado)) {
            return null;
        }

        return $resultado;
    }
}
