<?php

namespace App\src\Usuario\Repository;

use App\src\Usuario\Model\Usuario;

class UsuarioRepository
{
    public function store(Usuario $usuario)
    {
        return $usuario->save();
    }
}
