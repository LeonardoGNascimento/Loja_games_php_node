<?php

namespace App\src\Jogos\Infra\Repository;

use App\src\Jogos\Dominio\Command\CriarGeneroCommand;
use App\src\Jogos\Dominio\Model\Genero;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class GenerosRepository
{
    public function index(): Collection | null
    {
        try {
            $resultado =  Genero::all();

            if (empty($resultado->all())) {
                return null;
            }

            return $resultado;
        } catch (Exception $error) {
            return null;
        }
    }

    public function store(CriarGeneroCommand $criarGeneroCommand): Genero | null
    {
        try {
            return Genero::create(
                $criarGeneroCommand->destruct()
            );
        } catch (Exception $e) {
            return null;
        }
    }

    public function show(int $idGenero): Genero | null
    {
        try {
            $resultado = Genero::find($idGenero);

            if (empty($resultado)) {
                return null;
            }

            return $resultado;
        } catch (Exception $e) {
            return null;
        }
    }

    public function buscarGeneroPorNome($nome)
    {
        $resultado = Genero::where('nome', $nome)->first();

        if (empty($resultado)) {
            return null;
        }

        return $resultado;
    }
}
