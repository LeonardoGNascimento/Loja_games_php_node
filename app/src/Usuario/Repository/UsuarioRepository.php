<?php

namespace App\src\Usuario\Repository;

use App\Models\User;

class UsuarioRepository
{
    public function store(User $usuario)
    {
        return $usuario->save();
    }
}
