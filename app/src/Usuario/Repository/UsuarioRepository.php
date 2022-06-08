<?php

namespace App\src\Usuario\Repository;

use App\Dominio\Usuario\Model\Usuario;

class UsuarioRepository
{
    public function store($request)
    {
        return Usuario::create($request->all());
    }
}
