<?php

namespace App\src\Usuario\Infra\Repository\Mysql;

use App\src\Usuario\Dominio\Command\CriarUsuarioCommand;
use App\src\Usuario\Dominio\Model\Usuario;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class UsuarioRepository
{
    public function salvar(CriarUsuarioCommand $usuario): Usuario | null
    {
        try {
            $usuario = Usuario::create($usuario->destruct());

            if (empty($usuario)) {
                return null;
            }

            return $usuario;
        } catch (Exception $error) {
            return null;
        }
    }

    public function listar(): Collection | null
    {
        try {
            $usuarios = Usuario::all();

            if (empty($usuarios)) {
                return null;
            }

            return $usuarios;
        } catch (Exception $error) {
            return null;
        }
    }
}
